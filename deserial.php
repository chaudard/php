<?php
        $arrayornot = unserialize(urldecode($_GET['datas']));
        echo 'deserialisation</br>';
        echo '<pre>';
        print_r($arrayornot);
        echo '</pre>';
?>