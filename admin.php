<?php
include('config.php');
include('includes/banneradmin.php');  
 

?>
 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My News</title>
    <link rel="stylesheet" href="static/css/index.css">

</head>
<body>
    <div class="content">
        <div class="header-content">
            <h1>My News</h1>
        </div>
        
         
        
        

        <div class="product-grid">
            <?php 
            $news = getnews();
            
            if (mysqli_num_rows($news) > 0) {
                while ($row = mysqli_fetch_assoc($news)) {
                    ?>
                    <div class="product-card">
                        
                        <img src="<?php echo $row['image']; ?>" style="width: 100%; height: 200px; object-fit: cover;">
                        <div class="card-content">
                            
                            <h2 class="title"><?php echo htmlspecialchars($row['titre']); ?></h2>
                            
                            <p class="author">Auteur: <?php echo htmlspecialchars($row['autheur']); ?></p>
                            
                            <p class="date">Publié le: <?php echo htmlspecialchars($row['date']); ?></p>
                        </div>
                         <button class="edit-button" onclick="window.location.href='consulteradmin.php?id=<?php echo $row['id']; ?>'">Consulter/Editer</button>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Aucun article disponible pour le moment.</p>";
            }
            ?>
        </div>
    </div>

     
</body>
</html>

<?php include('includes/footer.php'); ?>