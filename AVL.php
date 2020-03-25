<?php
$root = null;
$contadorPos = 0;
$levels = 1;
$balanceamento = 0;

function inicializa(&$enderecoNo = null)
{
    $GLOBALS['root'] = $enderecoNo;
    return $enderecoNo;
}

function insereArvore($val)
{
    if ($GLOBALS['root'] === null) {

        $GLOBALS['root'] = $val;
        $GLOBALS['contadorPos'] = 1;

        $GLOBALS['arvore'][0] = array(
            "value" => $val,
            "menor" => null,
            "maior" => null,
            "balanceamento" => 0,
        );

    }else {
        verificaNo($val);
    }  
    return true;
}

function verificaNo($val,$pos = 0)
{
    $m = array(
        "value" => $val,
        "menor" => null,
        "maior" => null,
        "balanceamento" => 0,
    );

    if ($val > $GLOBALS['arvore'][$pos]['value']) {
        if ($GLOBALS['arvore'][$pos]['maior'] === null) {
            $GLOBALS['arvore'][$GLOBALS['contadorPos']] = $m;
            $GLOBALS['arvore'][$pos]['maior'] = $GLOBALS['contadorPos'];
            $GLOBALS['contadorPos'] += 1;
            return true;
        }else {
            verificaNo($val,$pos = $GLOBALS['arvore'][$pos]['maior']);
        }
    }elseif ($val < $GLOBALS['arvore'][$pos]['value']) {
        if ($GLOBALS['arvore'][$pos]['menor'] === null) {
            $GLOBALS['arvore'][$GLOBALS['contadorPos']] = $m;
            $GLOBALS['arvore'][$pos]['menor'] = $GLOBALS['contadorPos'];
            $GLOBALS['contadorPos'] += 1;
            return true;
        }else {
            verificaNo($val,$pos = $GLOBALS['arvore'][$pos]['menor']);
        }
    }
  
}

function removerNo($val = 0,$anteriorPos = 0)
{
    $pos = buscaChave($val);
    echo $pos;
    if (empty($GLOBALS['arvore'][$pos])) {
        return;
    }

    if ($val > $GLOBALS['arvore'][$anteriorPos]['value']) {
        
        if ($GLOBALS['arvore'][$pos]['maior'] !== null) {

            $ind = $GLOBALS['arvore'][$pos]['maior'];
            removerNo($GLOBALS['arvore'][$ind]['value'],$pos);

        }elseif ($GLOBALS['arvore'][$pos]['menor'] !== null) {
            $ind = $GLOBALS['arvore'][$pos]['menor'];
            removerNo($GLOBALS['arvore'][$ind]['value'],$pos);

        }else {
            $pai = buscaPai($pos);
            if ($pai >0) {
                $GLOBALS['arvore'][$pai]['value'] = $GLOBALS['arvore'][$pos]['value'];
            }
            
            if ($GLOBALS['arvore'][$pai]['maior'] == $pos) {
                $GLOBALS['arvore'][$pai]['maior'] = null;
                
            }elseif($GLOBALS['arvore'][$pai]['menor'] == $pos) {
                $GLOBALS['arvore'][$pai]['menor'] = null;
            }
            
            $GLOBALS['arvore'][$pos]['value'] = null;
            $GLOBALS['arvore'][$pos]['balanceamento'] = null;
            return $anteriorPos;
        }
    }else {
        if ($GLOBALS['arvore'][$pos]['maior'] !== null) {

            $ind = $GLOBALS['arvore'][$pos]['maior'];
            removerNo($GLOBALS['arvore'][$ind]['value'],$pos);

        }elseif ($GLOBALS['arvore'][$pos]['menor'] !== null) {
            $ind = $GLOBALS['arvore'][$pos]['menor'];
            removerNo($GLOBALS['arvore'][$ind]['value'],$pos);

        }else {
            $pai = buscaPai($pos);
            if ($pai >0) {
                $GLOBALS['arvore'][$pai]['value'] = $GLOBALS['arvore'][$pos]['value'];
            }
            
            
            if ($GLOBALS['arvore'][$pai]['maior'] == $pos) {
                $GLOBALS['arvore'][$pai]['maior'] = null;
                
            }elseif($GLOBALS['arvore'][$pai]['menor'] == $pos) {
                $GLOBALS['arvore'][$pai]['menor'] = null;
            }
            
            $GLOBALS['arvore'][$pos]['value'] = null;
            $GLOBALS['arvore'][$pos]['balanceamento'] = null;
            return $anteriorPos;
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

function buscaPai($pos)
{
    foreach ($GLOBALS['arvore'] as $key => $value) {
        if ($value['maior'] == $pos || $value['menor'] == $pos) {
            return $key;
        }
    }
    return false;
    
}

function calcularAltura($key)
{
    $tree = $GLOBALS['arvore'][$key];

    if (empty($tree['value'])) {
        return 0;
    }

    if ($tree['menor'] === null && $tree['maior'] === null) {
        return 1;

    }elseif ($tree['menor'] !== null && $tree['maior'] === null) {
        return 1 + calcularAltura($tree['menor']);

    }elseif ($tree['menor'] === null && $tree['maior'] !== null) {
        return 1 + calcularAltura($tree['maior']);

    }else {
        $DIR = calcularAltura($tree['maior']);
        $ESQ = calcularAltura($tree['menor']);
        return 1 + max($DIR,$ESQ);
    }
}

function calcularBalanceamento(int $key)
{
    $tree = $GLOBALS['arvore'][$key];

    if (empty($tree['value'])) {
        return;
    }

    if ($tree['menor'] === null && $tree['maior'] === null) {
        $GLOBALS['arvore'][$key]['balanceamento'] = 0;

    }elseif ($tree['menor'] !== null && $tree['maior'] === null) {
        $GLOBALS['arvore'][$key]['balanceamento'] = 0 -
        calcularAltura($tree['menor']);

    }elseif ($tree['menor'] === null && $tree['maior'] !== null) {
        $GLOBALS['arvore'][$key]['balanceamento'] = 
        calcularAltura($tree['maior']) - 0;

    }else {
        $GLOBALS['arvore'][$key]['balanceamento'] = 
        calcularAltura($tree['menor']) -
        calcularAltura($tree['maior']);
    }

    if ($tree['maior'] !== null) {
        calcularBalanceamento($tree['maior']);
    }

    if ($tree['menor'] !== null) {
        calcularBalanceamento($tree['menor']);
    }
}

function verificaBalanceamento($key)
{
    $tree = $GLOBALS['arvore'][$key];

    if (empty($tree['value'])) {
        return;
    }

    if ($tree['balanceamento'] >= 2 || $tree['balanceamento'] <= -2) {
       if ($tree['balanceamento'] >= 2) {
           if ($tree['maior'] === null) {
               return;
           }
           if ($tree['balanceamento'] * 
           $GLOBALS['arvore'][$tree['maior']]['balanceamento'] > 0) {
               echo "r simples dir";
               rotacaoSimplesDireita($key);
           }else {
               echo "r dupla dir";
               rotacaoDuplaDireita($key);
           }
       }else {
            if ($tree['menor'] === null) {
                return;
            }
            if ($tree['balanceamento'] * 
            $GLOBALS['arvore'][$tree['menor']]['balanceamento'] > 0) {
                echo "r simples esq";
                rotacaoSimplesEsquerda($key);
            }else {
                echo "r dupla esq";
                rotacaoDuplaEsquerda($key);
            }
       }
    }
    calcularBalanceamento($key);
    if ($tree['menor'] !== null) {
        calcularBalanceamento($tree['menor']);
    }
    if ($tree['maior'] !== null) {
        calcularBalanceamento($tree['maior']);
    }
    return $key;
}

function rotacaoSimplesDireita($key)
{
    $tree = $GLOBALS['arvore'][$key];

    if (empty($tree['maior'])) {
        return;
    }

    $filhoDir = null;
    $filhoDoFilho = null;

    if ($tree['maior'] !== null) {
        $filhoDir = $GLOBALS['arvore'][$tree['maior']];
        if ($filhoDir['menor'] !== null) {
            $filhoDoFilho = $GLOBALS['arvore'][$filhoDir['menor']];
        } 
    }
    $GLOBALS['arvore'][$tree['maior']]['menor'] = $key;
    $GLOBALS['arvore'][$key]['maior'] = $filhoDir['menor'];

    return $filhoDir;
}

function rotacaoDuplaDireita($key)
{
    $tree = $GLOBALS['arvore'][$key];

    if (empty($tree['maior'])) {
        return;
    }

    $filhoDir = $GLOBALS['arvore'][$tree['maior']];
    $filhoDoFilho = $GLOBALS['arvore'][$filhoDir['menor']];
    //$noInserido = $GLOBALS['arvore'][$filhoDoFilho['maior']];
    $p = $filhoDir['menor'];
    $GLOBALS['arvore'][$tree['maior']]['menor'] = $filhoDoFilho['maior'];
    $GLOBALS['arvore'][$filhoDir['menor']]['maior'] = $tree['maior'];
    $GLOBALS['arvore'][$key]['maior'] = $tree['maior'];
    
    $GLOBALS['arvore'][$key]['maior'] = null;
    
    $GLOBALS['arvore'][$p]['menor'] = $key;

}

function rotacaoSimplesEsquerda($key)
{
    $tree = $GLOBALS['arvore'][$key];

    if (empty($tree['menor'])) {
        return;
    }

    $filhoEsq = null;
    $filhoDoFilho = null;

    if ($tree['menor'] !== null) {
        $filhoEsq = $GLOBALS['arvore'][$tree['menor']];
        if ($filhoEsq['maior'] !== null) {
            $filhoDoFilho = $GLOBALS['arvore'][$filhoEsq['maior']];
        } 
    }
    $GLOBALS['arvore'][$tree['menor']]['maior'] = $key;
    $GLOBALS['arvore'][$key]['menor'] = $filhoEsq['maior'];

    return $filhoEsq;
}

function rotacaoDuplaEsquerda($key)
{
    $tree = $GLOBALS['arvore'][$key];

    if (empty($tree['menor'])) {
        return;
    }

    $filhoEsq = $GLOBALS['arvore'][$tree['menor']];
    $filhoDoFilho = $GLOBALS['arvore'][$filhoEsq['maior']];
    //$noInserido = $GLOBALS['arvore'][$filhoDoFilho['maior']];
    $p = $filhoEsq['maior'];
    $GLOBALS['arvore'][$tree['menor']]['maior'] = $filhoDoFilho['menor'];
    $GLOBALS['arvore'][$filhoEsq['maior']]['menor'] = $tree['menor'];
    $GLOBALS['arvore'][$key]['menor'] = $tree['menor'];
    
    $GLOBALS['arvore'][$key]['menor'] = null;
    
    $GLOBALS['arvore'][$p]['maior'] = $key;
}

inicializa($root);
insereArvore(37);
insereArvore(20);
insereArvore(21);
insereArvore(10);

/* insereArvore(200);
insereArvore(400); */
//var_dump($GLOBALS['arvore']);
/* insereArvore(85);
insereArvore(55); 
insereArvore(3);
insereArvore(300);
insereArvore(800);
insereArvore(40);
insereArvore(41); */

/* insereArvore(4); */
//var_dump($GLOBALS['arvore']);
/*  insereArvore(51); */
/*removerNo(200);
removerNo(4); */
//var_dump($GLOBALS['arvore'][0]);
//exibirArvore();
calcularBalanceamento(0);
var_dump($GLOBALS['arvore']);

verificaBalanceamento(0);
var_dump($GLOBALS['arvore']);
?>








