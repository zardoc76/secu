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
    // Traitement de la soumission du formulaire
    $userId = $_SESSION['user']['id'];
    $cardNumber = $_POST['card-number'];

    if (!empty($cardNumber)) {
        // Met à jour la colonne `abonne` et enregistre le numéro de carte
        $sql = "UPDATE utilisateur SET abonne = 1, CB = '$cardNumber', solde = solde + 10 WHERE id = $userId";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $adminId = getAdminId();
            if ($adminId !== null) {
                // Transfert des 10 euros vers le solde de l'admin
                $sqlAdmin = "UPDATE utilisateur SET solde = solde + 10 WHERE id = $adminId";
                mysqli_query($conn, $sqlAdmin);
            }
            echo "<p style='color: green; font-weight: bold;'>Vous êtes maintenant abonné !</p>";
            echo '<a href="index.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">Retour à l\'accueil</a>';
        } else {
            echo "<p style='color: red; font-weight: bold;'>Une erreur est survenue. Veuillez réessayer plus tard.</p>";
            echo '<a href="subscribe.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">Réessayer</a>';
        }
    } else {
        echo "<p style='color: red; font-weight: bold;'>Le numéro de carte est obligatoire.</p>";
        echo '<a href="subscribe.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">Réessayer</a>';
    }
} else {
    // Affiche le formulaire si ce n'est pas encore soumis
    ?>
    <div class="form-container" style="width: 300px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h1 style="text-align: center; font-size: 24px; font-weight: bold; color: #333; line-height: 1.5; margin-bottom: 20px;">
    S'abonner pour 10€ / mois <br> 
    <span style="font-size: 18px; color: #555;">Accédez à toutes les news et exclusivités</span>
</h1>
        <form action="subscribe.php" method="post">
            <label for="card-number">Numéro de Carte Bancaire :</label>
            <input type="text" id="card-number" name="card-number" placeholder="0000 0000 0000 0000" maxlength="19" required style="width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px;">

            <input type="submit" value="Confirmer l'abonnement" style="width: 100%; padding: 10px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">
        </form>
        <div style="text-align: center; margin-top: 10px;">
            <a href="index.php" style="color: #007BFF; text-decoration: none;">Annuler</a>
        </div>
    </div>
    <?php
}
?>
