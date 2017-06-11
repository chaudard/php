<?php
        $notes = array('maths'=>1,'svt'=>8,'algo'=>6,'philo'=>5); // Un array…
        $serialized = serialize($notes); // On serialize et on stocke cette chaîne.
 /*
        echo '<pre>'; // Les balises « pre » permettent d'afficher lisiblement un array.
        print_r(unserialize($serialized)); // On utilise « print_r » pour une bonne raison.
        echo '</pre>';

        $fh = fopen('test.txt','a+'); // Ouverture d'un fichier en lecture/écriture, en le créant s'il n'existe pas.
        fwrite($fh,$serialized); // On écrit.
        fclose($fh); // On ferme.
*/
        header("Location:deserial.php?datas=".urlencode($serialized)); // Une simple redirection, mais avec des données GET.
        //exit;
?>