<?php

?>

<html lang="es-ES">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ordenamiento </title>

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



</head>

<body>

<input type="file" id="file-input" class="btn btn-success" />
<div style = " padding-top: 20px;">
<button onclick="Sort('MergeSort','nav-merge')" class="btn btn-primary"> MergeSort </button>
<button onclick="Sort('QuickSort','nav-quick')" class="btn btn-primary"> QuickSort </button>
<button onclick="BenchmarkSort()" class="btn btn-primary"> Benchmark </button>
</div>

<h3><br>Tablas de Ordenamiento:</h3>
<pre id="contenido-archivo"></pre>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-data-tab" data-bs-toggle="tab" data-bs-target="#nav-data" type="button" role="tab" aria-controls="nav-data" aria-selected="true">Data</button>
    <button class="nav-link" id="nav-quick-tab" data-bs-toggle="tab" data-bs-target="#nav-quick" type="button" role="tab" aria-controls="nav-quick" aria-selected="false">QuickSort</button>
    <button class="nav-link" id="nav-merge-tab" data-bs-toggle="tab" data-bs-target="#nav-merge" type="button" role="tab" aria-controls="nav-merge" aria-selected="false">MergeSort</button>
    <button class="nav-link" id="nav-dashboard-tab" data-bs-toggle="tab" data-bs-target="#nav-dashboard" type="button" role="tab" aria-controls="nav-dashboard" aria-selected="false">Dashboard</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-data" role="tabpanel" aria-labelledby="nav-data-tab"> </div>
  <div class="tab-pane fade" id="nav-quick" role="tabpanel" aria-labelledby="nav-quick-tab"></div>
  <div class="tab-pane fade" id="nav-merge" role="tabpanel" aria-labelledby="nav-merge-tab"></div>
  <div class="tab-pane fade" id="nav-dashboard" role="tabpanel" aria-labelledby="nav-dashboard-tab">
  <div id="curve_chart" style="width: 900px; height: 500px"></div>

  </div>
</div>


<!-- Importacion de recursos javascript -->
<script src="js/functions-post.js"></script>

</body>

</html>