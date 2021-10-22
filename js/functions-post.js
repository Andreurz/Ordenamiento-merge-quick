var data_original = "";
var titulo_data = [];

function leerArchivo(e) {
    var archivo = e.target.files[0];
    if (!archivo) {
      return;
    }
    var lector = new FileReader();
    lector.onload = function(e) {
      var contenido = e.target.result;
      mostrarContenido(contenido);
    };
    lector.readAsText(archivo);
  }
  
  function mostrarContenido(contenido) {
    //var elemento = document.getElementById('contenido-archivo');
    //elemento.innerHTML = contenido;
    
    data_original = contenido;
    CsvToTable(contenido,'nav-data');
  }
  
  document.getElementById('file-input').addEventListener('change', leerArchivo, false);
  
  
    function CsvToTable(txt,nav)
    {
      //console.log("CsvToTable: "+txt);
      // Poner aquí los índices de columnas a mostrar
      let columnas = [0,1,2,3,4]; // No mostrar números
  
      // Separar por líneas: .split('\n')
      // Recorrer .map()
      // Eliminar ; del final de la línea item.substring(0, item.length - 1) evita un elemento vacío
      // Separar por ; .split(';')
      let data = txt.split('\n').map(item => item.substring(0, item.length - 1).split(';'));
  
      // No necesitas una estructura muy elaborada:
      //console.log(data);
  
      // Crear tabla, encabezado (thead) y cuerpo (tbody)
      let table = document.createElement('table');
      let thead = document.createElement('thead');
      let tbody = document.createElement('tbody');
  
      // Crear encabezados con datos de la primera fila
      let tr = document.createElement('tr');
      // Recorrer por elemento e índice
      data[0].forEach((titulo, index) => {
          // Verificar que el índice está en el arreglo de columnas
          if(columnas.includes(index)) {
              // Crear celda de título, asignar contenido y agregar a fila
              let th = document.createElement('th');
              titulo_data.push(titulo);
              th.textContent = titulo;
              tr.appendChild(th);
          }
      });
      // Agregar fila a encabezado
      thead.appendChild(tr);
  
      // Recorrer resto de arreglo para agregar a cuerpo de tabla
      for(let i = 1; i < data.length; i++) {
          let tr = document.createElement('tr');
          // Recorrer cada elemento para crear celda
          data[i].forEach((texto, index) => {
              if(columnas.includes(index)) {
                  let td = document.createElement('td');
                  td.textContent = texto;
                  
                    tr.className += "table-primary";
                  tr.appendChild(td);
              }
          });
          // Agregar fila a cuerpo
          tbody.appendChild(tr);
      }
  
  
      // Agregar encabezados y cuerpo a tabla
      table.appendChild(thead);
      table.appendChild(tbody);
  
      // Agregar tabla al documento
      table.className += " table table-hover ";
      table.tagName = "tabla";
      document.getElementById(nav).appendChild(table);
      //var tabla = document.getElementsByTagName("table");
      //document.body.appendChild(table);
  }

  function Sort(funcion, nav)
{
      var valores = {
          "funcion":              funcion,
          "data":                 data_original,
          "index":                2
      };
      //console.log("Valores: ");
      //console.log(valores);
      var delayMillis = 30000; //3 segundos
      var json = "";
      $.ajax({
          data: valores,
          url: 'app/endpoint.api.php',
          type: 'post',
          beforeSend: function(){
              //$("#resultado").html("Procesando, espere por favor...");
              console.log("procesando...");
          },
          success: function (response){
              
              //Imprime los valores en la tabla
              console.log("Respuesta ");
              console.log(response);  
              
              arreglo = JSON.parse(response);
              console.log(arreglo["time"]); 
              json = JSON.stringify(arreglo["time"]); 
              CsvToTable(arreglo["csv"],nav);

              //Imprime la gráfica de medicion
              
              values = arreglo["time"];
              console.log("Tiempos:");
              console.log(values);
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);     
                     

          },
          error: function() {
              alert('Error al consultar la gráfica de tiempos');
          }
      });

  }
/*
  values = [
    ['Year', 'Sales', 'Expenses', 'step'],
    ['2004',  1000,      400 , 1000],
    ['2005',  1170,      460, 2000],
    ['2006',  660,       1120, 3000],
    ['2007',  1030,      540, 4000]
  ];
  */


  function drawChart() {
    var data = google.visualization.arrayToDataTable(values);

    var options = {
      title: 'Company Performance',
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
  }








