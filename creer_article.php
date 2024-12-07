<?php
include('config.php');
include('includes/banneradmin.php');  
 


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['create_article'])) {
    $titre = mysqli_real_escape_string($conn, $_GET['titre']);
    $contenu = mysqli_real_escape_string($conn, $_GET['contenu']);
    $image = mysqli_real_escape_string($conn, $_GET['image']);
    $date = mysqli_real_escape_string($conn, $_GET['date']);
    $autheur = mysqli_real_escape_string($conn, $_GET['autheur']);

    // Insert new article into the database (vulnerable to SQL injection)
    $sql = "INSERT INTO news (titre, content, image, date, autheur) VALUES ('$titre', '$contenu', '$image', '$date', '$autheur')";
    mysqli_query($conn, $sql);

    $_SESSION['message'] = "Article créé avec succès.";
    header('Location: creer_article.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer Article</title>
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
        .form-container .input-group input,
        .form-container .input-group textarea {
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
        .success {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>
<a href="admin.php" class="back-button">Retour</a>
<div class="form-container">
    <h2>Créer un article</h2>
    <?php if (isset($_SESSION['message'])) : ?>
        <p class="success"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>
    <form method="GET">
        <div class="input-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" required>
        </div>
        <div class="input-group">
            <label for="contenu">Contenu</label>
            <textarea id="contenu" name="contenu" rows="10" required></textarea>
        </div>
        <div class="input-group">
            <label for="image">URL de l'image</label>
            <input type="text" id="image" name="image">
        </div>
        <div class="input-group">
            <label for="date">Date</label>
            <input type="text" id="date" name="date" required>
        </div>
        <div class="input-group">
            <label for="autheur">Auteur</label>
            <input type="text" id="autheur" name="autheur" required>
        </div>
        <button type="submit" class="button" name="create_article">Créer</button>
    </form>
</div>
</body>
</html>