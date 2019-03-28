<?php
class ControllerAdmin extends Controller {

    function __construct() {
        $this->model = new ModelAdmin();
        $this->view = new View();
    }

    //
    // СОЗДАНИЕ БАЗЫ
    //

    /*Кнопка создание базы, возврата созданной базы.*/
    function actionIndex() {
        if ( $this->model->isDataBase() ) {
            header("Location:" .  VOTING_TRUNCK . "admin/viewTableQuestions");
        } else {
            $this->view->generate('adminPage/adminNewView.php', 'templateView.php');
        }
    }

    /*Загрузка скрипта базы.
    Создание несуществующих таблиц.
    Вывод таблицы на экран.*/
    function actionCreate() {
        $fileSql = $_SERVER['DOCUMENT_ROOT'].'/application/db/tableDataBaseProduct.sql';
        $this->model->createDataBase($fileSql);
        header("Location:" .  VOTING_TRUNCK . "admin/viewTableQuestions");
    }

    /*Отображение таблицы вопросов.*/
    function actionViewTableQuestions() {
        $data = $this->model->getQuestions();
        $this->view->generate('adminPage/adminView.php', 'templateView.php', $data);
    }

    //
    // РАБОТА С ВОПРОСАМИ
    //

    /*Вывод окна создания вопроса.*/
     function actionCreateQuestion() {
         $this->view->generate('adminPage/adminAddQuestionView.php', 'templateView.php');
     }

    /*Добавление в таблицу после заполнения и нажатия клавишы "Добавить".
   Вывод таблицы на экран.*/
    function actionAddTable() {
        $this->model->addQuestionInDB();
        header("Location:" .  VOTING_TRUNCK . "admin/viewTableQuestions");
    }

    /*Вывод формы для редактирования.*/
    function actionEditQuestion() {
        $data = $this->model->getEditQuestion();
        $this->view->generate('adminPage/adminEditQuestionView.php', 'templateView.php', $data);
    }

    /*Добавление в таблицу после заполнения форму редактирования и нажатия клавишы "Сохранить".
   Вывод таблицы на экран.*/
    function actionEditTable() {
        $this->model->editQuestionInDB();
        header("Location:" .  VOTING_TRUNCK . "admin/viewTableQuestions");
    }

    /*Изменение состояние вопроса.*/
    function actionChangeQuestion() {
        $this->model->changeQuestionInDB();
        header("Location:" .  VOTING_TRUNCK . "admin/viewTableQuestions");
    }

    /*Удаление вопроса.*/
    function actionDeleteQuestion() {
        $this->model->deleteQuestionInDB();
        header("Location:" .  VOTING_TRUNCK . "admin/viewTableQuestions");
    }
}