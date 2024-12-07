<!DOCTYPE html>
<?php include('config.php'); ?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie Numéro CB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
            font-size: 18px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
        .checkbox-label {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
if (isset($_SESSION['user'])) { 
    // Affiche le formulaire si l'utilisateur est connecté
    ?>
    <div class="form-container">
        <h1>Saisie CB</h1>
        <form action="submit_cb.php" method="post">
            <label for="card-number">Numéro de Carte Bancaire :</label>
            <input type="text" id="card-number" name="card-number" placeholder="0000 0000 0000 0000" maxlength="19" required>

            <div class="checkbox-label">
                <input type="checkbox" id="save-card" name="save-card">
                <label for="save-card">Enregistrer votre CB pour les futures transactions</label>
            </div>
            <input type="hidden" name="news_id" value="<?php echo $_POST['news_id']; ?>">
            <input type="submit" value="Valider">
        </form>
    </div>
    <?php
} else {
    // Affiche un message si l'utilisateur n'est pas connecté
    echo "Vous devez être connecté pour effectuer cette opération.";
    ?>
    <a href="index.php" style="color: #007BFF;   font-weight: bold;">C'est par ici !</a>

    <?php
}
?>




</body>
</html>
