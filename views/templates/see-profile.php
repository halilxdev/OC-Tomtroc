<link rel="stylesheet" href="./src/css/see-profile.css">

<section class="profile">

    <div class="container">

        <div class="container-profile">
            <div class="top-part">
                <img src="<?=$user['image']?>">
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
                <div class="classic-button light-button">
                    <a href="./index.php?action=send-message&id=<?=$user['id']?>">Envoyer un message</a>
                </div>

            </div>
        </div>

        <div class="container-books">
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Description</th>
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

    </div>

</section>