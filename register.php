<?php
// Inclure la configuration de la base de données
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);

    // Hacher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Définir les valeurs par défaut
    $cb = NULL; // Informations bancaires non fournies
    $role = 'user'; // Rôle par défaut pour l'utilisateur
    $solde = 0.00; // Solde initial

    // Préparer la requête pour insérer l'utilisateur
    $sql = "INSERT INTO utilisateur (username, password, nom, prenom, CB, role, solde) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Initialiser la requête préparée
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Lier les paramètres à la requête
        mysqli_stmt_bind_param($stmt, "ssssssd", $username, $hashed_password, $nom, $prenom, $cb, $role, $solde);

        // Exécuter la requête
        if (mysqli_stmt_execute($stmt)) {
            // Rediriger l'utilisateur vers la page de connexion après enregistrement
            header('Location: login.php?success=1');
        } else {
            echo "Erreur lors de l'inscription : " . mysqli_error($conn);
        }

        // Fermer la requête
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="static/css/index.css">
</head>
<body id="register-page">

<div class="register-container">
    <img src="static/images/INSA.png" alt="Logo INSA" class="logo">
    <h2>Register</h2>
    <form action="register.php" method="post">
        <div class="input-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div class="input-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div class="input-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="button">S'inscrire</button>
    </form>
</div>

</body>
</html>
