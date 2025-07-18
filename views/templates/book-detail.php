<section class="book-detail">

    <div class="breadcrumbs">
        <div class="container">
            <a href="./index.php?action=books-list">Nos livres > </a> <?=$book['title']?>
        </div>
    </div>

    <div class="detail">
        <div class="book-cover">
            <img src="<?=$book['cover']?>">
        </div>
        <div class="book-infos">
            <div class="title">
                <h2><?=$book['title']?></h2>
            </div>
            <div class="author">
                Par <?=$book['author']?>
            </div>

            <div class="separator">
                <hr>
            </div>

            <div class="description-title">
                <h3>Description</h3>
            </div>
            <div class="description-content">
                <p><?=$book['description']?></p>
            </div>

            <div class="uploader-title">
                <h3>Propriétaire</h3>
            </div>

            <div class="uploader">
                <a href="./index.php?action=profile&id=<?=$book['uploader_id']?>">
                    <article>
                        <img src="<?=$book['uploader_image']?>">
                        <p><?=$book['uploader_username']?></p>
                    </article>
                </a>
            </div>
            
            <?php if(isset($_SESSION['user'])){
                if($_SESSION['idUser'] !== $book['uploader_id']){ ?>
                <div class="classic-button">
                    <a href="./index.php?action=listOfMsg&fromUser=<?=$book['uploader_id']?>">
                        Envoyer un message
                    </a>
                </div>
            <?php } } ?>

        </div>
    </div>

</section>