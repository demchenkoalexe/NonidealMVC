<div>
    <button type="button" class="btn btn-primary btn-lg main-things" onclick="addQuestion()">Добавить вопрос</button>
</div>
<div class="main-things">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Формулировка вопроса</th>
            <th scope="col">Ответы</th>
            <th scope="col">Количество проголосовавших</th>
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
                            <td name="answers">';
                foreach ( $row['answers'] as $answer ) {
                    echo $answer.'<br>';
                }
                echo       '</td>
                            <td name="votes">'.$row['votes'].'</td>';

                if ( $row['status'] == '1' ) {
                    echo '<td>
                            <button type="button" class="btn btn-warning" onclick="editQuestion(' . $row['id'] . ')">Редактировать</button>
                            <button type="button" class="btn btn-danger" onclick="changeQuestion(' . $row['id'] . ', 0)">Закончить голосование по этому вопросу</button>
                        </td>';
                } else {
                    echo '<td>
                            <button type="button" class="btn btn-light" disabled>Голосование по этому опросу закончилось</button>
                            <button type="button" class="btn btn-dark" onclick="deleteQuestion(' . $row['id'] . ')">Удалить его совсем</button>
                            <button type="button" class="btn btn-success" onclick="changeQuestion(' . $row['id'] . ', 1)">Вернуть</button>
                          </td>';
                }
                $number ++;
            }
            ?>
        </tr>
        </tbody>
    </table>
</div>

<script>
    function addQuestion() {
        location.href = "/admin/createQuestion";
    }

    function editQuestion(red_id) {
        location.href = "/admin/editQuestion/?red_id=" + red_id;
    }

    function changeQuestion(change_id, change) {
        location.href = "/admin/changeQuestion/?change_id=" + change_id + "&change=" + change;
    }

    function deleteQuestion(del_id) {
        var isDelete = confirm("Действительно хотите удалить?");
        if ( isDelete ) {
            location.href = "/admin/deleteQuestion/?del_id=" + del_id;
        }
    }
</script>