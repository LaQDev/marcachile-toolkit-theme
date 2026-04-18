<?php


use Aws\S3\S3Client; 
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception; 
use Aws\S3\ObjectUploader;

function tk_descarga(){ 
//is login is a function that will return true or false 
    //depending if one of the variables is null or not 
    if(is_login()==true){
        $permiso=0;
        
                
        #¿autoload?
        loadAwsSdk();
                    // returns the server path
        $pathPlugins = get_template_directory().'/../../plugins';

        # does the pathplugins will only be included once in this path?, if this is the case, why not just a variable? 
        $credentials = include_once("$pathPlugins/marcachile-toolkit-s3-plugin/includes/aws-credentials.php");
        
        #crentials to access to the s3?
        $s3_credentials = new Aws\Credentials\Credentials($credentials["accessKey"], $credentials["secretKey"]);  
        
        $bucket_origin = isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] == "prod" ? "cdn.toolkit.cl" : 'cdn.toolkit.cl';
        $bucket_upload = isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] == "prod" ? "cdn.toolkit.cl" : 'cdn.toolkit.cl';
        
        // creating the client
        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'credentials' => $s3_credentials
        ]);

        #¿?
        $zip = new ZipArchive();
        //just return the time, is a php function
        $time=time();

        $dir_ruta=__DIR__; 

        $dir_ruta=str_replace("/wp-content/themes/marcachile2020/toolkit","",$dir_ruta);   

        $nombreArchivoZip = $dir_ruta."/_tk_historial/toolkitfiles_".$time.".zip"; 



        if (!$zip->open($nombreArchivoZip, ZipArchive::CREATE )) {
            exit("Error abriendo ZIP en $nombreArchivoZip");
        }   

        global $fecha; 
        global $wpdb; 

        //basename will cut off the path and remove it  

        $archivo_zip = basename($nombreArchivoZip);
        $id_usuario=$_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['user']['id'];

        $wpdb->insert("toolkit_descargas", array(
            "id_usuario" => $id_usuario,
            "archivo_zip" => $archivo_zip,
            "fecha_registro" => $fecha,
        )); 


        $lastid = $wpdb->insert_id;  

        $id_descarga=$lastid; 

        //making a dynamic path to the local file(s) 
        $dir_ruta=__DIR__; 
        $dir_ruta=str_replace("/wp-content/themes/marcachile2020/toolkit","",$dir_ruta);   
        $dir_ruta.= '/_tk_historial'; 
        $files_to_zip = array();

        if( (isset($_POST['direct']))&&($_POST['direct']>0) ){
            $direct=$_POST['direct'];
            $route_s3=$_POST['route_s3'];
            //get_post and $direct must match
            // i supposed this is the value of the image that will be downloaded
            $post_= get_post($direct); 

                                  //id     
            // $ruta_s3 = get_field('ruta_s3',$post_->ID);
            $ruta_s3 = $route_s3;
            //file name
            $nombre = $time.'_'.basename($ruta_s3);
            $local_file=$dir_ruta.'/'. $nombre;

            try {
                $result = $s3->getObject(array(
                    'Bucket' => $bucket_origin,
                    'Key'    => $ruta_s3,
                    'SaveAs' => $local_file, 
                ));
            } catch (Aws\S3\Exception\S3Exception $e) { 
                echo "ERROR"; 
            } 

            if($result){ 

                $files_to_zip[] = $local_file; 
                foreach ($files_to_zip as $file) { 
                    $nombre = basename($file);
                    $nombre=str_replace($time.'_',"",$nombre);  
                    $zip->addFile($file, $nombre);
                } 

                $wpdb->insert("toolkit_descargas_archivos", array(
                    "id_descarga" => $id_descarga,
                    "id_usuario" => $id_usuario,
                    "archivo" => $post_->ID,
                    "ruta_archivo" => $ruta_s3,
                    "fecha_registro" => $fecha,
                )); 
            } 
        }else{ // descarga carrito
            foreach ($_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['cart'] AS $valores => $items){  
                  // this is a wp function
                // $ruta_s3=get_field('ruta_s3',$items['id']);
                $ruta_s3=$items['route_s3'];
                $nombre = $time.'_'.basename($ruta_s3);


                // saving the zip file on the client's hard disk
                try { 
                    $s3->getObject(array(
                        'Bucket' => $bucket_origin,
                        'Key'    => $ruta_s3,
                        'SaveAs' => $dir_ruta.'/'. $nombre, 
                    ));
                    $result = true;
                } catch (Aws\S3\Exception\S3Exception $e) { 
                    //echo "ERROR"; 
                    $result = false;
                } 

                if($result){ 
                //all the assets already were saved in the local server if this condition is met 

                    $files_to_zip[] = $dir_ruta.'/'. $nombre; 
                    //just adding values to de wp database
                    $wpdb->insert("toolkit_descargas_archivos", array(
                        //making the zip file
                        "id_descarga" => $id_descarga,
                        "id_usuario" => $id_usuario,
                        "archivo" => $items['id'],
                        "ruta_archivo" => $items['route_s3'],
                        "fecha_registro" => $fecha,
                    )); 
                } 
            }
            
            //this will add every file to a single zip 
            foreach ($files_to_zip as $file) {
                
                //remember that the path is gonna be removed
                $nombre = basename($file);
                //just making the file's name saved in the zip looks better 
                $nombre=str_replace($time.'_',"",$nombre);  
                //file added to the zip file 
                $zip->addFile($file, $nombre);


                
            } 
        }
        
        $resultado = $zip->close(); 
        if ($resultado) { 

            //just to not break the code 
            $ruta_archivo = $nombreArchivoZip;

            $_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['cart_descarga']=$ruta_archivo;
            $permiso = 1;  

            //key without its original path, it's replace with other one
            $key = "wp-content/toolkit/".basename($ruta_archivo);
            // Using stream instead of file path
            $source = fopen($ruta_archivo, 'rb');
            //the $acl default state is 'private'
            $acl = 'public-read';
            try{
                $uploader = new ObjectUploader(
                    $s3,
                    $bucket_upload,
                    $key,
                    $source,
                    $acl
                );
            }catch(Exception $e){
                // echo "$e";
            }
        
            do {
                try {
                    $result = $uploader->upload();
              
                } catch (MultipartUploadException $e) {
                    rewind($source);
                    $uploader = new MultipartUploader($s3, $source, [
                        'state' => $e->getState(),
                    ]);
                }
            } while (!isset($result));
            
            fclose($source);

        } else { ?>
            <script>
            alert("Error al crear archivo");
            </script>
        <?php 
        }
        
        if($permiso==1){

            //destroy the user information
            unset($_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['cart_descarga']);

            if( (isset($_POST['direct']))&&($_POST['direct']>0) ){
                $direct=$_POST['direct'];
                $route_s3=$_POST['route_s3'];
                unset($_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['cart'][$direct]);
                $total_productos=total_productos(); 

                if( ($total_productos==0)||($total_productos=="")){
                    unset($_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['cart']);      
                }
        ?>

            <script>
                //direct download
            $("#btn_dwn__single_<?php echo $post_->ID;?>").hide(); 
         
            window.location.href ="/<?php echo $key;?>";
         
            $("#btn-descarga").html("DESCARGAR"); 
                console.log("descarga directa");
            </script>
            <?php 
            }else{ 
                unset($_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['cart']); 
                ?>

                <script>
                // Descarga todo el carro

                $(".hide_msj").hide(); 
                $("#btn-descarga").hide(); 
                $("#count_cart").html(0); 
                $(".tabla-descargas").html("<h1 style='text-align:center;' align='center'>¡GRACIAS!</h1><p>En breve comenzará la descarga.</p>"); 
                $(".resultados-toolkit h4").html(""); 
                setTimeout(function(){ 
                    $("#btn-descarga").html("DESCARGAR"); 

                    window.location.href = "/<?php echo $key;?>";

                }, 2000);
                //why in 2 seconds?
                </script>
                <?php 
            }
        }

        // deleting local assets
        @unlink($nombreArchivoZip);
        foreach ($files_to_zip as $file) {
            if (file_exists($file)) {
                @unlink($file);
            }
        
        }
    }else {
        go_login('descarga'); 
    }
  
   
}

