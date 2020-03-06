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


    function afficher_items($famille, $db)
    {
        $sql ="SELECT * FROM article WHERE id_famille='$famille'";
        $result = $db->query($sql) or die('Erreur SQl : '.mysqli_error($db));
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


    function ajout_article_panier($article, $db)
    {
        $sql ="SELECT * FROM article WHERE id='$article'";
        $result = $db->query($sql) or die('Erreur SQl : '.mysqli_error($db));
        $data = mysqli_fetch_array($result);

        $count = "SELECT COUNT(*) FROM panier_article WHERE id_article='$article' AND id_panier='1'";
        $res_count = mysqli_fetch_array($db->query($count));

        if ($res_count[0] == 0)
        {
            $sql = "INSERT INTO panier_article VALUES('1',$article,'1',$data[prix_ttc],'3.0','4.0')";
            $result = $db->query($sql) or die('Erreur SQl : '.mysqli_error($db));
        }

        else
        {
            $qte = "SELECT quantite FROM panier_article WHERE id_article='$article'";
            $res_qte = mysqli_fetch_array($db->query($qte));
            $nb = $res_qte[0] + 1;

            $ajout = "UPDATE panier_article SET quantite = '$nb' WHERE id_article='$article'";
            $res_ajout=$db->query($ajout) or die('Erreur SQl : '.mysqli_error($db));
        }
    }


    function afficher_panier($db)
    {
        $prix_total = 0;
        $sql ="SELECT A.libelle, A.prix_ttc, PA.quantite FROM panier_article PA LEFT JOIN article A ON id_article = id WHERE id_panier='1'";
        $result = $db->query($sql) or die('Erreur SQl : '.mysqli_error($db));

        echo '<div class="articles_panier">';

        if(false)
        {
            echo '<p>Votre panier est vide</p>';
            echo '</div>';

        }
        else
        {
            while ($data = mysqli_fetch_array($result))
            {
                $somme = $data['quantite']*$data['prix_ttc'];
                $prix_total += $somme;
                echo     '<div class="id_article_panier">';
                echo        '<div class="libelle_panier">'.$data['libelle'].'</div>';
                echo        '<div class="">'.$data['quantite'].' x '.$data['prix_ttc'].' = '.$somme.' €</div>';
                echo     '</div>';
            }


            echo '</div>';
            echo 'TOTAL : '.$prix_total.' €';
        }

    }


    function vider_panier($db)
    {
        $sql ="DELETE FROM panier_article";
        $result=$db->query($sql) or die('Erreur SQl : '.mysqli_error($db));
    }


    function deconnexion_bd($db)
    {
        mysqli_close($db);
    }

