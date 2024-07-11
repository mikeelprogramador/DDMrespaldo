<?php
if(!isset($_SESSION))session_start();

class Estadisticas {

    public static function estadisticasVentas(){
      include_once("modelo.php");
      $salida = "";
      $consulta = Model::sqlVentas();
      while($fila = $consulta->fetch_array()){
        $salida .= "['".$fila[0]."',".$fila[1].", '#b87333'],";
      }
      //Eliminamos la ultima coma que general el texto
     $salida = rtrim($salida,",");
      return $salida;
    }

    public static function estadisticasComprasUser(){
      include_once("modelo.php");
      $salida = "";
      $consulta = Model::sqlComprasDelUsuario();
      while($fila = $consulta->fetch_array()){
        $salida .= "Usuario: ".$fila[0]."<br>";
        $salida .= "Numero de compras realizadas: ".$fila[1]."<br><br>";
      }
      return $salida;
    }

}
// ["Prodcutos", 8.94, "#b87333"],
// ["Silver", 10.49, "silver"],
// ["Gold", 19.30, "gold"],
// ["Platinum", 21.45, "color: #e5e4e2"]