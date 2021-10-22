<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('memory_limit', '1024M');


include_once "/var/www/html/ordenamiento/app/ordenamiento.class.php";

$ord = new Ordenamiento();

if ($_POST['funcion'] == "MergeSort") { print MergeSort($_POST['data'], $_POST['index'] , $ord); } 
elseif ($_POST['funcion'] == "QuickSort") { print QuickSort($_POST['data'], $_POST['index'], $ord); } 
else{
    print "NO existe la funcion";
}



function MergeSort($csv , $index, $ord )
{
    //$ord = new Ordenamiento();
    $file = $ord->SaveCsv($csv);
    $arreglo = $ord->CsvToArray($file);

    
    //Inicial un bucle de 0 hasta n dividiendo en 10 bloques
    $cantidad = count($arreglo);
    $step = $cantidad / 10;
    //$ord->array_time = array( array("Elementos","Realtime","BigO") );
    //if (count($ord->array_time) == 0)  { $ord->array_time = array( array("Elementos","Realtime","BigO") ) };

    $new_array = array();
    $arr = array();
    $n = 1;

    for ($i=$step; $i <= $cantidad ; $i ) 
    { 
        foreach (range(1, $i) as $k) {
            array_push($new_array,$arreglo[$k-1]);
        }
        
        //Captura el tiempo que tarda la funcion y organiza la informacion
        $start = microtime(true);
        $arr = $ord->mergesort($new_array,$index);
        $end = microtime(true);
        $time = $end - $start;
        //$time = number_format($time, 3, '.', '');
        //$bigo = ($i * log($i)) / 10000;
        //$bigo = (float)number_format($bigo, 3, '.', '');
        //array_push($array_time, array($i,$time,$bigo) );
        $ord->array_time[$n][0] = $i;
        $ord->array_time[$n][1] = $time;
        $ord->array_time[$n][2] = ( !array_key_exists(2,$ord->array_time[$n]) || is_null($ord->array_time[$n][2])) ? 0 : $ord->array_time[$n][2];
        
        $i = $i+$step;
        $n++;

    }

    array_unshift($arr,$ord->header);
    $new_csv = $ord->ArrayToCsv($arr);
    
    $json = json_encode( 
        array("csv" => $new_csv , "time" => $ord->array_time )
    );
    return $json;
    
}

function QuickSort($csv , $index, $ord )
{
    //$ord = new Ordenamiento();
    $file = $ord->SaveCsv($csv);
    $arreglo = $ord->CsvToArray($file);

    
    //Inicial un bucle de 0 hasta n dividiendo en 10 bloques
    $cantidad = count($arreglo);
    $step = $cantidad / 10;
    //$ord->array_time = array( array("Elementos","Realtime","BigO") );
    //if (count($ord->array_time) == 0)  { $ord->array_time = array( array("Elementos","Realtime","BigO") ) };

    $new_array = array();
    $arr = array();
    $n = 1;

    for ($i=$step; $i <= $cantidad ; $i ) 
    { 
        foreach (range(1, $i) as $k) {
            array_push($new_array,$arreglo[$k-1]);
        }
        
        //Captura el tiempo que tarda la funcion y organiza la informacion
        $start = microtime(true);
        $arr = $ord->sort_by_index($new_array,$index);
        $end = microtime(true);
        $time = $end - $start;
        //$time = number_format($time, 3, '.', '');
        //$bigo = ($i * log($i)) / 10000;
        //$bigo = (float)number_format($bigo, 3, '.', '');
        //array_push($array_time, array($i,$time,$bigo) );
        $ord->array_time[$n][0] = $i;
        $ord->array_time[$n][1] = ( !array_key_exists(2,$ord->array_time[$n]) || is_null($ord->array_time[$n][1])) ? 0 : $ord->array_time[$n][1];
        $ord->array_time[$n][2] = $time;
        
        $i = $i+$step;
        $n++;

    }

    array_unshift($arr,$ord->header);
    $new_csv = $ord->ArrayToCsv($arr);
    
    $json = json_encode( 
        array("csv" => $new_csv , "time" => $ord->array_time )
    );
    return $json;
    
}



?>