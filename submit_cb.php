<?php
 include('config.php');
 include('includes/fonctions.php');
 
 if (!isset($_SESSION['user'])) {
    die("Erreur : Vous devez être connecté pour effectuer cette opération.");
}
 
    $cardNumber = $_POST['card-number'];
    $saveCard = isset($_POST['save-card']); // Vérifie si la case est cochée
    $UserId = $_SESSION['user']['id']; // Remplacez par l'ID de l'utilisateur concerné (par exemple via une session)
    $news_id = $_POST['news_id'];
    $checkQuery = "SELECT * FROM mynews WHERE id_utilisateur = '$UserId' AND id_news = '$news_id'";
    $result = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color: red; font-weight: bold;'>Vous avez déjà acheté cet article.</p>";
        echo '<a href="mynews.php" style="color: #007BFF; text-decoration: none; font-weight: bold; border: 1px solid #007BFF; padding: 10px 15px; border-radius: 5px; display: inline-block; margin-top: 20px;">Consulter vos news ici</a>';
        exit;
    }
    
    $sqlUser = "UPDATE utilisateur SET solde = solde + 2 WHERE id = $UserId";
    $resultUser = mysqli_query($conn, $sqlUser);
    
    // Récupère l'ID de l'admin
    $adminId = getAdminId();
    
    if ($adminId !== null) {
        // Transfert des 2 euros au solde de l'admin
        $sqlAdmin = "UPDATE utilisateur SET solde = solde + 2 WHERE id = $adminId";
        mysqli_query($conn, $sqlAdmin);
    }


    $sql = "INSERT INTO mynews (id_utilisateur, id_news) VALUES ('$UserId', '$news_id')";
    mysqli_query($conn, $sql);

    if ($saveCard) {
        // Requête pour mettre à jour la colonne CB
        $sql = "UPDATE utilisateur SET CB = '$cardNumber' WHERE id = $UserId";
        mysqli_query($conn, $sql);

    }
    echo '<a href="mynews.php" style="color: #007BFF; text-decoration: none; font-weight: bold; border: 1px solid #007BFF; padding: 10px 15px; border-radius: 5px; display: inline-block; margin-top: 20px;">Succès! Consulter vos news ici</a> ';
     
   

    ?>