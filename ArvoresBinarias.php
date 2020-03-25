<?php

$root = null;
$contadorNivel = 0;
$biggest = null;
$smallest = null;

$arvore = array();

function inicializa(&$enderecoNo = null)
{
    $GLOBALS['root'] = $enderecoNo;
    return $enderecoNo;
}

function insereArvore($val)
{
    if ($GLOBALS['root'] === null) {

        $GLOBALS['root'] = $val;

        $GLOBALS['arvore'][0] = array(
            "value" => $val,
            "menor" => null,
            "maior" => null,
        );

        $GLOBALS['biggest'] = 0;
        $GLOBALS['smallest'] = 0;

    }else {

        verificaNo($val);

    }  
    return true;
}

function verificaNo($val)
{
    $pos = 0;
    $anteriorPos = $pos;

    $m = array(
        "value" => $val,
        "menor" => null,
        "maior" => null,
    ); 

    $mySearch = $GLOBALS['arvore'][$pos];

    while (!empty($GLOBALS['arvore'][$pos]) || $pos == 0) {
        $anteriorPos = $pos;

        if ($val === $GLOBALS['arvore'][$pos]['value']){
            return false;
        }

        if ($val < $GLOBALS['arvore'][$pos]['value']) {

           if ($GLOBALS['arvore'][$pos]['menor'] === null) {
                $pos = 2 * $pos + 1;
                $GLOBALS['arvore'][$anteriorPos]['menor'] = $pos;
                $GLOBALS['arvore'][$pos] = $m;
                return true;
           }else {
                $pos = 2 * $pos + 1;
           }
        }else {
            if ($GLOBALS['arvore'][$pos]['maior'] === null) {
                $pos = 2 * $pos + 2;
                $GLOBALS['arvore'][$anteriorPos]['maior'] = $pos;
                $GLOBALS['arvore'][$pos] = $m;
                return true;
           }else {
                $pos = 2 * $pos + 2;
           }
        }
    }
}

function buscaElemento($val)
{
    $pos = 0;

    while (!empty($GLOBALS['arvore'][$pos]) || $pos == 0) {

        if ($val === $GLOBALS['arvore'][$pos]['value']){
            return $GLOBALS['arvore'][$pos];
        }

        if ($val < $GLOBALS['arvore'][$pos]['value']) {
            
           if ($GLOBALS['arvore'][$pos]['menor'] !== null) {
                $pos = $GLOBALS['arvore'][$pos]['menor'];
           }else {
               return false;
           }

        }else {
            if ($GLOBALS['arvore'][$pos]['maior'] !== null) {
                $pos = $GLOBALS['arvore'][$pos]['maior'];
            }else {
                return false;
            }
        }

        echo "----------------" . $pos . "----------------<br>";
    }

    return false;
}

function treeSize()
{
    return count($GLOBALS['arvore']);
}

function exibirArvore()
{
    $maior = 0;

    foreach ($GLOBALS['arvore'] as $key => $value) {
        if ($key > $maior) {
            $maior = $key;
        }
    }

    $level = 1;
    $controller = 1;
    echo "<br>ARVORE BINARIA<br>";

    echo "<h1>------>>>>>>>Nivel: ".$level."<<<<<<<------</h1>";

    for ($i = 0; $i < $controller; $i++) { 
        
        if (!empty($GLOBALS['arvore'][$i])) {

           var_dump($GLOBALS['arvore'][$i]);  
           echo $i;
        }

        if ($i >= $maior) {
            echo "<br>FIM ARVORE BINARIA<br>";
            return;
        }

        if ($i == ($controller-1)) {
            $p = $i;
            if ($i <= 0) {
                $p = 1;
            }

            $level +=1;
            
            $ctrl =  2 ** $p;
            $ctrl += $i;
            $ctrl += 1;

            echo "<h1>------>>>>>>>Nivel: ".$level."<<<<<<<------</h1>";
            $controller = $ctrl;
        }
    } 
}


function removerNo($val)
{
    if ($val === null) {
        return false;
    }

    $m = array(
        "value" => null,
        "menor" => null,
        "maior" => null,
    );

    $chave = buscaChave($val);
    $pos = $chave;

    $novoGalho = null;
    $chaveNovoGalho = null;

    if($val > $GLOBALS['root']){
        while (!empty($GLOBALS['arvore'][$pos])) {
            if ($GLOBALS['arvore'][$pos]['menor'] === null) {
                $novoGalho = $GLOBALS['arvore'][$pos];
                $chaveNovoGalho = $pos;

                $GLOBALS['arvore'][$chave]['value'] = $novoGalho['value'];

                if ($GLOBALS['arvore'][$chaveNovoGalho]['maior'] !== null) {
                    
                    $ind = $GLOBALS['arvore'][$chave]['menor'];
                    $GLOBALS['arvore'][$ind]['menor'] = $GLOBALS['arvore'][$chaveNovoGalho]['maior'];
                    $GLOBALS['arvore'][$chaveNovoGalho] = $GLOBALS['arvore'][$novoGalho['maior']];

                    foreach ($GLOBALS['arvore'] as $key => $value) {
                        if ($value['menor'] == $chaveNovoGalho) {
                            $GLOBALS['arvore'][$key]['menor'] = 
                            $GLOBALS['arvore'][$chaveNovoGalho]['maior'];
                            break;
                        }

                        if ($value['maior'] == $chaveNovoGalho) {
                            $GLOBALS['arvore'][$key]['maior'] = 
                            $GLOBALS['arvore'][$chaveNovoGalho]['maior'];
                            break;
                        }
                    }
            
                }else {
                    $GLOBALS['arvore'][$chave]['value'] = $novoGalho['value'];
                    foreach ($GLOBALS['arvore'] as $key => $value) {
                        if ($value['menor'] == $chaveNovoGalho) {
                            $GLOBALS['arvore'][$key]['menor'] = null;
                            break;
                        }

                        if ($value['maior'] == $chaveNovoGalho) {
                            $GLOBALS['arvore'][$key]['maior'] = null;
                            break;
                        }
                    }

                    $GLOBALS['arvore'][$chaveNovoGalho] = $m;

                }
                break;
            }else {
                $pos = 2 * $pos + 1;
            } 
        }
    }else {
        while (!empty($GLOBALS['arvore'][$pos])) {

            if ($GLOBALS['arvore'][$pos]['maior'] === null) {
                
                $novoGalho = $GLOBALS['arvore'][$pos];
                $chaveNovoGalho = $pos;

                $GLOBALS['arvore'][$chave]['value'] = $novoGalho['value'];

                if ($GLOBALS['arvore'][$chaveNovoGalho]['menor'] !== null) {
                    
                    $ind = $GLOBALS['arvore'][$chave]['maior'];
                    $GLOBALS['arvore'][$ind]['maior'] = $GLOBALS['arvore'][$chaveNovoGalho]['menor'];
                    $GLOBALS['arvore'][$chaveNovoGalho] = $GLOBALS['arvore'][$novoGalho['maior']];

                    foreach ($GLOBALS['arvore'] as $key => $value) {
                        if ($value['menor'] == $chaveNovoGalho) {
                            $GLOBALS['arvore'][$key]['menor'] = 
                            $GLOBALS['arvore'][$chaveNovoGalho]['maior'];
                            break;
                        }

                        if ($value['maior'] == $chaveNovoGalho) {
                            $GLOBALS['arvore'][$key]['maior'] = 
                            $GLOBALS['arvore'][$chaveNovoGalho]['maior'];
                            break;
                        }
                    }
            
                }else {
                    $GLOBALS['arvore'][$chave]['value'] = $novoGalho['value'];
                    foreach ($GLOBALS['arvore'] as $key => $value) {
                        if ($value['menor'] == $chaveNovoGalho) {
                            $GLOBALS['arvore'][$key]['menor'] = null;
                            break;
                        }

                        if ($value['maior'] == $chaveNovoGalho) {
                            $GLOBALS['arvore'][$key]['maior'] = null;
                            break;
                        }
                    }
                    $GLOBALS['arvore'][$chaveNovoGalho] = $m;
                }
                break;
            }else {
                $pos = 2 * $pos + 2;
            } 
        }
    }
}

function buscaChave($val)
{
    foreach ($GLOBALS['arvore'] as $key => $value) {
        if ($value['value'] == $val) {
            return $key;
        }
    }

    return false;
}
inicializa($root);
insereArvore(37);
insereArvore(200);
insereArvore(400);
//var_dump($GLOBALS['arvore']);
insereArvore(85);
insereArvore(55);
insereArvore(3);
insereArvore(300);
insereArvore(800);
insereArvore(10);
insereArvore(1);
insereArvore(3);

//var_dump(buscaElemento(400));
//echo treeSize();
var_dump($GLOBALS['arvore']);
exibirArvore();
//removerNo(10);
exibirArvore();

?>