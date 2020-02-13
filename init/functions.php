<?php
//fonction pour débuguer une variable.
function debug($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die;
}
?>

