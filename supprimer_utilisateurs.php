<?php
include('config.php');
include('includes/banneradmin.php');  
 

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_user_id'])) {
    $userId = intval($_GET['delete_user_id']);
    deleteUser($userId);
    $_SESSION['message'] = "Utilisateur supprimé avec succès.";
    header('Location: supprimer_utilisateurs.php');
    exit();
}

$users = getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Suppression</title>
    <link rel="stylesheet" href="static/css/index.css">
</head>
<body>
<a href="admin.php" class="back-button">Retour</a>
<div>
    <h2 style="margin-left: 8%">Liste des utilisateurs</h2>
    <?php if (isset($_SESSION['message'])) : ?>
        <p class="success"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>
    <table class="styled-table" style="margin-left: 8%">
        <tr>
            <th>id</th>
            <th>username</th>
            <th>password</th>
            <th>nom</th>
            <th>prenom</th>
            <th>CB</th>
            <th>role</th>
            <th>solde</th>
            <th>abonne</th>
            <th>Actions</th>
        </tr>
        <?php
        if (mysqli_num_rows($users) > 0) {
            while ($row = mysqli_fetch_assoc($users)) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['password']); ?></td>
                    <td><?php echo htmlspecialchars($row['nom']); ?></td>
                    <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($row['CB']); ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                    <td><?php echo htmlspecialchars($row['solde']); ?></td>
                    <td><?php echo htmlspecialchars($row['abonne']); ?></td>
                    <td>
                        <form method="GET" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                            <input type="hidden" name="delete_user_id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='10'>Aucun utilisateur trouvé.</td></tr>";
        }
        ?>
    </table>
    <br>
</div>
</body>
</html>