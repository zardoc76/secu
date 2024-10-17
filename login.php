<?php
// Inclure la configuration de la base de données
include('config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Préparer la requête pour sélectionner l'utilisateur
    $sql = "SELECT id, password FROM utilisateur WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Lier les paramètres
        mysqli_stmt_bind_param($stmt, "s", $username);

        // Exécuter la requête
        mysqli_stmt_execute($stmt);

        // Récupérer le résultat
        mysqli_stmt_bind_result($stmt, $id, $hashed_password);
        mysqli_stmt_fetch($stmt);

        // Vérifier le mot de passe
        if (password_verify($password, $hashed_password)) {
            // Stocker l'utilisateur dans la session
            $_SESSION['user_id'] = $id;
            header('Location: index.php'); // Redirection vers la page principale après connexion
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
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
    <title>Login</title>
    <link rel="stylesheet" href="static/css/index.css">
</head>
<body id="login-page">

<div class="login-container">
    <img src="static/images/INSA.png" alt="Logo INSA" class="logo">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <div class="input-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="button">Connexion</button>
    </form>
</div>

</body>
</html>
