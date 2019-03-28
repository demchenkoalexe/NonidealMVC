<?php

class ControllerMain extends Controller {
    private $pageCount = 0;

    function __construct() {
        $this->model = new ModelMain();
        $this->view = new View();
        $this->pageCount = ceil($this->model->getCountData() / 5);
    }

    /*Главное окно с выводом товаров.*/
    function actionIndex() {
        //Пагинация
        $page = 0;
        if ( isset($_GET['page']) ) {
            $page = $_GET['page'] - 1;
        }
        $data = $this->model->getData($page);
        $array = array($data, $page + 1, $this->pageCount); //Передаём во view параметры данные 5 продуктов,
                                                        // номер страницы и общее количество страниц
        $this->view->generate('mainPage/mainView.php', 'templateView.php', $array);
    }

    /*Окно конкретного продукта с отзывами.*/
    function actionProductView() {
        $data = $this->model->getViewProduct();
        $feedback = $this->model->getFeedbackProduct();
        $data = array($data, $feedback);
        $this->view->generate('mainPage/mainProductView.php', 'templateView.php', $data);
    }

    /*Добавление в таблицу после заполнения и нажатия клавишы "Добавить".
    Вывод продукта с отзывом на экран.*/
    function actionAddTable() {
        $this->model->addFeedback();
        header("Location: http://product.trunk/main/productView/?product=" . $_GET['product']);
    }

    /*Добавление отзыва.*/
    function actionAddFeedback() {
        $this->view->generate('mainPage/mainViewAddFeedback.php', 'templateView.php');
    }
}
