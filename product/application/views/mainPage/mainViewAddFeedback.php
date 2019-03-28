<div>
    <?php
        echo '<form class="main-things" action="http://product.trunk/main/addTable/?product='.$_GET['product'].'" method="POST">';
    ?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputReviewer">Ваше имя</label>
                <input type="text" name="reviewer" class="form-control" id="inputReviewer" placeholder="Иван Иванов" required pattern="[a-zA-Zа-яА-ЯЁё\s]+" minlength="2" maxlength="200">
                <small id="reviewerHelp" class="form-text text-muted">Своё имя русскими или английскими буквами (например, Иванов Иван).</small>
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail">E-mail</label>
                <input type="text" name="email" class="form-control" id="inputEmail" placeholder="example@site.com" required pattern=".+@.+\..+" minlength="8" maxlength="200">
                <small id="emailHelp" class="form-text text-muted">Введите адрес своего почтового ящика, проверьте, что там есть @ "собака".</small>
            </div>
        </div>
        <div class="form-group">
            <label for="inputText_review">Текст отзыва</label>
            <textarea class="form-control" name="text_review" id="inputFeedback" rows="4" placeholder="Этот товар не оч." required ></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>