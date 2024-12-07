<?php
include('config.php');
include('includes/banneradmin.php');
 



if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['update_article'])) {
    $article_id = $_GET['article_id'];
    $titre = mysqli_real_escape_string($conn, $_GET['titre']);
    $contenu = mysqli_real_escape_string($conn, $_GET['contenu']);
    $image = mysqli_real_escape_string($conn, $_GET['image']);

    // Update article in the database (vulnerable to SQL injection)
    $sql = "UPDATE news SET titre='$titre', content='$contenu', image='$image' WHERE id='$article_id'";
    mysqli_query($conn, $sql);

    $_SESSION['message'] = "Article mis à jour avec succès.";
    header('Location: consulteradmin.php?id=' . $article_id);
    exit();
}

if (isset($_GET['id'])) {
    $article_id = intval($_GET['id']);

    // Select article from the database (vulnerable to SQL injection)
    $sql = "SELECT * FROM news WHERE id='$article_id'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $article = mysqli_fetch_assoc($result);
    } else {
        echo "Article non trouvé.";
        header('Location: admin.php');
        exit();
    }
} else {
    header('Location: admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter Article</title>
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
        #cg{
            background-color: red;
        }
    </style>
</head>
<body>
<a href="admin.php" class="back-button">Retour</a>
<div class="form-container">
    <h2>Modifier l'article</h2>
    <?php if (isset($_SESSION['message'])) : ?>
        <p class="success"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>
    <form method="GET">
        <div class="input-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($article['titre']); ?>" required>
        </div>
        <div class="input-group">
            <label for="contenu">Contenu</label>
            <textarea id="contenu" name="contenu" rows="10" required><?php echo htmlspecialchars($article['content']); ?></textarea>
        </div>
        <div class="input-group">
            <label for="image">URL de l'image</label>
            <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($article['image']); ?>">
        </div>
        <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>">
        <button type="submit" class="button" name="update_article">Enregistrer les modifications</button>
        
        </form>
<form action="supprimernews.php" method="POST">
    <input type="hidden" name="news_id" value="<?php echo $article['id']; ?>"> <!-- ID de la news à supprimer -->
    <button type="submit" class="button" id="cg" name="delete_news">Supprimer</button>
</form>


</div>
</body>
</html>

