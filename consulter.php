<?php
include('config.php');
include('includes/banner.php'); 
// Vérifie si un ID d'article a été transmis
if (!isset($_POST['news_id'])) {
    die("Erreur : Aucun article sélectionné.");
}

$news_id = $_POST['news_id'];

// Requête pour récupérer les détails de l'article
$sql = "SELECT titre, autheur, date, image, content FROM news WHERE id = '$news_id'";
$result = mysqli_query($conn, $sql);

// Vérifie si l'article existe
if (mysqli_num_rows($result) > 0) {
    $news = mysqli_fetch_assoc($result);
} else {
    die("Erreur : L'article demandé est introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($news['titre']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .news-container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .news-container img {
    max-width: 100%; /* L'image ne dépasse pas la largeur du conteneur */
    max-height: 300px; /* Limite la hauteur maximale */
    width: auto; /* Maintient les proportions si la largeur est inférieure */
    height: auto; /* Maintient les proportions si la hauteur est inférieure */
    display: block; /* Centre l'image dans son conteneur */
    margin: 0 auto 20px auto; /* Centre horizontalement et ajoute un espace en bas */
    border-radius: 5px; /* Arrondit légèrement les coins */
}
        .news-title {
            font-size: 2em;
            margin-bottom: 10px;
            color: #333;
        }
        .news-meta {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 20px;
        }
        .news-content {
            font-size: 1.2em;
            line-height: 1.6;
            color: #444;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="news-container">
        <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="Image de l'article">
        <h1 class="news-title"><?php echo htmlspecialchars($news['titre']); ?></h1>
        <p class="news-meta">
            Auteur : <?php echo htmlspecialchars($news['autheur']); ?> | 
            Publié le : <?php echo htmlspecialchars($news['date']); ?>
        </p>
        <div class="news-content">
            <?php echo nl2br(htmlspecialchars($news['content'])); ?>
        </div>
        <?php if(isUserSubscribed($user_id)) { ?>
    <a href="newsabonne.php" class="back-link">Retour à Mes News</a>
<?php } else { ?>
    <a href="mynews.php" class="back-link">Retour à Mes News</a>
<?php } ?>

    </div>
</body>
</html>
<?php include('includes/footer.php'); ?>