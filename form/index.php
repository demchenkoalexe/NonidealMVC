<html>
    <body>
        <form action="send.php" method="POST">
            <div>
                <label for="surname">Фамилия: </label>
                <input type=text id="surname" name="surname"><br>
            </div>

            <div style="margin-top: 10px">
                <label for="name">Имя: </label>
                <input type=text id="name" name="name"><br>
            </div>

            <div style="margin-top: 10px">
                <label for="phone-number">Контактный телефон: </label>
                <input type=text id="phone-number" name="phone-number" required><br>
            </div>

            <div style="margin-top: 10px">
                <label for="textarea">Текст сообщения: </label>
                <textarea id="textarea" name="textarea" cols="40" rows="10"></textarea>
            </div>

            <div style="margin-top: 10px">
                <input type=submit value="Отправить письмецо">
            </div>
        </form>
    </body>
</html>