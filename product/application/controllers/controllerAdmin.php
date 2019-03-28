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
            header("Location: http://product.trunk/admin/viewTable");
        } else {
            $this->view->generate('adminPage/adminView.php', 'templateView.php');
        }
    }

    /*Загрузка скрипта базы.
    Создание несуществующих таблиц.
    Вывод таблицы на экран.*/
    function actionCreate() {
        $fileSql = $_SERVER['DOCUMENT_ROOT'].'/application/db/tableDataBaseProduct.sql';
        $this->model->createDataBase($fileSql);
        header("Location: http://product.trunk/admin/viewTable");
    }

    /*Отображение таблицы.*/
    function actionViewTable() {
        $data = $this->model->getData();
        $this->view->generate('adminPage/adminViewDone.php', 'templateView.php', $data);
    }

    //
    // РАБОТА С ТАБЛИЦЕЙ ТОВАРОВ
    //

    /*Добавление в таблицу после заполнения и нажатия клавишы "Добавить".
    Вывод таблицы на экран.*/
    function actionAddTable() {
        $this->model->addData();
        header("Location: http://product.trunk/admin/viewTable");
    }

    /*Вывод окна добавления в таблицу*/
    function actionAddProduct() {
        $this->view->generate('adminPage/adminViewAddProduct.php', 'templateView.php');
    }

    /*Вывод формы для редактирования.*/
    function actionEditProduct() {
        $data = $this->model->getEditData('products');
        $this->view->generate('adminPage/adminViewEditProduct.php', 'templateView.php', $data);
    }

    /*Добавление в таблицу после редактирования и нажатия клавишы "Сохранить изменения".
    Вывод таблицы на экран.*/
    function actionAddEditTable() {
        $this->model->addEditProducts();
        header("Location: http://product.trunk/admin/viewTable");
    }

    /*Удаление записи из таблицы и вывод таблицы на экран.*/
    function actionDeleteProduct() {
        $this->model->deleteData('products');
        header("Location: http://product.trunk/admin/viewTable");
    }

    //
    // ОТЗЫВЫ
    //

    /*Страница неотмодерированных отзывов.*/
    function actionModerationFeedback() {
        $data = $this->model->getModerationFeedback();
        $this->view->generate('adminPage/adminViewModerationFeedback.php', 'templateView.php', $data);
    }

    /*Удаление записи из таблицы и вывод таблицы на экран.*/
    function actionDeleteFeedback() {
        $this->model->deleteData('feedback');
        header("Location: http://product.trunk/admin/moderationFeedback");
    }

    /*Сохранение отзыва.*/
    function actionSaveFeedback() {
        $this->model->saveFeedback();
        header("Location: http://product.trunk/admin/moderationFeedback");
    }

    /*Редактирование отзыва.*/
    function actionEditFeedback() {
        $data = $this->model->getEditData('feedback');
        $this->view->generate('adminPage/adminViewEditFeedback.php', 'templateView.php', $data);
    }

    /*Добавление в таблицу после редактирования и нажатия клавишы "Сохранить изменения".
    Вывод таблицы на экран.*/
    function actionAddEditFeedback() {
        $this->model->addEditFeedback();
        header("Location: http://product.trunk/admin/moderationFeedback");
    }
}