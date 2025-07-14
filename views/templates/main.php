<?php 
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | TomTroc</title>
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="./public/css/header.css">
    <link rel="stylesheet" href="./public/css/footer.css">
    <link rel="stylesheet" href="./public/css/book-card.css">
    <?php if(isset($_GET['action'])) { // Ce code permet d'appeler automatiquement le CSS
        echo '<link rel="stylesheet" href="./public/css/'.$_GET['action'].'.css">';
    }else{
        echo '<link rel="stylesheet" href="./public/css/home.css">';
    }?> 
</head>

<body>
    <header>
        <?php require './views/templates/header.php';?>
    </header>

    <main>
        <?= $content ?>
    </main>
    
    <footer>
        <?php require './views/templates/footer.php';?>
    </footer>

</body>
</html>