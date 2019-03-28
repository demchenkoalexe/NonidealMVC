<?php

require_once ('modelDB.php');
require_once ('modelCreateQuery.php');

class ModelAdmin extends Model {
    private static $pdo;

     public function __construct() {
        $this->pdo = DB::connect();
        $this->createrQuery = new ModelCreateQuery();
    }

    private function createArrayAnswersAndAddDb($idQuestion) {
        $arrayAnswers = array();
        $newAnswer = '';
        for ( $i = 0; $i <= strlen($_POST['answer']); $i ++ ) {
            if ( $_POST['answer'][$i] == "\n" ) {
                if ( !empty($newAnswer) ) {
                    array_push($arrayAnswers, $newAnswer);
                }
                $newAnswer = '';
            } else {
                $newAnswer .= $_POST['answer'][$i];
            }
        }
        if ( !empty($newAnswer) ) {
            array_push($arrayAnswers, $newAnswer);
        }

        $idAnswers = array(); //Массив id для ответов
        foreach ( $arrayAnswers as $answer ) {
            /*Добавление ответа.*/
            $allowed = array("name");
            $_POST['name'] = $answer;
            $sql = "INSERT INTO answers SET ".$this->createrQuery->pdoSet($allowed, $values);
            $this->pdo->prepare($sql, $values);
            $sql = "SELECT LAST_INSERT_ID() as id";
            $id = $this->pdo->query($sql)->fetchAll()[0]['id'];
            array_push($idAnswers, $id);
        }

        foreach ( $idAnswers as $id ) {
            $allowed = array("answer_id", "question_id");
            $_POST['answer_id'] = $id;
            $_POST['question_id'] = $idQuestion;
            $sql = "INSERT INTO question_answers SET ".$this->createrQuery->pdoSet($allowed, $values);
            $this->pdo->prepare($sql, $values); //Добавление вопроса в таблицу
        }
    }

    private function deleteAnswers($idQuestions) {
        $sql = "SELECT answer_id FROM question_answers WHERE question_id = $idQuestions";
        $data = $this->pdo->query($sql)->fetchAll();

        foreach ($data as $id) {
            $sql = "DELETE FROM question_answers WHERE answer_id = " . $id['answer_id'];
            $this->pdo->exec($sql);

            $sql = "DELETE FROM answers WHERE id = " . $id['answer_id'];
            $this->pdo->exec($sql);
        }
    }

    /*Проверить все ли таблицы существуют.*/
    public function isDataBase() {
        try {
            $sql = 'SELECT 1 FROM questions LIMIT 1';
            $sql1 = 'SELECT 1 FROM answers LIMIT 1';
            $data = $this->pdo->query($sql)->fetchAll();
            $data1 = $this->pdo->query($sql1)->fetchAll();
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /*Создание недостающих таблиц в БД.*/
    public function createDataBase($fileSql) {
        if ( !file_exists($fileSql) ) {
            return false;
        }

        $sql = file_get_contents($fileSql);
        $this->pdo->exec($sql);
    }

    /*Добавление нового вопроса.*/
    public function addQuestionInDB() {
        $allowed = array("name");
        $sql = "INSERT INTO questions SET ".$this->createrQuery->pdoSet($allowed, $values);
        $this->pdo->prepare($sql, $values); //Добавление вопроса в таблицу

        //Получиить id вопроса, чтобы добавить к нему варианты ответов
        $sql = "SELECT LAST_INSERT_ID() as id";
        $idQuestion = $this->pdo->query($sql)->fetchAll()[0]['id'];

        $this->createArrayAnswersAndAddDb($idQuestion); //Создадим массив ответов для вопроса и добавим ответы в соответсвующую таблицу.
    }

    /*Редактирование вопроса.*/
    public function editQuestionInDB() {
        if ( isset($_GET['red_id']) ) {
            $allowed = array("name");
            $sql = "UPDATE questions SET " . $this->createrQuery->pdoSet($allowed, $values) . " WHERE ID = {$_GET['red_id']}";
            $this->pdo->prepare($sql, $values);

            //Обновим предыдущие ответы
            $this->deleteAnswers($_GET['red_id']);

            $this->createArrayAnswersAndAddDb($_GET['red_id']);
        }
    }

    /*Измениить состояние вопроса.*/
    public function changeQuestionInDB() {
        if ( isset($_GET['change_id']) ) {
            $sql = "UPDATE questions SET status = {$_GET['change']} WHERE ID = {$_GET['change_id']}";
            $this->pdo->exec($sql);
        }
    }

    /*Удаление вопроса.*/
    public function deleteQuestionInDB() {
        if ( isset($_GET['del_id']) ) {
            //Удалим ответы
            $this->deleteAnswers($_GET['del_id']);

            $sql = "DELETE FROM questions WHERE id = {$_GET['del_id']}";
            $this->pdo->exec($sql);
        }
    }

    /*Получить вопросы из таблицы с ответами и количеством проголосовавших.*/
    public function getQuestions() {
        $questions = $this->pdo->query('SELECT * FROM questions ORDER BY id ASC')->fetchAll();
        $answers = $this->pdo->query('SELECT * FROM question_answers as qa LEFT JOIN answers as a ON qa.answer_id = a.id ORDER BY question_id ASC')->fetchAll();

        for ( $j = 0;  $j < count($questions); $j ++ ) {
            $questions[$j]['answers'] = array();
            $questions[$j]['votes'] = 0;
            for ( $i = 0; i < count($answers); $i ++ ) { //Ищем в таблице элементов ответов первый ответ на нужный нам вопрос,
                                                                    //и все последующие добавляем к вопросу в массив вопросов
                if ($questions[$j]['id'] == $answers[$i]['question_id']) {
                    while ($questions[$j]['id'] == $answers[$i]['question_id']) {
                        array_push($questions[$j]['answers'], $answers[$i]['name']);
                        $questions[$j]['votes'] += $answers[$i]['vote_count'];
                        $i ++;
                    }
                    break;
                }
            }
        }
        return $questions;
    }

    /*Получить данные из таблицы для редактирования.*/
    public function getEditQuestion() {
        if ( isset($_GET['red_id']) ) {
            $sql = "SELECT * FROM questions WHERE ID={$_GET['red_id']}";
            $data = $this->pdo->query($sql)->fetchAll();

            $answers = $this->pdo->query('SELECT * FROM question_answers as qa LEFT JOIN answers as a ON qa.answer_id = a.id AND qa.question_id = ' . $data[0]['id'])->fetchAll();
            $data[0]['answers'] = array();
            foreach ( $answers as $row ) {
                array_push($data[0]['answers'], $row['name']);
            }

            return $data[0];
        }
    }
}