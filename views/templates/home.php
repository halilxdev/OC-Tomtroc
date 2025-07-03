<?php
    /**
     * Affichage de la page d'accueil. 
     */
?>

<section class="books-list">
    <div class="container">
        <h2>La liste des livres</h2>
        <div class="list">
            <?php foreach($books as $b){
                echo '<div class="book"><a href="./index.php?action=book&id='.$b->getId().'">';
                echo '<div class="cover-image">';
                echo '<img src="'.$b->getCoverImage().'">';
                echo '</div>';
                echo '<p class="title">'.$b->getTitle().'</p>';
                echo '<p class="author">'.$b->getAuthor().'</p>';
                echo '</a></div>';
            }?>
        </div>
    </div>
</section>