<?php
$root = null;
$rootPos = null;
$counter = 0;
$tree = array();
$sentinel = 0;

function startTree()
{
    $GLOBALS['rootPos'] = 0;
    $GLOBALS['counter'] += 1;
    $GLOBALS['tree'][0] = array(
        "value" => null,
        "sons" => array(),
    );
    return true;
}

function insertTree(string $word)
{
    $arrWord = str_split($word);
    $chave = 0;

    foreach ($arrWord as $key => $value) {  
        if ($key == 0) {
            $search = searchArrayWord($value,$chave);
            $chave = $search;
        }else {
            $search = searchArrayWord($value,$chave);
        }

        /* var_dump($search);
        echo "<h1>". $chave . "</h1>"; */

        if (!$search) {
            $GLOBALS['counter'] += 1;
            $GLOBALS['tree'][$GLOBALS['counter']] = array(
                "value" => $value,
                "sons" => array(),
            );
            $GLOBALS['tree'][$chave]['sons'][] = $GLOBALS['counter'];
            $chave = $GLOBALS['counter'];
        }else {
            $chave = $search;
        }
    }
}

function searchTree(string $word)
{
    $arrWord = str_split($word);
    $count = 0;
    $chave = 0;

    foreach ($arrWord as $key => $value) {

        $myIndex = searchArrayWord($value,$chave);
        $chave = $myIndex;

        //echo "<h1>". $myIndex . "</h1>";
        
        if (!$myIndex) {
            return false;
        }else {
            $count += 1;
        }

        if ($count >= count($arrWord)) {
            return true;
        }
    }
    
}

function searchArrayWord(string $char,$key = 0)
{
    if (empty($GLOBALS['tree'][$key]['sons'])) {
        return false;
    }
    foreach ($GLOBALS['tree'][$key]['sons'] as $key => $value) {
        if ($GLOBALS['tree'][$value]['value'] == $char) {
            return $value;
        }
    }

    return false;
}
startTree();
insertTree("kevin");
insertTree("kepler");
insertTree("abacaxi");
var_dump($GLOBALS['tree']);
var_dump(searchTree("kevin"));
var_dump(searchTree("kepler"));
?>