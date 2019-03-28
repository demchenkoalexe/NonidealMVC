<?php

require_once ('modelDB.php');

class ModelAdmin extends Model {
    private static $pdo;

     public function __construct() {
        $this->pdo = DB::connect();
    }

    /*Функция формироваия запроса к БД.*/
    private function pdoSet($allowed, &$values, $source = array()) {
        $set = '';
        $values = array();
        if ( !$source ) {
            $source = &$_POST;
        }
        foreach ( $allowed as $field ) {
            if ($field == 'image') {
                $set .= "`".str_replace("`", "``", $field)."`"."=:$field, ";
                if ($_FILES['inputFile']['tmp_name']) {
                    $values[$field] = $_FILES['inputFile']['name'];
                } elseif ($_GET['red_id']) {
                    $data = $this->pdo->query("SELECT image FROM products WHERE ID={$_GET['red_id']}")->fetchAll();
                    $values[$field] = $data[0][$field];
                }

            }
            if ( isset($source[$field]) ) {
                $set .= "`".str_replace("`", "``", $field)."`"."=:$field, ";
                $values[$field] = $source[$field];
            }
        }
        return substr($set, 0, -2);
    }

    /*Проверить все ли таблицы существуют.*/
    public function isDataBase() {
        try {
            $sql = 'SELECT 1 FROM products LIMIT 1';
            $sql1 = 'SELECT 1 FROM feedback LIMIT 1';
            $data = $this->pdo->query($sql)->fetchAll();
            $data = $this->pdo->query($sql1)->fetchAll();
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

    /*Добавление новой записи.*/
    public function addData() {
        $allowed = array("name", "price", "image", "description");

        $newFile =  $_SERVER['DOCUMENT_ROOT'].'/application/image/';
        if( !is_dir($newFile) ) {
            mkdir($newFile);
        }

        if ( $_FILES['inputFile']['tmp_name'] ) {
            /*Копируем в image загруженный файл.*/
            if (!copy($_FILES['inputFile']['tmp_name'], $newFile . $_FILES['inputFile']['name'])) {
                echo "Не удалось скопировать файл...\n";
            }
        }

        $sql = "INSERT INTO products SET ".$this->pdoSet($allowed,$values);
        $this->pdo->prepare($sql, $values);
    }

    /*Редактирование имеющейся записи.*/
    public function addEditProducts() {
        $allowed = array("name", "price", "image", "description");

        if ( $_FILES['inputFile']['tmp_name'] ) {
            /*Копируем в image загруженный файл.*/
            if (!copy($_FILES['inputFile']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/application/image/'.$_FILES['inputFile']['name'])) {
                echo "Не удалось скопировать файл...\n";
            }
        }

        $sql = "UPDATE products SET ".$this->pdoSet($allowed,$values)." WHERE ID = {$_GET['red_id']}";
        $this->pdo->prepare($sql, $values);
    }

    /*Удаление записи из таблицы.*/
    public function deleteData($forDel) {
        if ( isset($_GET['del_id']) ) {
            $sql = "DELETE FROM $forDel WHERE ID={$_GET['del_id']}";
            $this->pdo->exec($sql);
        }
    }

    /*Получить данны их таблицы для вывода.*/
    public function getData() {
        $data = $this->pdo->query('SELECT * FROM products')->fetchAll();
        return $data;
    }

    /*Получить данные из таблицы для редактирования.*/
    public function getEditData($forEdit) {
        if ( isset($_GET['red_id']) ) {
            $sql = "SELECT * FROM $forEdit WHERE ID={$_GET['red_id']}";
            $data = $this->pdo->query($sql)->fetchAll();
            return $data;
        }
    }

    //
    // ОТЗЫВЫ
    //

    /*Получить неотмодерированные отзывы.*/
    public function getModerationFeedback() {
        $sql = "SELECT * FROM feedback WHERE moderation=0";
        $data = $this->pdo->query($sql)->fetchAll();
        return $data;
    }

    /*Сохранение отзыва.*/
    public function saveFeedback() {
        $sql = "UPDATE feedback SET moderation = 1 WHERE ID = {$_GET['save_id']}";
        $this->pdo->exec($sql);
    }

    /*Сохранение отмодерированного отзыва.*/
    public function addEditFeedback() {
        $allowed = array("text_review");
        $sql = "UPDATE feedback SET ".$this->pdoSet($allowed,$values).", moderation = 1 WHERE ID = {$_GET['red_id']}";
        $this->pdo->prepare($sql, $values);
    }
}