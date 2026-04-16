<?php 
$temas = get_terms( array(
    'taxonomy' => 'temas',
    'hide_empty' => false,
) );
$categorias = get_terms( array(
    'taxonomy' => 'categorias',
    'hide_empty' => false,
    'parent' => 0
) ); 
if(!isset($get_buscar)){ 
    $get_buscar="";
}
if(!isset($tema_slug)){ 
    $tema_slug="";
}
if(!isset($categoria_slug)){ 
    $categoria_slug="";
}
if(!isset($get_idioma)){ 
    $get_idioma="";
}
?>
    <div class="buscador-toolkit">
        <div class="input-buscador">
            <!-- /apps/toolkit/sitio/resultados/ -->
            <form action="<?php echo home_url('/resultados/'); ?>" method="get" name="buscador">
                <input type="text" name="buscar" <?php if($get_buscar!=""){ ?> value="<?php echo $get_buscar;?>" <?php } ?> placeholder="Buscar.." />
                <button type="submit">
                    <img src="<?php echo $themeURL; ?>/images/toolkit/ic-lupa.svg" alt="">
                </button>
            </form>
        </div>
        <div class="filtros">
            <select name="temas" id="select_temas">
                <option value="">TEMA</option>
                <option value="">Todos</option>
                <?php 
                foreach($temas AS $tema){ ?>
                    <option value="<?php echo $tema->slug;?>" <?php if($tema_slug==$tema->slug){ ?> selected="selected" <?php } ?> ><?php echo ucfirst($tema->name);?></option>
                    <?php 
                }
                ?>
            </select>
            <select name="categorias" id="select_categorias">
                <option value="">HERRAMIENTA</option>
                <option value="">Todos</option>
                <?php 
                foreach($categorias AS $categoria){  ?>
                    <option value="<?php echo $categoria->slug;?>" <?php if($categoria_slug==$categoria->slug){ ?> selected="selected" <?php } ?> ><?php echo ucfirst($categoria->name);?></option>
                    <?php 
                }
                ?>
            </select>
            <select name="idiomas" id="select_idiomas">
                <option value="">IDIOMA</option>
                <option value="">Todos</option>
                <option value="ES" <?php if($get_idioma=="ES"){ ?> selected="selected" <?php } ?> >Español</option>
                <option value="EN" <?php if($get_idioma=="EN"){ ?> selected="selected" <?php } ?> >English</option>
                <option value="PT" <?php if($get_idioma=="PT"){ ?> selected="selected" <?php } ?> >Português</option>
                <option value="CN" <?php if($get_idioma=="CN"){ ?> selected="selected" <?php } ?> >Chino</option>
            </select>
        </div>
        <!-- filtros -->
    </div>