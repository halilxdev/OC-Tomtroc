<?php
    /**
     * Affichage de la page d'accueil. 
     */
?>

<section class="hero">
    <div class="container">
        
        <div class="text-part">
            <h2>Rejoignez nos lecteurs passionnés</h2>
            <p>
                Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres. 
            </p>
            <a class="classic-button" href="./index.php?action=books-list">
                Découvrir
            </a>
        </div>
        
        <div class="book-part">
            <a href="./index.php?action=book-detail&id=<?=$randombook['id']?>">
                <img src="<?=$randombook['cover_image']?>">
                <p><?=$randombook['uploader_username']?></p>
            </a>
        </div>

    </div>
</section>

<section class="lastadded">
    <div class="container">
        
        <h2>Les derniers livres ajoutés</h2>

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

        <a class="classic-button" href="./index.php?action=books-list">Voir tous les livres</a>

    </div>
</section>

<section class="howthisworks">
    <div class="container">
        
        <h2>Comment ça marche ?</h2>

        <p class="subtitle">
            Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :
        </p>

        <div class="list">

            <article>
                <p>
                    Inscrivez-vous gratuitement sur notre plateforme.
                </p>
            </article>

            <article>
                <p>
                    Ajoutez les livres que vous souhaitez échanger à votre profil.
                </p>
            </article>

            <article>
                <p>
                    Parcourez les livres disponibles chez d'autres membres.
                </p>
            </article>

            <article>
                <p>
                    Proposez un échange et discutez avec d'autres passionnés de lecture.
                </p>
            </article>

        </div>

        <a class="classic-button light-button" href="./index.php?action=books-list">Voir tous les livres</a>

    </div>
</section>

<section class="banner-image">
    
</section>

<section class="values">
    <div class="container">
        
        <h2>Nos valeurs</h2>

        <p class="paragraph">
            Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.
            <br><br>
            Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. 
            <br><br>
            Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.
        </p>

        <p class="signature">
            L'équipe TomTroc
        </p>

        <div class="floating-image">
            <img src="./public/icons/heart-handwriting.svg">
        </div>

    </div>
</section>