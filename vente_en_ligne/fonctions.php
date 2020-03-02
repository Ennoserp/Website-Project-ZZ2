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
            echo '        <div class="myButton"><a href="index.php?famille='.$data['id_famille'].'&article='.$data['id'].'">Ajouter au panier</a></div>';

            echo '    </div>';
            echo '</div>';
            $article = $data['id'];
        }
        if(isset($_GET['article'])!=0)
        {
            ajout_article_panier($_GET['article'], $db);
        }
    }

    function ajout_article_panier($article, $db){
        $sql ="SELECT * FROM article WHERE id='$article'";
        $result=$db->query($sql) or die('Erreur SQl : '.mysqli_error($db));
        $data = mysqli_fetch_array($result);
        $count = "SELECT COUNT(*) FROM panier_article WHERE id_article='$article' AND id_panier='1'";
        $res_count=$db->query($count);
        echo $res_count;
        if (!$res_count){
            $sql="INSERT INTO panier_article VALUES('1',$article,'1',$data[prix_ttc],'3.0','4.0')";
            $result=$db->query($sql) or die('Erreur SQl : '.mysqli_error($db));
            echo'bonjour<br />';
        }
        else{
            $qte = "SELECT quantite FROM panier_article WHERE id_article='$article'";
            $res_qte=$db->query($qte) or die('Erreur SQl : '.mysqli_error($db))+1;
            $modif = "UPDATE panier_article SET quantite = '$res_qte'";
            $res_modif=$db->query($modif) or die('Erreur SQl : '.mysqli_error($db));
        }
        //afficher_panier($db);
    }

    function afficher_panier($db)
    {
        echo 'afficher_panier';
    }

    function vider_panier($db)
    {
        echo 'PANIER VIDÉ<br />';
        $sql ="DELETE FROM panier_article";
        $result=$db->query($sql) or die('Erreur SQl : '.mysqli_error($db));
        echo $result.'<br />';
    }

    function deconnexion_bd($db)
    {
        mysqli_close($db);
    }
?>