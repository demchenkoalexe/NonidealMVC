<?php

require_once ('modelDB.php');

class ModelMain extends Model {
    private static $pdo;

    public function __construct()
    {
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
            if ( isset($source[$field]) ) {
                $set .= "`".str_replace("`", "``", $field)."`"."=:$field, ";
                $values[$field] = $source[$field];
            }
            if ( $field == 'id_product' ) {
                $set .= "`".str_replace("`", "``", $field)."`"."=:$field, ";
                $values[$field] = $_GET['product'];
            }
        }
        return substr($set, 0, -2);
    }

    /*Узнать общее количество товаров в таблице.*/
    public function getCountData() {
        $sql = "SELECT COUNT(1) as count FROM products";
        $data = $this->pdo->query($sql)->fetchAll();
        return $data[0]['count'];
    }

    /*Получить данны их таблицы для вывода.*/
    public function getData($page) {
        $sql = 'SELECT * FROM products';

        if ( $_GET['sort'] == 1 ) {
            $sql .= ' ORDER BY price ASC';
        } elseif ( $_GET['sort'] == 2 ) {
            $sql .= ' ORDER BY name ASC';
        } elseif ( $_GET['sort'] == 3 ) {
            $sql = 'SELECT p.id, p.name, p.image, p.price,
                    count(f.id_product) as countFeedback 
                    FROM products AS p
                    LEFT JOIN feedback AS f ON p.id = f.id_product
                    GROUP BY p.id 
                    ORDER BY count(f.id_product) DESC';
        }

        $sql .= ' LIMIT ' . $page * 5 .', '. 5;

        $data = $this->pdo->query($sql)->fetchAll();
        return $data;
    }

    /*Получить информации о товаре для вывода конкретном товаре.*/
    public function getViewProduct() {
        if (isset($_GET['product'])) {
            $sql = "SELECT * FROM products WHERE ID={$_GET['product']}";
            $data = $this->pdo->query($sql)->fetchAll();
            return $data[0];
        }
    }

    /*Получить отзывы о товаре.*/
    public function getFeedbackProduct() {
        $sql = "SELECT * FROM feedback WHERE id_product={$_GET['product']}";
        $data = $this->pdo->query($sql)->fetchAll();
        return $data;
    }

    /*Добавление нового отзыва.*/
    public function addFeedback() {
        $allowed = array("reviewer", "email", "text_review", "id_product");
        $sql = "INSERT INTO feedback SET ".$this->pdoSet($allowed,$values);
        $this->pdo->prepare($sql, $values);
    }

}