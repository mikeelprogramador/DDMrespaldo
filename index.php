<?php
/*
* Autor Mike
* Editor juan 
* Programa ADSO SENA 
*/

if( file_exists('instalador.php') == true){
    header("location: instalar.php");

}else{
    header("location: login.php");
}