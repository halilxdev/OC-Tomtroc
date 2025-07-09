<?php
    $available = '<div class="bookStatus statusAvailable">';
    $unavailable = '<div class="bookStatus statusUnavailable">';
?>

<link rel="stylesheet" href="./src/css/my-profile.css">

    <h2 class="page-title">Mon compte</h2>

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

            <h2>Vos informations personnelles</h2>
            
            <form action="index.php?action=updateUser&id=<?=$user['id']?>" method="post">

                <div class="form-container">
                    <label for="email">Adresse email</label>
                    <input type="text" name="email" id="email" value="<?=$user['email']?>">
                </div>

                <div class="form-container">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="********">
                </div>

                <div class="form-container">
                    <label for="username">Pseudo</label>
                    <input type="text" name="username" id="username" required value="<?=$user['username']?>">
                </div>

                <div class="form-container">
                    <button class="submit classic-button light-button">Enregistrer</button>
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
                            <td>
                                <?php if($bk['status'] === 'available'){
                                    echo $available.'Disponible</div>';
                                }else{
                                    echo $unavailable.'Indisponible</div>';
                                }?>
                            </td>
                            <td>
                                <a class="updateBook" href="./index.php?action=edit-book&id=<?=$bk['id']?>">Éditer</a>
                                <a class="deleteBook" href="./index.php?action=delete-book&id=<?=$bk['id']?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </section>

</section>