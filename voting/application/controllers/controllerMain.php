<?php

class ControllerMain extends Controller {

    function __construct() {
        $this->model = new ModelMain();
        $this->view = new View();
    }

    /*Главное окно с выводом товаров.*/
    function actionIndex() {
        $data = $this->model->getQuestions();
        $this->view->generate('mainPage/mainView.php', 'templateView.php', $data);
    }

    /*Голосование*/
    function actionVoting() {
        $this->model->voting();
        header("Location:" .  VOTING_TRUNCK);
    }
}
