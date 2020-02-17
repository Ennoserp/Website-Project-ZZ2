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
            echo '<a href="index.php?famille='.$data['id'].'">'.$data['libelle'].'</a>';
            echo '</a>';

            echo '</div>';
        }
    }


    function afficher_items($famille,$db)
    {
        $sql ="SELECT libelle, image, prix_ttc FROM article WHERE id_famille='$famille'";
        $result=$db->query($sql) or die('Erreur SQl : '.mysqli_error($db));
            echo '<br />';
            echo '<div>';
            while($data = mysqli_fetch_array($result))
            {
                echo '		<div>';
                echo '			$data["libelle"]." pour un prix de ".$data["prix_ttc"]';
                echo '		</div>';
            }
            echo '</div>';

    }


    function deconnexion_bd($db)
    {
        mysqli_close($db);
    }
?>