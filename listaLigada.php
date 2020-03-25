<?php
/*Iniciar Estrutura*/
$elems = array();

$max = 10;
$sucessor = -1;

for ($i=0; $i < $max; $i++) { 
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
        "sucessor"  => -1,
    );
}

function tamanho(){
    $tam = 0;
    foreach ($GLOBALS['elems'] as $key => $value) {
        if ($value['sucessor'] != null) {
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
        if ($value['sucessor'] != null) {
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
    foreach ($GLOBALS['elems'] as $key => $value) {
        if ($value['sucessor'] == $ch && $value['sucessor'] != null) {
            return $value;
        }else {
            return;
        }
    }
}

function iniciarLista($adicione)
{
    if ($GLOBALS['elems'][0]['sucessor'] == null) {
        $GLOBALS['elems'][0] = array(
                "valor"  => $adicione,
                "sucessor"  => -1,
        );
        $GLOBALS['sucessor'] = 0;
    }
    return;
}

function excluir($pos)
{
    if ($pos < 0 || $pos > count($GLOBALS['elems'])-1) {
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
    $showFirst = true;
    
    foreach ($GLOBALS['elems'] as $key => $value) {

        if ($value['sucessor'] == -1) {
            break;
        }

        if ($value['sucessor'] != null) {

            if ($showFirst) {
                var_dump($GLOBALS['elems'][$key]);
            }

            $showFirst = false;

            foreach ($GLOBALS['elems'] as $k => $val) {
                if ($value['sucessor'] == $k) {
                    var_dump($GLOBALS['elems'][$k]); 
                    break;
                }
            }
        }
    }
}

function reiniciarLista(array &$lista)
{
    $list = &$lista;
    unset($list);
    //php possui garbage collector 
    //então não precisamos nos preocupar 
    //muito com gerenciamento de memória mas,
    //aparentemente unset 
    //é o jeito mais próximo de limpar memória 
    //comparado ao free() da linguagem C
    //Porém deixar a variavel null 
    //parece ser o jeito mais rapido em performance de acordo com o link:
    //https://stackoverflow.com/questions/584960/whats-better-at-freeing-memory-with-php-unset-or-var-null
    return;
}
/*Fim Estrutura */

/*Chamadas de Metodos */
iniciarLista(78);
addPos(3,2);
addPos(4,15);
addPos(9,15);

var_dump($elems);

excluir(4);

var_dump($elems);

showLinks();

reiniciarLista($elems);

//var_dump(buscaPorChave(3));

/* echo "<h1>" . tamanho() . "</h1>";
exibeLista(); */
?>