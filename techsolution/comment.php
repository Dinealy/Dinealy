<?php
// Paramètres de connexion à la base de données
$serveur = "9b6po.myd.infomaniak.com";
$utilisateur = "9b6po_littlesong";
$motDePasse = "Pc_FfKHzaA1";
$baseDeDonnees = "9b6po_db_littlesong";

// Vérifier si le formulaire a été soumis
if (isset($_POST['envoi'])) {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $commentaire = $_POST['commentaire'];
    $note = $_POST['rating'];

    // Connexion à la base de données
    $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("La connexion à la base de données a échoué : " . $connexion->connect_error);
    }

    // Requête SQL préparée pour insérer les données dans la table "comment"
    $sql = "INSERT INTO comment (nom, mail, commentaire, note) VALUES (?, ?, ?, ?)";

    // Préparation de la requête
    $requetePreparee = $connexion->prepare($sql);

    // Liaison des paramètres
    $requetePreparee->bind_param("sssi", $nom, $mail, $commentaire, $note);

    // Exécution de la requête
    if ($requetePreparee->execute() === TRUE) {
        header("Location: confirmation.html");
        exit(); // Assure que le script s'arrête après la redirection
    } else {
        echo "Erreur lors de l'insertion des données : " . $requetePreparee->error;
    }

    // Fermer la connexion
    $connexion->close();
}
?>
