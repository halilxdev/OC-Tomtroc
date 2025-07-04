<section class="debug-section">
    <div class="container">
        <h2>Liste des membres</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th></th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                    <th>Membre depuis</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $u){ ?>
                <tr>
                    <td><?=$u->getId()?></td>
                    <td><img class="profile-picture" src="<?=$u->getProfilePicture()?>"></td>
                    <td><?=$u->getUsername()?></td>
                    <td><?=$u->getEmail()?></td>
                    <td><?=Utils::formatDate($u->getCreatedAt())?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<section class="debug-section">
    <div class="container">
        <h2>Liste des livres</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th></th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                    <th>En ligne depuis</th>
                    <th colspan="2">Mis en ligne par</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($books as $b){ ?>
                <tr>
                    <td><a href="./index.php?action=book-detail&id=<?=$b['id']?>">
                        <?=$b['id']?>
                    </a></td>
                    <td>
                        <img class="book-cover" src="<?=$b['cover_image']?>">
                    </td>
                    <td>
                        <?=$b['title']?>
                    </td>
                    <td><?=$b['author']?></td>
                    <td><?=$b['description']?></td>
                    <td><?=$b['creation_date']?></td>
                    <td>
                        <img class="profile-picture" src="<?=$b['uploader_pfp']?>">
                    </td>
                    <td>
                        <?=$b['uploader_username']?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>