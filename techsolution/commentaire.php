<?php
// Paramètres de connexion à la base de données
$serveur = "9b6po.myd.infomaniak.com"; // Si le serveur MySQL est sur la même machine, sinon remplacez-le par l'adresse IP ou le nom du serveur distant.
$utilisateur = "9b6po_littlesong";
$motDePasse = "Pc_FfKHzaA1";
$baseDeDonnees = "9b6po_db_littlesong";

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}
$query = "SELECT * FROM comment";
$result = $connexion->query($query);

// Affichage des commentaires dans la section "Commentaires"
echo '<div class="comments">';
echo '<h2 style="text-align: center"><b>Commentaires :</b></h2><br>';

// Vérifier s'il y a des commentaires
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Afficher chaque commentaire
        echo "<p><strong>Nom:</strong> " . $row["nom"] . "<br>";
        echo "<strong>Email:</strong> " . $row["mail"] . "<br>";
        echo "<strong>Commentaire:</strong> " . $row["commentaire"] . "<br>";
        echo "<strong>Évaluation:</strong> " . $row["rating"] . "</p>";
    }
} else {
    echo "Aucun commentaire pour le moment.";
}

echo '</div>';

// Fermer la connexion à la base de données
$connexion->close();
?>