<?php session_start(); ?>

<div id="page">
    <link rel="stylesheet" href="projet.css" />

    <div id="titre">
        <div id="img_titre"><img src="img/logo_200px.gif"/></div>
        <div id="titres"> Leader du modélisme en ligne UPDATING</div>
    </div>


        <div id="authentification">
            <em>Connexion</em>

            <div id="form">
                Adresse mail<br>
                <input type="text" name="email" placeholder="Adresse email"/><br/>Mot de passe<br>
                <input type="password" name="pwd" placeholder="Mot de passe"/><br/>
                <input type="submit" name="connexion" value="Connexion" id="connexion"/>
                <input type="submit" name="inscription" value="Inscription" id="inscription"/>
            </div>


        </div>

        <div id="contenu">



            <?php
            $db = connexion_bd();

            if(isset($_GET['famille'])==true){
                echo '<button id="retour"><a href="/Website-Project-ZZ2/vente_en_ligne/index.php">Retour </a></button><br />';
                afficher_items($_GET['famille'],$db);
            }
            else {
                afficher_familles($db);
            }
            deconnexion_bd($db);



            /*
                //Connexion à la BDD
                $db = mysqli_connect('localhost', 'root', '', 'vente_en_ligne') or die('Erreur SQL : '.mysqli_error($db));
                $db ->query('SET NAMES UTF8');

                //On execute la requete
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

                //on ferme la connexion
                mysqli_close($db);
            */
            ?>
        </div>



    <div id="panier">
        <img src="img/panier.gif" id="panierpng"> Votre panier</img>
    </div>


    <div id="pied_de_page">
        <p id="pdp">TOPModellisme.com est enregistré au R.C.S. sous le numéro 1234567890<br>13 avenue du Pré de la Reine</p>
    </div>
</div>
