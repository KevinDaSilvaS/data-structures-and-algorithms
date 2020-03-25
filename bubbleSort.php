<?php
function bubbleSort($conj)
{
    for ($i=0; $i < count($conj)-1; $i++) { 

        for ($p=0; $p< count($conj)-$i-1; $p++) { 

            if ($conj[$p] > $conj[$p+1]) {
                $temp = $conj[$p];
                $conj[$p] = $conj[$p+1];
                $conj[$p+1] = $temp;
            }

        }
        var_dump($conj);
    }
}
$l = [25, 57, 48, 37, 12, 92, 33];
//$l = [6, 18, 12, 25, 31, 22, 94, 11];


function selectionSort($conj,$p = 0)
{
   //var_dump($conj);
   if ($p >= count($conj)-1) {
        return $conj;
   }

   $posMenor = $p;
   $p+=1;
   $temp = $posMenor;

   for ($i=$p; $i < count($conj); $i++) { 
       
       if ($conj[$temp] > $conj[$i]) {
           $temp = $i;
       }
   }
   
   $t = $conj[$temp];
   $conj[$temp] = $conj[$posMenor];
   $conj[$posMenor] = $t;
   
   return selectionSort($conj,$p);
   
}

function selectionSortLoops($conj)
{
    $it = 0;
    $posInicial = 0;
    $posMenor = 0;
    $i = 0;
    for ($it=0; $it < count($conj)-1; $it++) { 
        $posInicial = $it;
        $posMenor = $it+1;
        for ($i = $posInicial; $i < count($conj); $i++) { 
            if ($conj[$i] < $conj[$posMenor]) {
                $posMenor = $i;
            }
        }

        $t = $conj[$posInicial];
        $conj[$posInicial] = $conj[$posMenor];
        $conj[$posMenor] = $t;
    }
    return $conj;
}

function insertionSort($conj)
{
    //var_dump($conj);
    for ($i=1; $i < count($conj); $i++) { 
        $elem = $conj[$i];
        for ($p=$i-1; $p >= 0 && $conj[$p] > $elem; $p--) { 
            $conj[$p+1] = $conj[$p];
        }
        $conj[$p+1] = $elem;
        //var_dump($conj);
    }

    return $conj;
}

function partition($inicio,$fim)
{
    $ref = $GLOBALS['l'][$inicio];
    $down = $inicio;
    $up = $fim;

    while ($down < $up) {
        while ($GLOBALS['l'][$down] <= $ref && $down < $fim) {
            $down++;
        }

        while ($GLOBALS['l'][$up] > $ref) {
            $up--;
        }

        if ($down < $up) {
            $temp = $GLOBALS['l'][$down];
            $GLOBALS['l'][$down] = $GLOBALS['l'][$up];
            $GLOBALS['l'][$up] = $temp;
        }
    }
    $GLOBALS['l'][$inicio] = $GLOBALS['l'][$up];
    $GLOBALS['l'][$up] = $ref;
    var_dump($GLOBALS['l']);
    return $up;
}

function quickSort($inicio,$fim)
{
    if ($inicio >= $fim) {
        return;
    }
    $pivo = partition($inicio,$fim);
    quickSort($inicio,$pivo-1);
    quickSort($pivo+1,$fim);
}

function mergeSort($inicio, $final)
{
    if ($inicio < $final) {
        $meio = floor(($inicio + $final)/2);
        mergeSort($inicio, $meio);
        mergeSort($meio + 1, $final);
        ordena($inicio,$meio,$final);
    }
}

function ordena($start,$middle,$end)
{
    $conj = $GLOBALS['l'];
    $inicio = $start;
    $inicio2 = $middle + 1;
    $tamanhoReal = $start;

    while($tamanhoReal <= $end) { 
        if ($inicio > $middle) {
            $GLOBALS['l'][$tamanhoReal] = $conj[$inicio2];
            $inicio2 += 1;

        }elseif ($inicio2 > $end) {
            $GLOBALS['l'][$tamanhoReal] = $conj[$inicio];
            $inicio += 1;

        }elseif ($conj[$inicio] <= $conj[$inicio2]) {
            $GLOBALS['l'][$tamanhoReal] = $conj[$inicio];
            $inicio += 1;

        }else {
            $GLOBALS['l'][$tamanhoReal] = $conj[$inicio2];
            $inicio2 += 1;
        }

        $tamanhoReal += 1;
    } 

    var_dump($GLOBALS['l']);

}

function shellSort($conj){
    $hop = floor(count($conj)/2);
    for ($h=$hop; $h > 0; $h = floor($h/2)) { 

        for ($i=$h; $i < count($conj); $i++) { 
            $elem = $conj[$i];
            for ($p=$i-$h; $p >= 0 && $conj[$p] > $elem; $p-=$h) { 
                $conj[$p+$h] = $conj[$p];
            }
            $conj[$p+$h] = $elem;
        }

    }
    return $conj;
}

function heapSort($conj, $dec = 0)
{
    $calc = count($conj);

    for ($i=$dec; $i < $calc; $i++) { 

        $temp = 0;
        $maior = $conj[$i];
        $newI = $i;
        $index = $i;
        if (!empty($conj[$i + 1])) {
            if ($maior < $conj[$i + 1]) {
                $maior = $conj[$i + 1];
                $index = $i + 1;
            }
        }

        if (!empty($conj[$i + 2])) {
            if ($maior < $conj[$i + 2]) {
                $maior = $conj[$i + 2];
                $index = $i + 2;
            }
        }

        $newI = $i + 2;

        if ($maior != $conj[$i]) {
            $temp = $conj[$i];
            $conj[$i] = $conj[$index];
            $conj[$index] = $temp;
        }

        $i = $newI;
    }

    $maior = $conj[0];
    $pos = $dec;
    for ($p=$dec; $p < $calc; $p++) { 
        if($p % 3 == 0){
            if ($conj[$p] > $maior) {
                $maior = $conj[$p];
                $pos = $p;
            }
        }
    }
    
    if ($dec < $calc) {
        if ($pos !== $dec) {
            $temp = $conj[0];
            $conj[0] = $maior;
            $conj[$pos] = $temp;
        }

        $dec += 1;
        return heapSort($conj,$dec);

    }else {
        return $conj;
    }
}


//var_dump(selectionSortLoops($l));//implementação isisdro
//var_dump(selectionSort($l)); // minha implementação usando recursão
//bubbleSort($l)

//var_dump(insertionSort($l));
//quickSort(0,count($l)-1);
//var_dump(mergeSort(0, count($l)-1));
//var_dump(shellSort($l));
var_dump(heapSort($l,$dec = 0));

?>