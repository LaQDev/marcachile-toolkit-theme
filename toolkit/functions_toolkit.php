<?php 
 
/*

add_theme_support( 'thumbnails' );
add_theme_support( 'post-thumbnails' ); 
add_theme_support( 'page-thumbnails' ); 
*/



$themeURL = get_template_directory_uri()."/toolkit"; 
$siteURL  = get_bloginfo('url');  
$fecha = date("Y-m-d H:i:s");  

//$_SESSION["marcaCH"]["toolkit"];
//$_SESSION["marcaCH"]["toolkit"]["user"];
//$_SESSION["marcaCH"]["toolkit"]["cart"];


/***/ 
/*** VALIDA CAMPOS ***/ 
/***/ 
function rgp($objeto){
	$temp = '';
	if ( isset( $_REQUEST[ $objeto ] ) ) {
		$temp = sanitize_text_field( wp_unslash( $_REQUEST[ $objeto ] ) );
	}
	return $temp;
}   
function clean_var($var){ 
	$re_var = str_replace(" ", "_", $var);	
	$re_var = str_replace("-", "_", $re_var); 	
	$vowels = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú");
	$onlyconsonants = str_replace($vowels, "", $re_var);	
	return $re_var; 
} 
function val_vacio($valor){
	$re_valor = $valor;		
	//$re_valor = utf8_encode($re_valor);
	$re_valor = strip_tags($re_valor);
	$re_valor = str_replace("%20", "", $re_valor);	
	$re_valor = str_replace("&nbsp;", "", $re_valor);	
	$re_valor = str_replace("<br>", "", $re_valor);	
	$re_valor = str_replace("<br />", "", $re_valor);	
	$re_valor = str_replace("   ", "", $re_valor);	
	$re_valor = str_replace("  ", "", $re_valor);
	$re_valor = str_replace(" ", "", $re_valor);
	$re_valor = htmlspecialchars($re_valor, ENT_QUOTES);
	$re_valor = str_replace("   ", "", $re_valor);	
	$re_valor = str_replace("  ", "", $re_valor);
	$re_valor = str_replace(" ", "", $re_valor);
	if(($re_valor=="")||($re_valor==" ")||($re_valor=="  ")||($re_valor=="&nbsp;")||($re_valor=="&nbsp;<br>")||($re_valor=="&nbsp;<br />")){
		return false;
	}
	else{
		if(strlen($re_valor)>0){ 	return true;  }
		else{ return false;	 }
	}
} 
function val_email($email){
	$var=1;
	if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)){	
		$var=0;
	}
	return $var;
} 


 
?>