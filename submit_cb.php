<?php
 include('config.php');
 
 if (!isset($_SESSION['user'])) {
    die("Erreur : Vous devez être connecté pour effectuer cette opération.");
}
 
    $cardNumber = $_POST['card-number'];
    $saveCard = isset($_POST['save-card']); // Vérifie si la case est cochée
    $UserUsername = $_SESSION['user']['username']; // Remplacez par l'ID de l'utilisateur concerné (par exemple via une session)
   var_dump($UserUsername, $cardNumber, $saveCard);
    if ($saveCard) {
        // Requête pour mettre à jour la colonne CB
        $sql = "UPDATE utilisateur SET CB = '$cardNumber' WHERE username = $UserUsername";
        mysqli_query($conn, $sql);
        

        echo "Votre carte a été enregistrée avec succès.";
    } else {
        echo "La case n'a pas été cochée. Rien n'a été enregistré.";
    }
    ?>