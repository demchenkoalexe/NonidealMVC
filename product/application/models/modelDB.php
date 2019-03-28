<?php
class DB {
    protected static $db;
    private $host = '192.168.0.1';
    private $name = 'tdb_tr_demchenko';
    private $user = 'dbu_tr_demchenko';
    private $pass = 'f98b24a1';
    private $charset = 'utf8';
    private $pdoConnection = null;

    private function __construct() {
        $dsn = "mysql:host=".$this->host.";dbname=".$this->name.";charset=".$this->charset;
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->pdoConnection = new PDO($dsn, $this->user, $this->pass, $opt);
    }

    public static function connect() {
        if (self::$db === NULL) {
            self::$db = new self();
        }

        return self::$db;
    }

    private function __clone() { //запрещаем клонирование объекта модификатором private
    }

    private function __wakeup() { //запрещаем клонирование объекта модификатором private
    }

    /*Функции для обращения к БД*/
    public function query($sql) {
        return $this->pdoConnection->query($sql);
    }

    public function exec($sql) {
        $this->pdoConnection->exec($sql);
    }

    public function prepare($sql, $values) {
        $query = $this->pdoConnection->prepare($sql);
        $query->execute($values);
    }
}