<?php
include('config.php');

include('includes/banner.php'); 

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> News </title>
    
    <link rel="stylesheet" href="static/css/index.css">
</head>
<body>
    <div class="content">
        <div class="header-content">
    
            <h1> News</h1>
        </div>
        
        <div class="product-grid">
    <?php 
    $userId = $_SESSION['user']['id'];
    $news = getnews($userId);

    
    if (mysqli_num_rows($news) > 0) 
    {
        while ($row = mysqli_fetch_assoc($news)) 
        {
            ?>
            <div class="product-card"   >
                
                <img src="<?php echo $row['image']; ?>" style="width: 100%; height: 200px; object-fit: cover;">
                <div class="card-content">
                    
                    <h2 class="title"><?php echo htmlspecialchars($row['titre']); ?></h2>
                    
                    <p class="author">Auteur: <?php echo htmlspecialchars($row['autheur']); ?></p>
                    
                    
                    <p class="date">Publié le: <?php echo htmlspecialchars($row['date']); ?></p>
                </div>
                <form action="consulter.php" method="POST">
                <input type="hidden" name="news_id" value="<?php echo $row['id']; ?>">
                <button type="submit"  class="unlock-button">consulter</button>
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
