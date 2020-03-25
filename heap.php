<?php
$l = [25, 57, 48, 37, 12, 92, 33];
$size = count($l);
$ordenado = array();

function maxHeap()
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

        swapHeap($heapTree,$i);
        
    }

    ordenacao();
    return $heapTree;
}

function swapHeap($heapTree,$pos)
{

    for ($i=0; $i < count($heapTree); $i++) { 
        $parentNode = $heapTree[$i]['position'];

        if ($GLOBALS['l'][$parentNode] < $GLOBALS['l'][$pos]) {
            $temp = $GLOBALS['l'][$parentNode];
            $GLOBALS['l'][$parentNode] = $GLOBALS['l'][$pos];
            $GLOBALS['l'][$pos] = $temp;
            //return;
        }
    }
}

function ordenacao()
{
    $GLOBALS['size'] -= 1;
    $tamanhoVetor = $GLOBALS['size'];

    if ($tamanhoVetor < 0) {
        return $GLOBALS['ordenado'];
    }

    $GLOBALS['ordenado'][$tamanhoVetor] = $GLOBALS['l'][0];
    $GLOBALS['l'][0] = null;
    return maxHeap();
}

var_dump(maxHeap());

var_dump($l);

var_dump($ordenado);

?>