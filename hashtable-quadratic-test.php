<?php
$hashTable = array();
$l = [30, 50, 45]; //numero de entradas

function insertHash($value, $j = 0)
{
    $m = count($GLOBALS['l']) + 1;

    $hk = $value % $m; 
    $hjK = ($hk + $j * $j) % $m; 

    if (empty($GLOBALS['hashTable'][$hjK])) {
        $GLOBALS['hashTable'][$hjK] = $value;
        return 1;

    }elseif ($GLOBALS['hashTable'][$hjK] == $value) {
        return 1;

    }else {
        return insertHash($value,$j+1);
    }
}

function searchHash($value, $j = 0)
{
    $m = count($GLOBALS['l']) + 1;

    $hk = $value % $m;
    $hjK = ($hk + $j * $j) % $m; 

    if (empty($GLOBALS['hashTable'][$hjK])) {
        return -1;

    }elseif ($GLOBALS['hashTable'][$hjK] == $value) {
        return $hjK;

    }else {
        return searchHash($value,$j+1);
    }
}

function removeHash($value, $j = 0)
{
    $m = count($GLOBALS['l']) + 1;

    $hk = $value % $m;
    $hjK = ($hk + $j * $j) % $m; 

    if (empty($GLOBALS['hashTable'][$hjK])) {
        return true;

    }elseif ($GLOBALS['hashTable'][$hjK] == $value) {
        unset($GLOBALS['hashTable'][$hjK]);
        return true;

    }else {
        return removeHash($value,$j+1);
    }
    
}

for ($i=0; $i < count($l); $i++) { 
    $val = $l[$i];
    insertHash($val);
}

//echo removeHash(50, $j = 0);
var_dump($hashTable);
echo searchHash(30, $j = 0)
?>