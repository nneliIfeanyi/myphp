<?php
include('config.php');

class Database{

    //connection properties
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $database = DB_NAME;



    //database connection handler

    private $dbh;

    //error handler
    private $error;

    //statement handler

    private $stmt;

    //open connection
    public function __construct()
    {
        $dsn = "mysql:host=".$this->host.";dbname=".$this->database;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //try to establish the connection to the database

        try{
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        }catch (PDOException $err){
            $this->error = $err->getMessage();
        }
    }

    //query helper
    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    //creating the bind helper
    public function bind($param, $value, $type=null){
        if(is_null($type)){
             switch (true){
                 case is_int($value):
                     $type = PDO::PARAM_INT;
                     break;
                 case is_bool($value):
                     $type = PDO::PARAM_BOOL;
                     break;
                 case is_null($value):
                     $type = PDO::PARAM_NULL;
                     break;
                 default:
                     $type = PDO::PARAM_STMT;

             }
        }

        $this->stmt->bindValue($param, $value, $type);
   }




   //helper function for execute
    public function execute(){
        return $this->stmt->execute();
    }

    //fetch multiplied rows from the database

    public function fetchMultiple(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //helper function for fetch single data

    public function fetchSingle(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function fetchColumn(){
        $this->execute();
        return $this->stmt->fetchColumn();
    }

    public function rowCount(){
        $this->execute();
        return $this->stmt->rowCount();
    }

    public function lastInserted(){
        $this->execute();
        return $this->stmt->lastInsertId();
    }

}