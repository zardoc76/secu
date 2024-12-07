<?php
include('config.php'); // Inclut la configuration et la connexion à la base de données
include('includes/fonctions.php'); // Inclut les fonctions utiles

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    echo "Vous devez être connecté pour effectuer cette opération.";
    echo '<a href="index.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">Retour à l\'accueil</a>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement de la soumission du formulaire pour se désabonner
    $userId = $_SESSION['user']['id'];
    
    // Met à jour la colonne `abonne` pour indiquer que l'utilisateur n'est plus abonné
    $sql = "UPDATE utilisateur SET abonne = 0 WHERE id = $userId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<p style='color: green; font-weight: bold;'>Vous êtes maintenant désabonné !</p>";
        echo '<a href="index.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">Retour à l\'accueil</a>';
    } else {
        echo "<p style='color: red; font-weight: bold;'>Une erreur est survenue. Veuillez réessayer plus tard.</p>";
        echo '<a href="unsubscribe.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">Réessayer</a>';
    }
} else {
    // Affiche un message pour confirmer le désabonnement
    ?>
    <div class="form-container" style="width: 300px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h1 style="text-align: center; font-size: 24px; font-weight: bold; color: #333; line-height: 1.5; margin-bottom: 20px;">
    Se désabonner <br> 
    <span style="font-size: 18px; color: #555;">Vous ne recevrez plus les news et mises à jour</span>
    </h1>
        <p style="text-align: center;">Êtes-vous sûr de vouloir vous désabonner ?</p>
        <form action="unsubscribe.php" method="post" style="text-align: center;">
            <input type="submit" value="Confirmer la désinscription" style="width: 100%; padding: 10px; background-color: #FF5733; color: white; border: none; border-radius: 5px; cursor: pointer;">
        </form>
        <div style="text-align: center; margin-top: 10px;">
            <a href="index.php" style="color: #007BFF; text-decoration: none;">Annuler</a>
        </div>
    </div>
    <?php
}
?>
