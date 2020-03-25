<?php
$hashTable = array();
$l = [30, 50, 45]; //numero de entradas
$linkedList = array();

function insertHash($value)
{
    $m = count($GLOBALS['l']) + 1;

    $hk = $value % $m; 

    if (empty($GLOBALS['hashTable'][$hk])) {

        $GLOBALS['linkedList'][] = array(
            "valor"  => $value,
            "prox"  => null,
        );

        $GLOBALS['hashTable'][$hk] = array(
            "inicio"  => count($GLOBALS['linkedList'])-1,
            "fim"  => count($GLOBALS['linkedList'])-1,
        );

        return 1;

    }else {
        $index = $GLOBALS['hashTable'][$hk]['fim'];

        $GLOBALS['linkedList'][$index]['prox'] = 
        count($GLOBALS['linkedList']);

        $GLOBALS['linkedList'][] = array(
            "valor"  => $value,
            "prox"  => null,
        );

        $GLOBALS['hashTable'][$hk]['fim'] = count($GLOBALS['linkedList'])-1;
    }
}

function searchHash($value)
{
    $m = count($GLOBALS['l']) + 1;

    $hk = $value % $m; 

    if (empty($GLOBALS['hashTable'][$hk])) {
        return -1;
    }

    $start = $GLOBALS['hashTable'][$hk]['inicio'];
    $next = $start;

    while ($next !== null) {

        if ($value == $GLOBALS['linkedList'][$next]['valor']) {
            return $next;
        }

        $next = $GLOBALS['linkedList'][$next]['prox'];
    }

    return -1;
}

function removeHash($value)
{
    $m = count($GLOBALS['l']) + 1;

    $hk = $value % $m; 

    if (empty($GLOBALS['hashTable'][$hk])) {
        return false;
    }

    $start = $GLOBALS['hashTable'][$hk]['inicio'];
    $next = $start;
    $anterior = $start;

    if (empty($GLOBALS['linkedList'][$next]['prox'])) {
        return false;
    }

    while ($GLOBALS['linkedList'][$next] !== null) {

        if ($value == $GLOBALS['linkedList'][$next]['valor'] &&
        empty($GLOBALS['linkedList'][$next]['status'])) {

            $GLOBALS['linkedList'][$anterior]['prox'] = 
            $GLOBALS['linkedList'][$next]['prox'];

            $GLOBALS['linkedList'][$next]['status'] = "deleted";
            return true;
        }

        if (empty($GLOBALS['linkedList'][$next]['prox'])) {
            return false;
        }

        $anterior = $next;
        $next = $GLOBALS['linkedList'][$next]['prox'];
    }

    return false;
}

for ($i=0; $i < count($l); $i++) { 
    $val = $l[$i];
    insertHash($val);
}

var_dump(removeHash(150));
echo removeHash(30);
echo removeHash(150);

var_dump($hashTable);

var_dump($linkedList);

echo searchHash(75615);

?>