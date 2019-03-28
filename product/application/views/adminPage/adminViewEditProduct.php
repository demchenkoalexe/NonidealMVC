<div>
    <?php
    echo '<form enctype="multipart/form-data" class="main-things" action="http://product.trunk/admin/addEditTable/?red_id='.$data[0]['id'].'" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputName">Название товара</label>
                    <input type="text" name="name" class="form-control" id="inputName" value="'.$data[0]['name'].'" required pattern="[a-zA-Zа-яА-ЯЁё]+" minlength="2" maxlength="100">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPrice">Цена</label>
                    <input type="text" name="price" class="form-control" id="inputPrice" value="'.$data[0]['price'].'" required pattern="[0-9]+" minlength="1" maxlength="10">
                </div>
            </div>
            
            <div>
                <label for="inputFile">Файл картинки</label>
            </div>
            <div>
                <input type="file" name="inputFile" id="inputFile"">
            </div>
            <br>
            
            <div class="form-group">
                <label for="inputDescription">Описание</label>
                <textarea class="form-control" name="description" id="inputDescription" rows="4">'.$data[0]['description'].'</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>';
    ?>
</div>
