<?php
include('config.php');
include('includes/banner.php'); 
 
 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="static/css/index.css">
</head>
<body>
    <div class="content">
        <div class="header-content">
            <h1>News</h1>
        </div>
        
        <div class="product-grid">
            <?php
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id']; // Récupère l'ID de l'utilisateur
    $allNews = getnews(); // Récupère toutes les news
    $news_user = getNewsUser($userId); // Récupère les news de l'utilisateur
    
    // Transformer les résultats de la base en tableaux
    $allNewsArray = [];
    while ($row = mysqli_fetch_assoc($allNews)) {
        $allNewsArray[] = $row;
    }
    
    $purchasedNews = [];
    while ($row = mysqli_fetch_assoc($news_user)) {
        $purchasedNews[] = $row['id']; // Ajouter chaque ID des news achetées
    }

    // Filtrage des news non achetées
    $news = array_filter($allNewsArray, function($newsItem) use ($purchasedNews) {
        return !in_array($newsItem['id'], $purchasedNews); // Exclure les news achetées
    });

    // Si l'utilisateur est abonné, afficher toutes les news
    if (isUserSubscribed($userId)) {
        header('location: newsabonne.php'); // Affiche toutes les news si l'utilisateur est abonné
    }
} else {
    // Si l'utilisateur n'est pas connecté, afficher toutes les news
    $news = [];
    $allNews = getnews();
    while ($row = mysqli_fetch_assoc($allNews)) {
        $news[] = $row;
    }
}





            // Afficher les news
            if (!empty($news)) {
                foreach ($news as $newsItem) {
                    ?>
                    <div class="product-card">
                        <img src="<?php echo $newsItem['image']; ?>" style="width: 100%; height: 200px; object-fit: cover;">
                        <div class="card-content">
                            <h2 class="title"><?php echo htmlspecialchars($newsItem['titre']); ?></h2>
                            <p class="author">Auteur: <?php echo htmlspecialchars($newsItem['autheur']); ?></p>
                            <p class="date">Publié le: <?php echo htmlspecialchars($newsItem['date']); ?></p>
                        </div>
                        <form action="paiement.php" method="POST">
                            <input type="hidden" name="news_id" value="<?php echo $newsItem['id']; ?>">
                            <button type="submit" class="unlock-button">Débloquer pour 2€</button>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Aucun article disponible pour le moment.</p>";
            }
            ?>
        </div>
    </div>

    <script src="static/js/index.js"></script>
</body>
</html>

<?php include('includes/footer.php'); ?>
