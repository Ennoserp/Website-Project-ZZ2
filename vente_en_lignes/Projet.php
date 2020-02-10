<div id="page">
    <link rel="stylesheet" href="projet.css" />

    <div id="titre">
        <div id="img_titre"><img src="img/logo_200px.gif"/></div>
        <div id="titres"> Leader du modélisme en ligne UPDATED</div>
    </div>


        <div id="authentification">
            Connexion<br />
            <div id="form">
                <input type="text" name="identifiant" placeholder="Identifiant"/><br/>
                <input type="password" name="pwd" placeholder="Mot de passe"/><br/>
                <input type="submit" name="connexion" value="Connexion" id="connexion"/>
            </div>


        </div>

        <div id="contenu">

            <?php
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
            ?>
        </div>



    <div id="panier">Votre panier
        <a href="img/panier.gif"></a>
    </div>


    <div id="pied_de_page">
        <p>TOPModellisme.com est enregistré au numéro 123456789</p>
    </div>
</div>
