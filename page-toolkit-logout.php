<?php 
/* 
Template Name: Toolkit - Logout, Salir
*/ 
session_unset();  
session_destroy();  
header("Location:".get_bloginfo('url')."/ingresa");
exit;
?>