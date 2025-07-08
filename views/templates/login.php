<section class="login">

    <div class="form-div">

        <h2>Connexion</h2>

        <form action="index.php?action=connectUser" method="post">
            <div class="form-container">
                <label for="email">Adresse email</label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="form-container">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-container">
                <button class="submit classic-button">Se connecter</button>
            </div>
        </form>

        <a href="./index.php?action=signup" class="dontHaveAccount">
            Pas de compte ? <u>Inscrivez-vous</u>
        </a>

    </div>

    <div class="image-div">
        <img src="./src/images/signup-signin.png">
    </div>

</section>



