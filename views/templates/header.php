<?php
    $nbOfUnreadMsg = 1;
?>

<div class="header">

    <div class="logo">
        <a href="./">
            <div class="logo-icon">
                <span>T</span>
                <span>T</span>
            </div>
            <h1>TomTroc</h1>
        </a>
    </div>

    <nav>

        <ul>
            <li><a href="./">
                Accueil
            </a></li>
            <li><a href="./index.php?action=books-list">
                Nos livres à l'échange
            </a></li>
            <li><a href="./index.php?action=debug">
                <img src="./src/icons/code-slash-outline.svg">   
                Debug
            </a></li>
        </ul>
        <ul>
            <?php if(isset($_SESSION['is_logged'])){ ?>
            <li><a href="./index.php?action=messages">
                <img src="./src/icons/chatbubble-outline.svg">    
                Messagerie
                <?php 
                    if($nbOfUnreadMsg !== 0){
                        echo '<div class="nbOfMsg">'.$nbOfUnreadMsg.'</div>';
                    }
                ?>
            </a></li>
            <li><a href="./index.php?action=account">
                <img src="./src/icons/person-outline.svg">
                Mon compte
            </a></li>
            <li><a href="./index.php?action=log-out">
                <img src="./src/icons/log-out-outline.svg">
                Se déconnecter
            </a></li>
            <?php } else { ?>
            <li><a href="./index.php?action=login">
                Connexion
            </a></li>
            <?php } ?>
        </ul>

    </nav>

</div>