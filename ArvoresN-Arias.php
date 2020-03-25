<?php
$root = null;
$rootPos = null;
$counter = 0;
$tree = array();
$maxSonElements = 3;
$sentinel = 0;

function startTree($val)
{
    if ($GLOBALS['root'] === null & $val !== null) {
        $GLOBALS['root'] = $val;
        $GLOBALS['rootPos'] = 0;
        $GLOBALS['counter'] += 1;
        $GLOBALS['tree'][0] = array(
            "value" => $val,
            "num" => 0,
            "parent" => -1,
        );
        return true;
    }

    return false;
}

function insertTree($val)
{
    if ($val  < 0) {
        return false;
    }

    $index = $GLOBALS['sentinel'];
    if ($GLOBALS['tree'][$index]['num'] < $GLOBALS['maxSonElements']) {

        $GLOBALS['tree'][$index]['num'] += 1;
        $GLOBALS['tree'][$GLOBALS['counter']] = array(
            "value" => $val,
            "num" => 0,
            "parent" => $index,
        );
        $GLOBALS['counter'] += 1;
        return true;
    }else {
        $GLOBALS['sentinel'] += 1;
        insertTree($val);
    }
    //Primeira implementação funcional - First implementation working correctly
    /* foreach ($GLOBALS['tree'] as $key => $value) {
        if ($value['num'] < $GLOBALS['maxSonElements']) {
            $GLOBALS['tree'][$key]['num'] += 1;
            $GLOBALS['tree'][] = array(
                "value" => $val,
                "num" => 0,
                "parent" => $key,
            );
            return true;
        }
    } */

    return false;
}

function showTree()
{
    if ($GLOBALS['root'] === null) {
        return false;
    }

    foreach ($GLOBALS['tree'] as $key => $value) {
        echo "<br><h4 style='background-color:#2196f3;'>------------------------------------</h4>";
        
        var_dump($value);
        if ($GLOBALS['tree'][$key]['num'] > 0) {

            if ($key == 0) {

                $limit = $GLOBALS['tree'][$key]['num']+1;
                for ($i=1; $i < $limit; $i++) { 

                    echo "<br><h4 style='background-color:#cae7ff;'>***********</h4>";
                    var_dump($GLOBALS['tree'][$i]);
                }
            }else {
                $limit = ($key+1)*$GLOBALS['tree'][$key]['num'];
                for ($i=$key; $i < $limit; $i++) { 

                    echo "<br><h4 style='background-color:#cae7ff;'>***********</h4>";
                    var_dump($GLOBALS['tree'][$i]);
                }
            }
        }
    }
    echo "<br>------------------------------------";
}

function showTree2($ind = 0)
{
    if ($GLOBALS['root'] === null) {
        return false;
    }

    if ($ind > ($GLOBALS['counter']-1) || $ind < 0) {
        return false;
    }
    echo "<h3>HEAD ELEMENT:<br>";
    var_dump($GLOBALS['tree'][$ind]);
    echo "</h3>";

    $index = $ind;
    $count = 0;

    if ($GLOBALS['tree'][$ind]['num'] > 0) {
        while ($GLOBALS['tree'][$ind]['num'] !==  $count) {
            $index += 1;
            if ($GLOBALS['tree'][$index]['parent'] == $ind) {
                $count +=1;
                echo "<br>***";
                var_dump($GLOBALS['tree'][$index]);
                echo "***";
            }
        }
    }

    if ($ind <= $GLOBALS['counter']) {
        $ind += 1;
        $i = $ind;
        showTree2($i);
    }else {
        return;
    }

    //echo "<h1>".$ind."---".$GLOBALS['counter']."</h1>";
}

function searchKey($key)
{
    if ($GLOBALS['root'] === null || $key === null) {
        return false;
    }

    if ($key > ($GLOBALS['counter']-1) || $key < 0) {
        return false;
    }

    return $GLOBALS['tree'][$key];
}

function searchValue($val)
{
    if ($GLOBALS['root'] === null || $val === null) {
        return false;
    }

    foreach ($GLOBALS['tree'] as $key => $value) {
        if ($value['value'] == $val) {
            return $GLOBALS['tree'][$key];
        }
    }

    return false;
}

function deleteValue($key)
{
    $check = searchKey($key);
    if (!$check) {
       return false;
    }
    
    $lastInsertedElement = $GLOBALS['tree'][$GLOBALS['counter']-1];

    $GLOBALS['tree'][$key]['value'] = $lastInsertedElement['value'];
    $GLOBALS['tree'][$lastInsertedElement['parent']]['num'] -= 1;
    $GLOBALS['tree'][$GLOBALS['counter']-1]['value'] = null;
    if (($GLOBALS['counter']-1)%3 === 0 && $GLOBALS['sentinel'] > 0) {
        $GLOBALS['sentinel'] -= 1;
    }
    $GLOBALS['counter']-=1;
    
}

startTree(35);
insertTree(10);
insertTree(50);
insertTree(80);
/* insertTree(100); */
//showTree();
var_dump($GLOBALS['tree']);
/* echo $GLOBALS['root'];
var_dump( searchValue(100));
var_dump( searchKey(0)); */
showTree2();
/* deleteValue(0);
echo "<h1>".insertTree(100)."</h1>";
var_dump($GLOBALS['tree']);
/* insertTree(100); */
/*showTree2(); */

?>