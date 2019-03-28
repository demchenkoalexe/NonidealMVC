<div>
    <form enctype="multipart/form-data" class="main-things" action="http://product.trunk/admin/addTable" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName">Название товара</label>
                <input type="text" name="name" class="form-control" id="inputName" placeholder="Яблоко" required pattern="[a-zA-Zа-яА-ЯЁё\s]+" minlength="2" maxlength="100">
                <small id="nameHelp" class="form-text text-muted">Название товара русскими или английскими буквами, не менее двух символов (например, Яблоко).</small>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPrice">Цена</label>
                <input type="text" name="price" class="form-control" id="inputPrice" placeholder="100" required pattern="[0-9]+" minlength="1" maxlength="10">
                <small id="priceHelp" class="form-text text-muted">Цена товара только цифрами (например, 100).</small>
            </div>
        </div>

        <div>
            <label for="inputFile">Файл картинки</label>
        </div>
        <div>
            <input type="file" name="inputFile" id="inputFile" required>
        </div>
        <br>
        <div class="form-group">
            <label for="inputDescription">Описание</label>
            <textarea class="form-control" name="description" id="inputDescription" rows="4" placeholder="Сочное, зелёное."></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Добавить</button>
    </form>
</div>