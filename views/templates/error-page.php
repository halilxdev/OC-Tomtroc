<?php
    echo '<link rel="stylesheet" href="./public/css/error.css">';
?>

<div class="error">
    <h2>Erreur</h2>
    <p><?= $errorMessage ?></p>
    <a href="index.php?action=home" class="classic-button">Retour à la page d'accueil</a>
</div>