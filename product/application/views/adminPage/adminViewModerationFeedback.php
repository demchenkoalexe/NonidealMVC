<div>
    <button type="button" class="btn btn-primary btn-lg main-things" onclick="viewProducts()">Страница товаров</button>
</div>
<div class="main-things">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Чей отзыв</th>
            <th scope="col">Почта</th>
            <th scope="col">Текст отзыва</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php
            foreach ($data as $row) {
                echo '<tr>
                            <td name="reviewer">'.$row['reviewer'].'</td>
                            <td name="email">'.$row['email'].'</td>
                            <td name="text_review">'.$row['text_review'].'</td>
                            <td>
                                <button type="button" class="btn btn-primary" onclick="saveFeedback('.$row['id'].')">Сохранить</button>
                                <button type="button" class="btn btn-warning" onclick="editFeedback('.$row['id'].')">Редактировать</button>
                                <button type="button" class="btn btn-danger" onclick="deleteFeedback('.$row['id'].')">Удалить</button>
                            </td>';
            }
            ?>
        </tr>
        </tbody>
    </table>
</div>

<script>
    function viewProducts() {
        location.href = "/admin/viewTable";
    }

    function saveFeedback(save_id) {
        var isSave = confirm("Действительно хотиите сохранить?");
        if ( isSave ) {
            location.href = "/admin/saveFeedback/?save_id=" + save_id;
        }
    }

    function editFeedback(red_id) {
        location.href = "/admin/editFeedback/?red_id=" + red_id;
    }

    function deleteFeedback(del_id) {
        var isDelete = confirm("Действительно хотиите удалить?");
        if ( isDelete ) {
            location.href = "/admin/deleteFeedback/?del_id=" + del_id;
        }
    }
</script>