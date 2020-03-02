<?php session_start(); ?>

<div id="page">
    <link rel="stylesheet" href="projet.css" />

    <div id="titre">
        <div id="img_titre"><img src="img/logo_200px.gif"/></div>
        <div id="titres"> Leader du modélisme en ligne UPDATING</div>
    </div>


    <div id="authentification">

        <div id="form">
            Adresse mail<br>
            <input type="text" name="email" placeholder="Adresse email"/><br/>Mot de passe<br>
            <input type="password" name="pwd" placeholder="Mot de passe"/><br/>
            <div class="myButton"><a href="#">Se connecter</a></div>
            <div class="myButton"><a href="#">Créer un compte</a></div>
        </div>


    </div>

    <div id="contenu">

        <?php
        $db = connexion_bd();

        if(isset($_GET['vider'])==true)
        {
            vider_panier($db);
        }


        if(isset($_GET['famille'])==true){
            echo '<div class="myButton"><a href="/Website-Project-ZZ2/vente_en_ligne/index.php">Retour</a></div><br />';
            afficher_items($_GET['famille'],$db);

            if(isset($_GET['commander'])==true)
            {
                ajout_article_panier($_GET['commander']);
            }
        }
        else {
            afficher_familles($db);
        }

        deconnexion_bd($db);
        ?>
    </div>

    <div id="panier">
        <img src="img/panier.gif" id="panierpng"> Votre panier</img>
        <div class="myButton" name="vider"><a href="index.php?vider=true">Vider panier</a></div>
        <div class="myButton">Commander</div>
    </div>


    <div id="pied_de_page">
        <p id="pdp">TOPModellisme.com est enregistré au R.C.S. sous le numéro 1234567890<br>13 avenue du Pré de la Reine</p>
    </div>
</div>
