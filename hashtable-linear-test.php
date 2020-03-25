<?php
$hashTable = array();
$l = [30, 50, 45]; //numero de entradas

function insertHash($value, $j = 0)
{
    $m = count($GLOBALS['l']) + 1;

    $hk = $value % $m; // faz o modulo do valor pelo comprimento do m
    $hjK = ($hk + $j) % $m; //modulo do m do valor + j

    if (empty($GLOBALS['hashTable'][$hjK])) { 
    //se não tiver elemento na posicao insere
        $GLOBALS['hashTable'][$hjK] = $value;
        return 1;

    }elseif ($GLOBALS['hashTable'][$hjK] == $value) {
    //se o valor ja existe retorna
        return 1;

    }else {
    //chamada recursiva para incrementar o j até achar uma posição livre
        return insertHash($value,$j+1);
    }
}

function searchHash($value, $j = 0)
{
    $m = count($GLOBALS['l']) + 1;

    $hk = $value % $m;
    $hjK = ($hk + $j) % $m; 

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
    $hjK = ($hk + $j) % $m; 

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

echo removeHash(50, $j = 0);
var_dump($hashTable);
echo searchHash(30, $j = 0)
?>