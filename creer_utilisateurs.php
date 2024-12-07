<?php
include('config.php');
include('includes/banneradmin.php');  
 


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['create_user'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];
    $nom = $_GET['nom'];
    $prenom = $_GET['prenom'];
    $role = $_GET['role'];
    
 

    // Validate required fields
    if (!empty($username) && !empty($password) && !empty($nom) && !empty($prenom)) {

        if (empty($role))
        {
            $role = 'user';
        }
        // Encrypt password
        $password = md5($password);
        // Insert user into the database
        $sql = "INSERT INTO utilisateur (username, password, nom, prenom, role) VALUES ('$username', '$password', '$nom', '$prenom', '$role')";
        mysqli_query($conn, $sql);
        $_SESSION['cu_message'] = "Utilisateur créé avec succès.";
        header('Location: creer_utilisateurs.php');
        exit();
    } else {
        $error = "Tous les champs obligatoires doivent être remplis.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer Utilisateurs</title>
    <link rel="stylesheet" href="static/css/index.css">
    <style>
        .form-container {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            max-width: 600px;
            background-color: #f9f9f9;
        }
        .form-container h2 {
            text-align: center;
        }
        .form-container .input-group {
            margin: 10px 0;
        }
        .form-container .input-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-container .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container .button {
            width: 100%;
            padding: 10px;
            background-color: #009879;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-container .button:hover {
            background-color: #007f63;
        }
        .error {
            color: red;
            text-align: center;
        }
        .success {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>
<a href="admin.php" class="back-button">Retour</a>
<div class="form-container">
    <h2>Créer un utilisateur</h2>
    <?php if (isset($error)) : ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['cu_message'])) : ?>
        <p class="success"><?php echo $_SESSION['cu_message']; unset($_SESSION['cu_message']); ?></p>
    <?php endif; ?>
    <form method="GET">
        <div class="input-group">
            <label for="username">Username  </label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Password  </label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="input-group">
            <label for="nom">Nom  </label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div class="input-group">
            <label for="prenom">Prénom  </label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
         
        <div class="input-group">
            <label for="role">Role</label>
            <input type="text" id="role" name="role">
        </div>
         
         
        <button type="submit" class="button" name="create_user">Créer</button>
    </form>
</div>
</body>
</html>