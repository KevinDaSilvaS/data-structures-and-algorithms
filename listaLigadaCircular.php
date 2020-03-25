<?php
/*Iniciar Estrutura*/
$elems = array();

$max = 10;
$sucessor = -1;
$cabeca = -1;

for ($i=0; $i < $max+1; $i++) { 
    $elems[] = array(
        "valor"  => null,
        "sucessor"  => null,
    );
}

var_dump($elems);
/*Fim Inicio Estrutura */

/*Funções Estrutura */
function addPos($pos,$elem)
{
    if ($pos < 0 || $pos > count($GLOBALS['elems'])-1) {
        return;
    }

    if ($GLOBALS['elems'][$pos]['valor'] != null) {
        return;
    }

    $indice = $GLOBALS['sucessor'];

    if ($GLOBALS['sucessor'] >= 0) {
        $GLOBALS['elems'][$indice]['sucessor'] = $pos;
    }

    $GLOBALS['sucessor'] = $pos;

    $GLOBALS['elems'][$pos] = array(
        "valor"  => $elem,
        "sucessor"  => $GLOBALS['cabeca'],
    );
}

function tamanho(){
    $tam = 0;
    foreach ($GLOBALS['elems'] as $key => $value) {
        if ($value['valor'] != null && $GLOBALS['cabeca'] != $key) {
            $tam++;
        }
    }

    return $tam;
}

function exibeLista()
{
    echo "<table>
            <thead>
                <tr>
                    <th>Valor</th>
                    <th>Elemento Sucessor</th>
                </tr>
        </thead>
    <tbody>";

    foreach ($GLOBALS['elems'] as $key => $value) {
        if ($GLOBALS['cabeca'] != $key && $value['valor'] != null) {
            echo "<tr>
                <td>".$value['valor']."</td>
                <td>".$value['sucessor']."</td>
            </tr>";
        }
    }

    echo "</tbody>
    </table>";
}

function buscaPorChave($ch){

    if ($GLOBALS['cabeca'] == $ch) {
        return;
    }

    foreach ($GLOBALS['elems'] as $key => $value) {
        if ($value['sucessor'] == $ch && $value['sucessor'] != null) {
            return $value;
        }else {
            return;
        }
    }
}

function iniciarLista()
{
    if ($GLOBALS['elems'][0]['sucessor'] == null) {
        $GLOBALS['elems'][0] = array(
                "valor"  => 'Nó Cabeça',
                "sucessor"  => 0,
        );
        $GLOBALS['sucessor'] = 0;
        $GLOBALS['cabeca'] = 0;
    }
    return;
}

function excluir($pos)
{
    if ($pos < 0 || $pos > count($GLOBALS['elems'])-1) {
        return;
    }

    if ($GLOBALS['cabeca'] == $pos) {
        return;
    }

    $elementoExclusao = $GLOBALS['elems'][$pos];

    foreach ($GLOBALS['elems'] as $key => $value) {
       if ($value['sucessor'] == $pos && $value['valor'] != null) {

            $GLOBALS['elems'][$key]['sucessor'] =  $elementoExclusao['sucessor'];
            break;
       }
    }

    $GLOBALS['elems'][$pos] = array(
        "valor"  => null,
        "sucessor"  => null,
    );

}

function showLinks()
{
    foreach ($GLOBALS['elems'] as $key => $value) {

        if ($value['sucessor'] != null) {

            foreach ($GLOBALS['elems'] as $k => $val) {
                if ($value['sucessor'] == $k) {
                    var_dump($GLOBALS['elems'][$k]); 
                    break;
                }
            }
        }
    }
}

function reiniciarLista()
{
    foreach ($GLOBALS['elems'] as $k => $val) {
        if ($GLOBALS['cabeca'] != $k) {
            $GLOBALS['elems'][$k] = array(
                "valor"  => null,
                "sucessor"  => null,
            );
        }
    }
  return;
}
/*Fim Estrutura */

/*Chamadas de Metodos */
iniciarLista();
addPos(3,2);
addPos(4,15);
addPos(10,35);
addPos(9,15);

var_dump($elems);

excluir(4);

var_dump($elems);

showLinks();

//reiniciarLista();

//var_dump(buscaPorChave(3));

echo "<h1>" . tamanho() . "</h1>";
exibeLista();
?>