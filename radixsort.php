<?php
$l = [25, 57, 48, 37, 12, 92, 330];
$numDigits = 0;

function getMax()
{
    $conj = $GLOBALS['l'];
    $biggestElemPos = 0;

    for ($i=0; $i < count($conj); $i++) { 
        if ($conj[$i] > $conj[$biggestElemPos]) {
            $biggestElemPos = $i;
        }
    }

    return $biggestElemPos;
}

function convertNumbers()
{
    $conj = $GLOBALS['l'];

    $biggestElemPos = getMax();
    $array  = array_map('intval', str_split($conj[$biggestElemPos]));
    $GLOBALS['numDigits'] = count($array);

    for ($i=0; $i < count($conj); $i++) { 
        $newValue  = array_map('intval', str_split($conj[$i]));

        if (count($newValue) < count($array)) {
            
           $limit = count($array) - count($newValue);

           foreach ($newValue as $key => $value) {
                $newValue[$limit + $key] = $value;
           }

           for ($p=0; $p < $limit; $p++) { 
               $newValue[$p] = 0;
           }
        }

        $GLOBALS['l'][$i] = $newValue;
    }
}

function radixSort()
{
    $maxDigits = $GLOBALS['numDigits'];
    $conj = $GLOBALS['l'];
    $separadores = array(
       0 => array(),
       1 => array(),
       2 => array(),
       3 => array(),
       4 => array(),
       5 => array(),
       6 => array(),
       7 => array(),
       8 => array(),
       9 => array(),
    );
    $newConj = array();

    for ($i=$maxDigits-1; $i >= 0; $i--) { 

        foreach ($conj as $key => $value) {
            $separadores[$value[$i]][] = $key;
            //var_dump($value[$i]);
        }

        foreach ($separadores as $key => $value) {
            foreach ($value as $k => $v) {
                $newConj[] = $conj[$v];
            }
        }

        $conj = $newConj;
        $GLOBALS['l'] = $newConj;
        $separadores = array(
            0 => array(),
            1 => array(),
            2 => array(),
            3 => array(),
            4 => array(),
            5 => array(),
            6 => array(),
            7 => array(),
            8 => array(),
            9 => array(),
         );
        $newConj = array();      
    }

    transformNumber();
}

function transformNumber()
{
    $conj = $GLOBALS['l'];
    $maxDigits = $GLOBALS['numDigits'];

    foreach ($conj as $key => $value) {
        $number = '';
        foreach ($value as $k => $v) {
            if ($v !== 0 || $k >= $maxDigits-1) {
                $number .= $v;
            }
        }
        $conj[$key] = intval($number);
    }

    $GLOBALS['l'] = $conj;
}


convertNumbers();
//var_dump($l);
radixSort();
var_dump($l);
?>