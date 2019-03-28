<div>
    <button type="button" class="btn btn-primary btn-lg main-things" onclick="addProduct()">Добавить товар</button>
    <button type="button" class="btn btn-primary btn-lg main-things" onclick="moderationFeedback()">Модерация новых отзывов</button>
</div>
<div class="main-things">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Название</th>
            <th scope="col">Файл изображения</th>
            <th scope="col">Цена</th>
            <th scope="col">Описание</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php
            $number = 1; //для красивого вывода
            foreach ($data as $row) {
                echo '<tr>
                            <th scope="row">'.$number.'</th>
                            <td name="name">'.$row['name'].'</td>
                            <td name="image">
                                <img src="'.PATH_IMAGE.$row['image'].'" width="250" height="250" alt="'.$row['name'].'">
                            </td>
                            <td name="price">'.$row['price'].'</td>
                            <td name="description">'.$row['description'].'</td>
                            <td>
                                <button type="button" class="btn btn-warning" onclick="editProduct('.$row['id'].')">Редактировать</button>
                                <button type="button" class="btn btn-danger" onclick="deleteProduct('.$row['id'].')">Удалить</button>
                            </td>';
                $number ++;
            }
            ?>
        </tr>
        </tbody>
    </table>
</div>

<script>
    function addProduct() {
        location.href = "/admin/addProduct";
    }

    function moderationFeedback() {
        location.href = "/admin/moderationFeedback";
    }
    
    function editProduct(red_id) {
        location.href = "/admin/editProduct/?red_id=" + red_id;
    }
    
    function deleteProduct(del_id) {
        var isDelete = confirm("Действительно хотиите удалить?");
        if ( isDelete ) {
            location.href = "/admin/deleteProduct/?del_id=" + del_id;
        }
    }
</script>
