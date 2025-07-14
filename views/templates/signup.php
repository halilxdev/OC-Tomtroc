<?php

// Rédaction des messages d'erreurs
if(!empty($errorMsg)){
    switch($errorMsg){
        case 'incomplete-fields':
            $errorMsg = 'Tous les champs sont obligatoires.';
            break;
        case 'username-length':
            $errorMsg = 'Le pseudo choisi est trop long. Maximum 20 caractères.';
            break;
        case 'existing-email':
            $errorMsg = 'L\'adresse mail saisie appartient à un compte existant.';
            break;
        case 'password-length':
            $errorMsg = 'Le mot de passe est trop long. Maximum 20 caractères';
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

<section class="signup">

    <div class="form-div">

        <h2>Inscription</h2>

        <form action="index.php?action=signupUser" method="post">
            <div class="form-container">
                <label for="username">Pseudo</label>
                <input type="text" name="username" id="username" required>
            </div>
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
                <button class="submit classic-button">S'inscrire</button>
            </div>
        </form>

        <a href="./index.php?action=login" class="dontHaveAccount">
            Déjà inscrit ? <u>Connectez-vous</u>
        </a>

    </div>

    <div class="image-div">
        <img src="./public/images/signup-signin.png">
    </div>

</section>



