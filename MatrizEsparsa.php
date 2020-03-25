<?php
$elems = array();
$array1 = array();
$array2 = array();

#region arrays
$array1[0] = array(
    'valor' => 54,
    'sucessor' =>  3,
);
$array1[1] = array(
      'valor' => 0,
      'sucessor' =>  null,
);
$array1[2] = array(
      'valor' => 0,
      'sucessor' =>  null,
);
$array1[3] = array(
      'valor' => 37,
      'sucessor' =>  4,
);
$array1[4] = array(
      'valor' => 85,
      'sucessor' =>  null,
);

$array2[0] = array(
    'valor' => 87,
    'sucessor' =>  3,
);
$array2[1] = array(
      'valor' => 0,
      'sucessor' =>  null,
);
$array2[2] = array(
      'valor' => 0,
      'sucessor' =>  null,
);
$array2[3] = array(
      'valor' => 428,
      'sucessor' =>  4,
);
$array2[4] = array(
      'valor' => 785,
      'sucessor' =>  null,
);

#endregion arrays

$linhas = null;
$colunas = null;

inicializarMatriz($elems,2,2);

atribuirMatriz($array1[0],1,0);
atribuirMatriz($array1[3],1,1);
atribuirMatriz($array1[4],1,2);
atribuirMatriz($array2[0],2,0);

var_dump(acessarValor(1,2));

var_dump($elems);

function inicializarMatriz(array &$matriz,int $linhas,int $colunas)
{
    $GLOBALS['linhas'] = $linhas;
    $GLOBALS['colunas'] = $colunas;

    for ($i=0; $i < $linhas; $i++) { 
        $matriz[$i] = null;
    }
}

function atribuirMatriz(array &$matriz,int $lin,int $col)
{
    if ($lin-1 < 0 || $lin-1 >= $GLOBALS['linhas']) {
        return false;
    }

    if ($col < 0 || $col >= $GLOBALS['colunas']+1) {
        return false;
    }


    if (empty($GLOBALS['elems'][$lin-1][$col]['sucessor']) && $matriz['valor'] != null) {

        if (!is_array($GLOBALS['elems'][$lin-1])) {
            $GLOBALS['elems'][$lin-1][$col] = $matriz;
            return true;
        }

        for ($i=0; $i < count($GLOBALS['elems'][$lin-1]); $i++) { 
            if ($GLOBALS['elems'][$lin-1][$i]['valor'] == $matriz['valor']) {
                return false;
            }
        }
        $GLOBALS['elems'][$lin-1][$col] = $matriz;
        return true;
    }
    
}

function acessarValor(int $lin,int $col)
{
    if ($lin-1 < 0 || $lin-1 >= $GLOBALS['linhas']) {
        return false;
    }

    if ($col < 0 || $col >= $GLOBALS['colunas']+1) {
        return false;
    }

    if (empty($GLOBALS['elems'][$lin-1][$col])) {
        return false;
    }

    return $GLOBALS['elems'][$lin-1][$col];
}
?>