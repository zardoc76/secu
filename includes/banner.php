<!DOCTYPE html>
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
        }
        

    </style>
</head>
<body>
<?php if (isset($_SESSION['user']['username'])) : ?>
    <div class="logged_in_info">
        <span>Welcome, <?php echo $_SESSION['user']['username']; ?></span> |
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
