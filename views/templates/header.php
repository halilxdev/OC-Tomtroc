<?php
    $nbOfUnreadMsg = 14;
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
            <?php 
                $boldlinkhome = "";
                $boldlinkbookslist = "";
                $boldlinkdebug = "";
                $boldlinklogin = "";
                $boldlinkaccount = "";
                $boldlinkmsg = "";
                if(isset($_GET['action'])){
                    switch($_GET['action']){
                        case('books-list') :
                            $boldlinkbookslist = 'class="boldlink"';
                            break;
                        case('debug') :
                            $boldlinkdebug = 'class="boldlink"';
                            break;
                        case('login') :
                            $boldlinklogin = 'class="boldlink"';
                            break;
                        case('account') :
                            $boldlinkaccount = 'class="boldlink"';
                            break;
                        case('messages') :
                            $boldlinkmsg = 'class="boldlink"';
                            break;
                    }
                }else{
                    $boldlinkhome = 'class="boldlink"';
                }
            ?>

            <li><a href="./" <?=$boldlinkhome?> >
                Accueil
            </a></li>
            <li><a href="./index.php?action=books-list" <?=$boldlinkbookslist?> >
                Nos livres à l'échange
            </a></li>

        </ul>
        <ul>
            <?php if(isset($_SESSION['user'])){ ?>

            <!-- <li><a class="addCTAheader" href="./index.php?action=add-book" <?=$boldlinkaccount?>>
                <img src="./src/icons/add-outline.svg">
                Ajouter
            </a></li> -->

            <li><a href="./index.php?action=messages" <?=$boldlinkmsg?>>
                <img src="./src/icons/chatbubble-outline.svg">    
                Messagerie
                <?php 
                    if($nbOfUnreadMsg !== 0){
                        echo '<div class="nbOfMsg">'.$nbOfUnreadMsg.'</div>';
                    }
                ?>
            </a></li>
            <li><a href="./index.php?action=profile&id=<?=$_SESSION['idUser']?>" <?=$boldlinkaccount?>>
                <img src="./src/icons/person-outline.svg">
                Mon compte
            </a></li>
            <li><a href="./index.php?action=log-out">
                <img src="./src/icons/log-out-outline.svg">
                Se déconnecter
            </a></li>
            <?php } else { ?>
            <li><a href="./index.php?action=login" <?=$boldlinklogin?>>
                Connexion
            </a></li>

            <?php } ?>
        </ul>

    </nav>

</div>