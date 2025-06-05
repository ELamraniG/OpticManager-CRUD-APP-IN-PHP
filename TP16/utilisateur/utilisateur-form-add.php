<?php
	require("../head.php");
	$active = 4;
	require("../menu.php");
?>
<div class="container" style="margin-top: 100px;">
<form method="POST" action="utilisateur-add.php">
	<fieldset style="border:1px solid lightgrey; padding: 10px; border-radius: 10px;">
		<legend style="background-color: lightblue; padding: 10px; border-radius: 10px; text-align: center; " class="form-control mb-5">Formulaire de saisi des utilisateurs</legend>

		<label >Sélectionnez un Employé</label>
		<select name="idemploye" id = "ide" class="form-control" onchange="afficher_infos_employe()">
			<option selected disabled>Sélectionnez un employé</option>
			<?php
				require("../connexion.php");
				$r = "select * from employe";
				$res = mysqli_query($con, $r);
				while ($data = mysqli_fetch_assoc($res))
				{
					echo "<option value=".$data['idemploye'].">";
					echo $data['nomemploye'] . " " . $data['prenom'];
				}
				mysqli_close($con);
			?>
		</select>
		<div id="infos_employe"></div>
		
		<div class="row  mt-5">
		    <div class="col">
		        <div class="form-group">
		            <label>Login</label>
		            <input type="text" class="form-control" name="login">
		        </div>
		    </div>
		    <div class="col">
		        <div class="form-group">
		            <label>Mot de passe </label>
		            <input type="password" class="form-control" name="motdepasse">
		        </div>
		    </div>
		    <div class="col">
		        <div class="form-group">
		            <label>Type d'utilisateur</label>
		            <input type="text" class="form-control" name="typeutilisateur" value="Admin">
		        </div>
		    </div>
		</div>
		<fieldset class="form-group p-3">
			<legend> Cocher les autorisations</legend>
			<?php 
				require("../connexion.php");
				// Récupération des noms de colonnes de la table utilisateurs
				$r = "SHOW COLUMNS FROM utilisateur";				
				$res = mysqli_query($con, $r);
				$i = 0; // pour compter les colonnes à afficher (à partir de $i=5 car gerer est en 5ème position)
				$cpt = 0; // Compteur pour le nombre d'éléments affichés
				echo "<div class=row>"; // Ouvrir une ligne Bootstrap
				while ($data = mysqli_fetch_assoc($res)) 
				{
					// Ne commencer à afficher qu'à partir de la 5ème colonne
			        if ($cpt >= 5) 
			        {
			            // Créer une nouvelle colonne chaque 5 checkboxes
			            $nbrLigneParColonne = 5;
			            if (($cpt - 5) % $nbrLigneParColonne == 0) 
			            {
			                if ($cpt > $nbrLigneParColonne) echo "</div>"; // Fermer la colonne précédente
			                echo "<div class='col-sm-3 '>"; // Ouvrir une nouvelle colonne
			            }
			            
			            $colonne = $data['Field'];
			            echo "<div class='form-check mb-2'>";
			            echo "<input class='form-check-input' type='checkbox' name=" . $colonne . " id=" . $colonne . ">";
			            echo "<label class='form-check-label' for=" . $colonne . ">"  . $colonne . "</label>";
			            echo "</div>";   
			        } 
			    	
    				$cpt++;
    				
				}

				// Fermer la dernière colonne
				if ($cpt > 0) echo "</div>";
			?>
<div class="text-center mt-3"> <!-- Centrer les boutons et ajouter un peu d'espace en haut -->
    <!-- Bouton "Cochez-Tout" -->
    <button type="button" class="btn btn-success mr-2" onclick="cocherTout()">Cochez-Tout</button>
    
    <!-- Bouton "Décochez-Tout" -->
    <button type="button" class="btn btn-warning" onclick="decocherTout()">Décochez-Tout</button>
</div>

<!-- Script JavaScript pour gérer le clic sur les boutons -->
<script>
    function cocherTout() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = true;
        });
    }

    function decocherTout() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
    }
</script>
		</fieldset>
		<button type="submit" class="btn btn-primary mt-3">
    		<i class="fas fa-save"></i> Enregistrer
		</button>
		<a href="utilisateur-list.php" class="btn btn-secondary mt-3">Annuler</a>

	</fieldset>
</form>
</div>
<script>
	function afficher_infos_employe(){
		// Sélection de l'élément select avec l'ID "ide"
var employe_slct = document.getElementById("ide");

// Sélection de l'option actuellement sélectionnée dans le select
var selectedOption = employe_slct.options[employe_slct.selectedIndex];

// Sélection de l'élément où afficher les informations de l'employé
var infos_employe = document.getElementById("infos_employe");

// Récupération de la valeur de l'option sélectionnée (id de l'employé)
var ide = selectedOption.value;

// Utilisation de AJAX pour récupérer les données de l'employé
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function(){
    // Vérification de l'état de la requête
    if (xhr.readyState === XMLHttpRequest.DONE) {
        // Conversion de la réponse JSON en objet JavaScript
        var reponse = JSON.parse(xhr.responseText);

        // Extraction des données de la réponse
        var idemploye = reponse.idemploye;
        var photo = reponse.photo;
        var nomprenom = reponse.nomprenom;
        var datederecrutement = reponse.datederecrutement;

        // Création du contenu HTML à afficher
        var detailshtml = "Id : <strong>" + idemploye + "</strong><br>" 
            + "<img src='../employe/images/" + photo + "' width=40>"
            + "<strong> " + nomprenom + "</strong><br>"
            + "Date de recrutement : <strong> " + datederecrutement + "</strong><br>";

        // Mise à jour du contenu de l'élément infos_employe
        infos_employe.innerHTML = detailshtml;
    }
};

// Configuration de la requête AJAX
xhr.open("GET", "../employe/employe_data.php?ide="+ide, true);

// Envoi de la requête AJAX
xhr.send();

	}
</script>
