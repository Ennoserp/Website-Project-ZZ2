<?php session_start(); ?>

<div id="page">
   

    <div id="en_tete"><!-- en-tete du site web -->
        <div id="titre_img"><img src="img/logo_200px.gif"/></div>
        <div id="titre">Le leader du modélisme en ligne</div>
    </div>


    <div id="authentification">

        <div id="form"><!-- Fomulaire de connexion -->
                Adresse email<br />
                <input type="text" name="email" placeholder="Adresse email"/><br />Mot de passe<br />
                <input type="password" name="pwd" placeholder="Mot de passe"/><br />
                <div class="myButton"><a href="#">Se connecter</a></div>
                <div class="myButton"><a href="#">Créer un compte</a></div>
        </div>
    </div>

    <div id="contenu"><!-- div dans lequel seront affichés tous les articles et familles -->
        <?php

        $db = connexion_bd();               // connexion a la BDD

        if(isset($_GET['vider'])==true)
        {
            vider_panier($db);              // fonction permettant de vider le panier du client
        }


        if(isset($_GET['famille'])==true){
            echo '<div class="myButton"><a href="index.php">Retour</a></div><br />';
            afficher_items($_GET['famille'],$db);           // fonction qui permet d'afficher les articles des différentes
                                                            //      familles quand on clique sur une des familles

            if(isset($_GET['commander'])==true)
            {
                ajout_article_panier($_GET['commander']);   // fonction qui permet d'ajouter un article au panier en
                                                            //      cliquant sur le bouton commander
            }
        }
        else {
            afficher_familles($db);                         // fonction qui permet d afficher les familles
        }

        ?>
    </div>

    <div id="panier"><!-- div avec le contenu du panier du client, la quantité et le prix de chaque article -->
        <div class="panier_titre">
            <img src="img/panier.gif" id="panier_png"></img>Votre panier
        </div>
        <?php afficher_panier($db) ?>   <!-- fonction qui permet d'afficher le panier via requetes sql -->

        <div id="boutons_panier">
            <div class="myButton" name="vider"><a href="index.php?vider=true">Vider panier</a></div>
            <div class="myButton">Commander</div>
        </div>
    </div>


    <div id="pied_de_page"><!-- pied de page indiquant les coordonnées du vendeur -->
        <p id="pdp">TOPModellisme.com est enregistré au R.C.S. sous le numéro 1234567890<br />13 avenue du Pré de la Reine</p>
    </div>
</div>

<?php deconnexion_bd($db); ?> <!-- fonction permettant de se déconnecter de la BDD -->