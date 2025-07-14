<?php

// Rédaction des messages d'erreurs
if(!empty($errorMsg)){
    switch($errorMsg){
        case 'incomplete-fields':
            $errorMsg = 'Tous les champs sont obligatoires.';
            break;
        case 'user-doesnt-exist':
            $errorMsg = 'L\'utilisateur n\'existe pas.';
            break;
        case 'invalid-password':
            $errorMsg = 'Le mot de passe saisi est incorrect.';
            break;
    }
    $errorDiv = '
        <div class="form-container error-div">
            <img src="./public/icons/warning.svg">
            '.$errorMsg.'
        </div>
    ';
}

?>

<section class="login">

    <div class="form-div">

        <h2>Connexion</h2>

        <form action="index.php?action=connectUser" method="post">
            <div class="form-container">
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-container">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>
            <?php if(isset($errorDiv)){
                echo($errorDiv);
            }?>
            <div class="form-container">
                <button class="submit classic-button">Se connecter</button>
            </div>
        </form>

        <a href="./index.php?action=signup" class="dontHaveAccount">
            Pas de compte ? <u>Inscrivez-vous</u>
        </a>

    </div>

    <div class="image-div">
        <img src="./public/images/signup-signin.png">
    </div>

</section>



