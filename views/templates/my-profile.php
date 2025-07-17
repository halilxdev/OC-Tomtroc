<?php
    $available = '<div class="bookStatus statusAvailable">';
    $unavailable = '<div class="bookStatus statusUnavailable">';
    
    // Rédaction des messages d'erreurs
    if(!empty($errorMsg)){
        switch($errorMsg){
            case 'incomplete-fields':
                $errorMsg = 'Tous les champs sont obligatoires.';
                break;
            case 'username-length-invalid':
                $errorMsg = 'Le pseudo choisi est trop long. Maximum 20 caractères.';
                break;
            case 'email-invalid':
                $errorMsg = 'L\'adresse mail saisie appartient à un compte existant.';
                break;
            case 'password-too-short':
                $errorMsg = 'Le mot de passe est trop court. Minimum 5 caractères';
                break;
            case 'avatar-invalid-format':
                $errorMsg = 'L\'image de profil est invalide. Veuillez essayer une autre image.';
                break;
        }
        $errorDiv = '
            <div class="form-container error-div">
                <img src="./public/icons/warning.svg">
                '.$errorMsg.'
            </div>
        ';
    }

    // Rédaction des messages d'erreurs
    if(!empty($successMsg)){
        switch($successMsg){
            case 'valid':
                $successMsg = 'Votre profil a bien été modifié.';
                break;
        }
        $successMsg = '
            <div class="form-container success-div">
                <img src="./public/icons/happy.svg">
                '.$successMsg.'
            </div>
        ';
    }
?>

<link rel="stylesheet" href="./public/css/my-profile.css">

<h2 class="page-title">Mon compte</h2>

<?php if(isset($successMsg)){echo $successMsg;}?>

<?php if(isset($errorDiv)){echo $errorDiv;}?>

<section class="all-page">

    <section class="profile-infos">

        <div class="container-profile">
            <div class="top-part">
                <img src="<?=$user['image']?>">
                <label for="avatar" class="update-pfp-link">Modifier</label>
                <input form="update-user" style="display: none;" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg"/>
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
                    <img src="./public/icons/library-outline.svg">
                    <?=$user['nb_books']?> livre(s)
                </div>

            </div>
        </div>

        <div class="container-updater">

            <h2>Vos informations personnelles</h2>
            
            <form id="update-user" action="index.php?action=updateUser&id=<?=$user['id']?>" method="post" enctype="multipart/form-data">


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