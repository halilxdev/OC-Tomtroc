<section class="book-add">

    <div class="titleOfPage">
        <div class="container">
            <h2>Ajouter un livre</h2>
        </div>
    </div>

    <div class="detail">

        <div class="bookImage">

            <div class="title">
                <h3>Photo</h3>
            </div>

            <div class="updateBookCover">
                <label for="bookCoverAdd" class="bookCoverUpdate">Ajouter une photo</label>
                <input form="updateBook" style="display: none;" type="file" id="bookCoverAdd" name="bookCoverAdd" accept="image/png, image/jpeg"/>
            </div>
           
        </div>

        <div class="bookInfos">
            
            <form id="updateBook" action="index.php?action=addBook" method="post" enctype="multipart/form-data">

                <div class="formContainer">
                    <label for="title"><h3>Titre</h3></label>
                    <input type="text" name="title" id="title">
                </div>

                <div class="formContainer">
                    <label for="author"><h3>Auteur</h3></label>
                    <input type="text" name="author" id="author">
                </div>

                <div class="formContainer">
                    <label for="desc"><h3>Description</h3></label>
                    <textarea name="desc" id="desc"></textarea>
                </div>

                <div class="formContainer">
                    <label for="status"><h3>Disponibilité</h3></label>
                    <select name="status" id="status">
                        <option value="available">Disponible</option>
                        <option value="unavailable">Indisponible</option>
                    </select>
                </div>

                <div class="form-container">
                    <button class="submit classic-button">Ajouter</button>
                </div>

            </form>

        </div>
    </div>

</section>