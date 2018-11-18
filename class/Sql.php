<?php

class Sql extends PDO{
    private $conn;

    public function __construct(){
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
    }

    //CHAMA A FUNÇÃO PARA FAZER OS BINDS ATRAVES DA QTD DE PARAMETROS
    private function setParams($statement, $parameters = array()){
        foreach($parameters as $key => $value){
            $this->setParam($statement, $key, $value);
        }
    }
    //FAZ OS BINDS DA CONSULTA
    private function setParam($statement, $key, $value){
        $statement->bindParam($key, $value);
    }

    //PREPARO E EXECUTO MINHA QUERY
    public function query($rawQuery, $params = array()){
        $stmt = $this->conn->prepare($rawQuery);    
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    //RECEBO A CONSULTA E RETONORO OS DADOS
    public function select($rawQuery, $params = array()):array
    {
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>