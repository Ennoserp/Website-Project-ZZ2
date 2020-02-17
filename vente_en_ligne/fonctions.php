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
            echo '<div class="type_famille">';
            echo '<img src="img_familles/'.$data['image'].'" />';
            echo '<br />';
            echo '<a href="index.php?famille='.$data['id'].'">'.$data['libelle'].'</a>';
            echo '</a>';

            echo '</div>';
        }
    }


    function afficher_items($famille,$db)
    {
        $sql ="SELECT * FROM article WHERE id_famille='$famille'";
        $result=$db->query($sql) or die('Erreur SQl : '.mysqli_error($db));
            echo '<br />';
            while($data = mysqli_fetch_array($result))
            {
                echo '<div class="type_article">';
                echo '    <div class="article"> <img src="img_articles/'.$data['image'].'" /></div>';
                echo '    </br><div id="libelle">'.$data["libelle"]."</div>";
                echo '    <div id="desc">'.$data["detail"]."</div>";
                echo '    <div id ="commande">';
                echo '        <div id="prix">'.$data["prix_ttc"]."€ </div>";
                echo '        <div class="myButton"><a href="#">Ajouter au panier</a></div>';
                echo '    </div>';
                echo '</div>';
            }

    }

    function ajout_article_panier($article, $db){
        $sql ="SELECT * FROM article WHERE id_famille='$article'";
        $result=$db->query($sql) or die('Erreur SQl : '.mysqli_error($db));
        afficher_panier($db);
    }

    function afficher_panier($db)
    {
        echo 'afficher_panier()';
    }

    function vider_panier($db)
    {
        echo 'PANIER VIDÉ<br />';
        $sql ="DELETE FROM panier_article";
        $result=$db->query($sql) or die('Erreur SQl : '.mysqli_error($db));
    }

    function deconnexion_bd($db)
    {
        mysqli_close($db);
    }
?>