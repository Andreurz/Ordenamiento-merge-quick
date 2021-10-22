<?php

Class  Ordenamiento
{
    public $num_fractions = 10;
    public $min_fraction = 0;
    public $next_step = 0;
    public $array_time = array( array("Elementos","Realtime","BigO") );
    public $header = array();

    function __construct() 
    {
       
    }

    public function sort_by_index ($array, $index) {
        usort($array, $this->build_sorter($index));
        return $array;
    }

    public function build_sorter($clave) {
        return function ($a, $b) use ($clave) {
            return strnatcmp($a[$clave], $b[$clave]);
        };
    }

    /* Definicion MergeSort */

    public function mergesort($arr,$index)
    {
        //Determina los puntos donde va a tomar el tiempo
        if( $this->min_fraction == 0 ) 
        {
            $this->min_fraction = count($arr) / 10; 
            $this->next_step = $this->min_fraction; 
        }

        if(count($arr) == 1) return $arr;
        $mid = count($arr) / 2;
        $left = array_slice($arr,0,$mid);
        $right = array_slice($arr,$mid);
        $left = $this->mergesort($left,$index);
        $right = $this->mergesort($right,$index);
        return $this->merge($left,$right,$index);
    }
    
    public function merge($left,$right,$index) 
    {
        $res = array();
        //print "\$left=>"; var_dump($left);print "\n"; 
        //print "\$right=>"; var_dump($right);print "\n"; 
        while(count($left) > 0 && count($right) > 0) 
        {
            //Compara las columnas deseadas y mueve el array completo a la derecha o izquierda
            if($left[0][$index] > $right[0][$index]) {
            $res[] = $right[0];
            $right = array_slice($right,1);
            }else {
            $res[] = $left[0];
            $left = array_slice($left,1);
            }
        }
        while(count($left) > 0) {
            $res[] = $left[0];
            $left = array_slice($left,1);
        }
        while(count($right) > 0)  {
            $res[] = $right[0];
            $right = array_slice($right,1);
        }
        //print "\$result=>";var_dump($res);print "\n"; 
        return $res;
    }

    /* Definicion QuickSort */

    public function quicksort($array,$index)
    {
        if (count($array) < 2) {
            return $array;
        }
        $left = $right = array();
        reset($array);
        $pivot_key = key($array);
        $pivot = array_shift($array);
        foreach ($array as $k => $v) {
            if ($v[$index] < $pivot[$index]) {
                $left[$k] = $v;
            } else {
                $right[$k] = $v;
            }
        }
        return array_merge($this->quicksort($left,$index), array($pivot_key => $pivot), $this->quicksort($right,$index));
    }

    public function SaveCsv($csv)
    {
        $date = date("YmdHis");
        $name_file = $date.".csv";
        $path = "../temp";
        $full_path = "/var/www/html/ordenamiento/temp/".$name_file;

        $fp = fopen($full_path, 'a+');
        $fw = fwrite($fp , $csv);
        fclose($fp);

        return $full_path;
    }

    public function CsvToArray($file)
    {
        $arr = array();
        if (($handle = fopen($file, 'r')) !== FALSE) 
        { // Check the resource is valid
            $i = 0;
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
            { // Check opening the file is OK!
                if($i==0) { $i++; $this->header = $data; continue;}
                array_push($arr,$data); // Array
                $i++;
            }
            fclose($handle);
        }
        return $arr;
    }

    public function ArrayToCsv($array)
    {
        $csv = "";
        $line = "";
        foreach ($array as $key => $value) {
            (is_numeric($key) && $key > 0) ? $key = $key - 1 : $key = $key;
            foreach ($array[$key] as $llave => $valor) {
                $line .= $valor.";"; 
            }
            $csv .= $line." \n ";
            $line = "";
        }
        return $csv;
    }

}
/*
$test = array(
    array("id"=> 1 , "value"=> "2021-04-17" , "perc"=> 0.5),
    array("id"=> 2 , "value"=> "2021-05-17" , "perc"=> 0.7),
    array("id"=> 6 , "value"=> "2021-01-18" , "perc"=> 0.2),
    array("id"=> 4 , "value"=> "2020-04-20" , "perc"=> 0.2),
    array("id"=> 5 , "value"=> "2021-10-11" , "perc"=> 0.3),
    array("id"=> 3 , "value"=> "2019-10-09" , "perc"=> 0.1),
);

$ord = new Ordenamiento();
//$new_array = $ord->sort_by_index($test,"perc"); print_r($new_array);
/*

$arr = array( 5, 1, 2, 6, 3, 4);
//$arr = $ord->mergesort($test,"value");
$arr = $ord->quicksort($test, "value" );
//echo implode(',',$arr);

print_r($arr);
*/

?>