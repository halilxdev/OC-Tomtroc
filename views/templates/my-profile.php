<link rel="stylesheet" href="./src/css/my-profile.css">

<section class="all-page">

    <section class="profile-infos">

        <div class="container-profile">
            <div class="top-part">
                <img src="<?=$user['image']?>">
                <a href="./index.php?action=updateProfilePicture&id=<?=$user['id']?>">Modifier</a>
            </div>
            <hr>
            <div class="bottom-part">
                <div class="pseudo">
                    <h2><?=$user['username']?></h2>
                </div>
                <div class="memberSince">
                    <p>Membre depuis <?=$user['since']?></p>
                </div>
                <div class="h3">
                    <h3>Bibliothèque</h3>
                </div>
                <div class="nbOfBooks">
                    <img src="./src/icons/library-outline.svg">
                    <?=$user['nb_books']?> livre(s)
                </div>

            </div>
        </div>

        <div class="container-updater">
            
            <form action="index.php?action=updateUser&id=<?=$user['id']?>" method="post">

                <div class="form-container">
                    <label for="email">Adresse email</label>
                    <input type="text" name="email" id="email" required placeholder="<?=$user['email']?>">
                </div>

                <div class="form-container">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required placeholder="********">
                </div>

                <div class="form-container">
                    <label for="username">Pseudo</label>
                    <input type="text" name="username" id="username" required placeholder="<?=$user['username']?>">
                </div>

                <div class="form-container">
                    <button class="submit classic-button light-button">S'inscrire</button>
                </div>
            </form>

        </div>

    </section>

    <section class="profile-books">

        <div class="container-books">
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Description</th>
                        <th>Disponibilité</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($user_books as $bk){ ?>
                        <tr>
                            <td class="image"><a href="./index.php?action=book-detail&id=<?=$bk['id']?>">
                                <div class="imgcontainer"><img src="<?=$bk['image']?>"></div>
                            </a></td>
                            <td><a href="./index.php?action=book-detail&id=<?=$bk['id']?>">
                                <?=$bk['title']?>
                            </a></td>
                            <td><a href="./index.php?action=book-detail&id=<?=$bk['id']?>">
                                <?=$bk['author']?>
                            </a></td>
                            <td><a href="./index.php?action=book-detail&id=<?=$bk['id']?>">
                                <?=$bk['description']?>
                            </a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </section>

</section>