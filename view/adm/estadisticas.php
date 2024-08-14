<link rel="stylesheet" href="../../css/estadisticas.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php if(isset($_GET['estadisticas']) && $_GET['estadisticas'] === "ventas"):?>
 <div class="scrit">
 <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Compras", { role: "style" } ],
        <?php echo Estadisticas::estadisticasVentas();?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
      { calc: "stringify",
        sourceColumn: 1,
        type: "string",
        role: "annotation" },
      2]);

      var options = {
      title: "Productos con mayor ventas",
      bar: {groupWidth: "95%"},
      legend: { position: "none" },
      };

      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
    }
  </script>
 </div>
<?php endif ?>


<!-- Ingresos totales -->
<?php if(isset($_GET['estadisticas']) && $_GET['estadisticas'] === "ingresosTotales"):?>
<div class="contenedor-ingresosTomales">
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Compras", { role: "style" } ],
        <?php echo Estadisticas::totalVentas();?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
      { calc: "stringify",
        sourceColumn: 1,
        type: "string",
        role: "annotation" },
      2]);

      var options = {
      title: "Productos con mayor ventas",
      bar: {groupWidth: "95%"},
      legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
    }
  </script>
</div>

<?php endif ?>



<!-- Ingresos Mes -->
<?php if(isset($_GET['estadisticas']) && $_GET['estadisticas'] === "ingresosMes"):?>

<div class="contenedor-ingresos-por-meses">
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Compras por mes", { role: "style" } ],
        <?php echo Estadisticas::ventasPormeses(2024);?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
      { calc: "stringify",
        sourceColumn: 1,
        type: "string",
        role: "annotation" },
      2]);

      var options = {
      title: "Productos con mayor ventas",
      bar: {groupWidth: "95%"},
      legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
    }
  </script>
</div>
<?php endif ?>


<div id="chart-container">
  <div id="columnchart_values" style="width: 100%; height: 400px;"></div>
</div>

