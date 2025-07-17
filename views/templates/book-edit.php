<section class="book-edit">

    <div class="breadcrumbs">
        <div class="container">
            <a href="./index.php?action=profile&id=<?=$book['uploader_id']?>"><- Retour</a>
        </div>
    </div>

    <div class="titleOfPage">
        <div class="container">
            <h2>Modifier les informations</h2>
        </div>
    </div>

    <div class="detail">

        <div class="bookImage">

            <div class="title">
                <h3>Photo</h3>
            </div>
            
            <div class="bookCover">
                <img src="<?=$book['cover']?>">
            </div>

            <div class="updateBookCover">
                <label for="bookCoverUpdate" class="bookCoverUpdate">Modifier la photo</label>
                <input form="updateBook" style="display: none;" type="file" id="bookCoverUpdate" name="bookCoverUpdate" accept="image/png, image/jpeg"/>
            </div>
           
        </div>

        <div class="bookInfos">
            
            <form id="updateBook" action="index.php?action=updateBook&id=<?=$book['id']?>" method="post" enctype="multipart/form-data">

                <div class="formContainer">
                    <label for="title"><h3>Titre</h3></label>
                    <input type="text" name="title" id="title" value="<?=$book['title']?>">
                </div>

                <div class="formContainer">
                    <label for="author"><h3>Auteur</h3></label>
                    <input type="text" name="author" id="author" value="<?=$book['author']?>">
                </div>

                <div class="formContainer">
                    <label for="desc"><h3>Description</h3></label>
                    <textarea name="desc" id="desc"><?=$book['description']?>
                    </textarea>
                </div>

                <div class="formContainer">
                    <label for="disponibility"><h3>Disponibilité</h3></label>
                    <select name="disponibility" id="disponibility">
                        <option value="available">Disponible</option>
                        <option value="unavailable">Indisponible</option>
                    </select>
                </div>

                <div class="form-container">
                    <button class="submit classic-button">Valider</button>
                </div>

            </form>

        </div>
    </div>

</section>