<?php

    define(TO, 'demchenko_alexey@mail.ru');
    $subject = 'Message on index.php';

    $msg = '';
    /*Добавим к сообщению фамилию*/
    if ($_POST['surname']) {
        $msg .= 'From: ' . 'Surname: ' . $_POST['surname'];
    }

    /*Добавим к сообщению имя*/
    if ($_POST['name']) {
        $msg .= (empty($msg) ? '' : "\r\n") . 'Name: ' . $_POST['name'];
    }

    /*Добавим телефон (обязательый)*/
    $msg .= (empty($msg) ? '' : "\r\n") . 'Phone: ' . $_POST['phone-number'];

    /*Добавим к сообщению сообщение*/
    if ($_POST['textarea']) {
        $msg .= (empty($msg) ? '' : "\r\n") . 'Message: ' . $_POST['textarea'];
    }

    $sendMessage = mail(TO, $subject, $msg);

    if ($sendMessage) {
        echo "Сообщение принято к отправке.";
    } else {
        echo "Нет никакого письма!";
    }

?>