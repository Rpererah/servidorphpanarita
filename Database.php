<?php

class Database {
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;

    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Verifica se ocorreu algum erro na conexão
        if ($this->conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $this->conn->connect_error);
        }

    }

    public function query($sql) {
        // Executa a consulta SQL
        $result = $this->conn->query($sql);

        // Verifica se ocorreu algum erro na consulta
        if (!$result) {
            die("Erro na consulta: " . $this->conn->error);
        }

        return $result;
    }

    public function close() {
        // Fecha a conexão com o banco de dados
        $this->conn->close();
    }
    public function getLastInsertedId() {
        return $this->conn->insert_id;
    }
    public function getError() {
        return $this->conn->error;
    }
    
    
}
