<div>
    <?php
    echo '<form class="main-things" action="http://product.trunk/admin/addEditFeedback/?red_id='.$data[0]['id'].'" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputReviewer">Ваше имя</label>
                <input type="text" name="reviewer" class="form-control" id="inputReviewer" value="'.$data[0]['reviewer'].'" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail">E-mail</label>
                <input type="text" name="email" class="form-control" id="inputEmail" value="'.$data[0]['email'].'" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="inputText_review">Текст отзыва</label>
            <textarea class="form-control" name="text_review" id="inputFeedback" rows="4" required>'.$data[0]['text_review'].'</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>';
    ?>
</div>