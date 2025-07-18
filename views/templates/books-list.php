<section class="books-list">

    <div class="container">

        <div class="books-list-header">

            <h2>Nos livres à l'échange</h2>

            <form method="get" action="">
                <input type="hidden" name="action" value="listBooks">
                <input type="text" name="search" placeholder="Rechercher un livre">
                <button type="submit"></button>
            </form>

        </div>

        <div class="list">

            <?php foreach($books as $b){ ?>

                <a href="./index.php?action=book-detail&id=<?=$b['id']?>">
                    <article class="book">

                        <div class="book-cover">
                            <img src="<?=$b['cover_image']?>">
                        </div>

                        <div class="infos">
                            <h3 class="title"><?=$b['title']?></h3>
                            <p class="author"><?=$b['author']?></p>
                            <p class="seller">Vendu par : <span><?=$b['uploader_username']?></span></p>
                        </div>

                    </article>
                </a>

            <?php } ?>
            
        </div>

    </div>

</section>