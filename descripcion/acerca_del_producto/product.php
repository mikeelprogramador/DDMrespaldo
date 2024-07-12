<?php
include_once("../../metodos/clas-view.php");
include_once("../../metodos/clas-functions.php");
include_once("../../cajon/bootstrap/bootstrap.php");
if(!isset( $_SESSION))session_start();
if(!isset($_SESSION['id'])){
    header("location: ../../erro.php");
}else if($_SESSION['id'] == ""){
    header("location: ../../erro.php");
}
if( !isset($_GET['http'])){
    header("location: ../../erro.php");
}
if($_GET['http'] != $_SESSION['token']){
    header("location: ../../erro.php");
}

if(isset($_GET['question'])){
    if($_GET['question'] == true){
        ?><Script>
            window.onload = function() {
            alertCarrito(1);
            };
        </Script><?php  
    }if($_GET['question'] == "false"){
        ?><Script>
        window.onload = function(){
            alertCarrito(2);
        };
    </Script><?php   
    }if($_GET['question'] == "existe"){
        ?><Script>
        window.onload = function(){
            alertCarrito(3);
        };
        </Script><?php 
    }
    if($_GET['question'] == 0){
        ?><Script>
        window.onload = function(){
            alertCarrito(4);
        };
        </Script><?php 
    }
}



$seccion = "producto";
include($seccion.".php");
