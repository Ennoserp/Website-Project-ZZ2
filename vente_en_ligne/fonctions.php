<?php


    function connexion_bd()
    {
        $db = mysqli_connect('localhost', 'root', '', 'vente_en_ligne') or die('Erreur SQL : '.mysqli_error($db));
        $db ->query('SET NAMES UTF8');
        return $db;
    }

    function afficher_familles($db)
    {
        $sql = 'SELECT * from famille order by ordre_affichage';
        $result = $db -> query($sql) or die('Erreur SQL : '.mysqli_error($db));

        //On fait une boucle pour lire chaque enregistrement
        while($data = mysqli_fetch_array($result))
        {
            echo '<div class="type_article">';
            echo '<img src="img_familles/'.$data['image'].'" />';
            echo '<br />';
            echo '<a href="#" title="'.$data['libelle'].'"';
            echo '<p>';
            echo $data['libelle'];
            echo '</p>';
            echo '</a>';

            echo '</div>';
        }
    }

    function deconnexion_bd($db)
    {
        mysqli_close($db);
    }
?>