<?php

require_once ('modelDB.php');
require_once ('modelCreateQuery.php');

class ModelMain extends Model {
    private static $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
        $this->createrQuery = new ModelCreateQuery();
    }

    /*Получить вопросы из таблицы с ответами и количеством проголосовавших.*/
    public function getQuestions() {
        $questions = $this->pdo->query('SELECT * FROM questions WHERE status = 1 ORDER BY id ASC')->fetchAll();
        $answers = $this->pdo->query('SELECT * FROM question_answers as qa LEFT JOIN answers as a ON qa.answer_id = a.id ORDER BY question_id ASC')->fetchAll();

        for ( $j = 0;  $j < count($questions); $j ++ ) {
            $questions[$j]['answers'] = array();
            $questions[$j]['answer_votes'] = array();
            $questions[$j]['answer_id'] = array();
            $questions[$j]['votes'] = 0;
            for ( $i = 0; i < count($answers); $i ++ ) { //Ищем в таблице элементов ответов первый ответ на нужный нам вопрос,
                //и все последующие добавляем к вопросу в массив вопросов
                if ($questions[$j]['id'] == $answers[$i]['question_id']) {
                    while ($questions[$j]['id'] == $answers[$i]['question_id']) {
                        array_push($questions[$j]['answers'], $answers[$i]['name']);
                        array_push($questions[$j]['answer_votes'], $answers[$i]['vote_count']);
                        array_push($questions[$j]['answer_id'], $answers[$i]['answer_id']);
                        $questions[$j]['votes'] += $answers[$i]['vote_count'];
                        $i ++;
                    }
                    break;
                }
            }
        }
        return $questions;
    }

    /*Сохранение голосования.*/
    public function voting() {
        $n = array_keys($_POST)[0];
        $voteQuestion = "question[" . $n . "]";
        if (setcookie($voteQuestion, $_POST[$n], time() + 3600 * 24 * 30, '/')) {
            $sql = "UPDATE question_answers SET vote_count = vote_count + 1 WHERE question_id = " . $n . " and answer_id = {$_POST[$n]}";
            $this->pdo->exec($sql);
        } else {
            echo "<h3>Cookie установить не удалось!</h3>";
        }
    }
}