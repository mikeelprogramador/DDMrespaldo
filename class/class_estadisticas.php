<?php
include_once("class_sessiones.php");
Session::iniciarSessiones();

class Estadisticas {

    public static function estadisticasVentas(){
      include_once("../../conf/model.php");
      $salida = "";
      $consulta = Model::sqlVentas();
      while($fila = $consulta->fetch_array()){
        $salida .= "['".$fila[0]."',".$fila[1].", '#b87333'],";
      }
      //Eliminamos la ultima coma que general el texto
     $salida = rtrim($salida,",");
      return $salida;
    }

    public static function ventasPormeses($año){
      include_once("../../conf/model_vista.php");
      include_once("class_funciones.php");
      $salida = "";
      $consulta = ModelVista::sqlVentasPormeses($año);
      while($fila = $consulta->fetch_array()){
        
        $salida .= "['".self::identificarMes($fila[0])."',".$fila[1].", '#b87333'],";
      }
      //Eliminamos la ultima coma que general el texto
     $salida = rtrim($salida,",");
      return $salida;
    }

    public static function totalVentas(){
      include_once("../../conf/model.php");
      include_once("class_funciones.php");
      $total = 0;
      $consulta = Model::sqlTotalVentas();
      while($fila = $consulta->fetch_array()){
        $total += Funciones::intDinero($fila[0]);
      }
      return "['Ingresos',".$total.", '#b87333'],";
    }

    public static function identificarMes($mes){
      if ($mes === "1")$salida = "Enero";
      if ($mes === "2")$salida = "Febrero";
      if ($mes === "3")$salida = "Marzo";
      if ($mes === "4")$salida = "Abril";
      if ($mes === "5")$salida = "Mayo";
      if ($mes === "6")$salida = "Junio";
      if ($mes === "7")$salida = "Julio";
      if ($mes === "8")$salida = "Agosto";
      if ($mes === "9")$salida = "Septiembre";
      if ($mes === "10")$salida = "Octubre";
      if ($mes === "11")$salida = "Noviembre";
      if ($mes === "12")$salida = "Diciembre";
      return $salida;
    }

}
// ["Prodcutos", 8.94, "#b87333"],
// ["Silver", 10.49, "silver"],
// ["Gold", 19.30, "gold"],
// ["Platinum", 21.45, "color: #e5e4e2"]