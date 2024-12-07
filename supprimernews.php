<?php
include('config.php');
include('includes/fonctions.php'); // Inclut le fichier de fonctions
if (isset($_POST['delete_news'])) { // Vérifie si le formulaire est soumis
    $news_id = $_POST['news_id'];
    deletenews($news_id); // Appelle la fonction pour supprimer la news
    header('Location: admin.php'); // Redirige vers la page admin
    exit; // Assure la fin de l'exécution
}
?>