<!DOCTYPE html>
<?php include('includes/fonctions.php'); ?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyVulnerableSite</title>

    <style>
        /* Styles pour la bannière */
        .banner {
            background-color: #fff; /* Fond blanc pour la bannière */
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Ombre légère pour une meilleure séparation */
			min-height: 80px;
        }
        .logo {
            font-family: 'Georgia', serif; /* Police classique pour le style littéraire */
            font-size: 1.5em;
            color: #4b5d29; /* Couleur verte similaire */
            font-weight: bold;
        }
        .buttons {
            display: flex;
            gap: 10px;
        }
        .buttons button {
            background-color: #4b5d29; /* Couleur verte */
            color: #fff;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .buttons button:hover {
            background-color: #3b4a22; /* Couleur plus foncée au survol */
        }
        .logged_in_info {
        text-align: right;
        padding: 10px;
        background-color: #f8f9fa; /* Couleur de fond légère */
        border: 1px solid #ddd; /* Bordure discrète */
        border-radius: 5px; /* Coins arrondis */
        font-family: 'Arial', sans-serif; /* Police moderne */
        font-size: 14px; /* Taille de texte agréable */
        color: #333; /* Couleur de texte neutre */
        }

        .logged_in_info span {
            margin-right: 10px; /* Espacement entre les éléments */
        }

        .logged_in_info a {
            text-decoration: none; /* Supprime les soulignements */
            color: #007bff; /* Couleur bleue pour les liens */
            transition: color 0.3s ease; /* Effet de transition sur les liens */
        }

        .logged_in_info a:hover {
            color: #0056b3; /* Couleur plus sombre au survol */
        }

        .logged_in_info span:last-child a {
            font-weight: bold; /* Met en gras le lien de déconnexion */
            color: #dc3545; /* Couleur rouge pour signaler une action importante */
        }

        .logged_in_info span:last-child a:hover {
            color: #a71d2a; /* Rouge plus foncé au survol */
        }
        

    </style>
</head>
<body>

<?php if (isset($_SESSION['user']['username'])) : 
      $user_id = $_SESSION['user']['id'];
     ?>
   
    <div class="logged_in_info">
        <span>Welcome, <?php echo $_SESSION['user']['username']; ?></span>| 
        <span><a href="mynews.php"> Mes News</a></span>|
      <?php  
    if (!isUserSubscribed($user_id)) { 
    ?>
        <span><a href="subscribe.php">S'abonner</a></span>|
    <?php 
    } else { 
    ?>
        <span><a href="unsubscribe.php">Se desabonner</a></span>|
    <?php 
    }
    ?>

        <span><a href="logout.php">Logout</a></span>
    </div>
<?php else : ?>
    <header>
        <div class="banner">
            <div class="logo">MyVulnerableSite</div>
            <div class="buttons">
                <button onclick="window.location.href='login.php'">Se connecter</button>
                <button onclick="window.location.href='register.php'">S'inscrire</button>
            </div>
        </div>
    </header>
<?php endif; ?>
</body>
</html>
