<section class="signup">

    <div class="form-div">

        <h2>Connexion</h2>

        <form action="index.php?action=signupUser" method="post">
            <div class="form-container">
                <label for="username">Pseudo</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-container">
                <label for="email">Adresse email</label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="form-container">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-container">
                <button class="submit classic-button">S'inscrire'</button>
            </div>
        </form>

        <a href="./index.php?action=login" class="dontHaveAccount">
            Déjà inscrit ? <u>Connectez-vous</u>
        </a>

    </div>

    <div class="image-div">
        <img src="./src/images/signup-signin.png">
    </div>

</section>



