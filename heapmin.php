<?php
$l = [25, 57, 48, 37, 12, 92, 33];
$size = count($l);
$ordenado = array();

function minHeap()
{
    $conj = $GLOBALS['l'];
    $heapTree[] = array(
        "position" => 0,
        "sons"  => array(),
    );

    $currentParent = 0;
    $indexHeapTree = 0;

    for ($i=1; $i < count($conj); $i++) { 
        $numberOfSons =  count($heapTree[$currentParent]['sons']);

        if ($numberOfSons < 2) {
            $heapTree[$currentParent]['sons'][] = $i;
            
        }else{
            $currentParent += 1;
            $indexHeapTree += 1;

            $heapTree[] = array(
                "position" => $currentParent,
                "sons"  => array($i),
            );
        }

        swapHeapMin($heapTree,$i);
        
    }

    ordenacaoMin();
    return $heapTree;
}

function swapHeapMin($heapTree,$pos)
{

    for ($i=0; $i < count($heapTree); $i++) { 
        $parentNode = $heapTree[$i]['position'];

        if ($GLOBALS['l'][$parentNode] > $GLOBALS['l'][$pos]) {
            $temp = $GLOBALS['l'][$parentNode];
            $GLOBALS['l'][$parentNode] = $GLOBALS['l'][$pos];
            $GLOBALS['l'][$pos] = $temp;
            //return;
        }
    }
}

function ordenacaoMin()
{
    $tamanhoVetor = count($GLOBALS['ordenado']);

    if ($tamanhoVetor > $GLOBALS['size']-1) {
        return $GLOBALS['ordenado'];
    }

    $GLOBALS['ordenado'][] = $GLOBALS['l'][0];
    array_splice($GLOBALS['l'],0,1);
    //$GLOBALS['l'][0] = 999;
    return minHeap();
}

var_dump(minHeap());

var_dump($l);

var_dump($ordenado);

?>