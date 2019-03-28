<?php
echo '<div>
        <form enctype="multipart/form-data" class="main-things" action="'.VOTING_TRUNCK.'admin/addTable" method="POST">
            <div class="form-group">
                <label for="inputName">Формулировка вопроса</label>
                <input type="text" name="name" class="form-control" id="inputName" placeholder="За кого голосуете на выборах Акшукырского сельсовета?" required pattern="[a-zA-Zа-яА-ЯЁё[?,.!<>\/\\\']\s]+" minlength="5" maxlength="1000">       
                <small id="nameHelp" class="form-text text-muted">Вопрос русскими или английскими буквами, не менее пяти символов.</small>
            </div>
    
            <div class="form-group">
                <label for="inputAnswer">Варианты ответов</label>
                <textarea class="form-control" name="answer" id="inputAnswer" rows="4" placeholder="Каждый вариант ответа на новой строке." required></textarea>
                <small id="nameHelp" class="form-text text-muted">Каждый вариант ответа на новой строке.</small>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Добавить</button>
        </form>
    </div>';