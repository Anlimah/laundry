<?php

namespace Core;

use PDO;
use PDOException;
use Exception;

class Database
{
    private $conn = null;
    private $query;
    private $params;
    private $stmt;

    public function __construct($config, $user, $pass, $dbServer = "mysql")
    {
        $dsn = "{$dbServer}:" . http_build_query($config, "", ";");
        try {
            $this->conn = new PDO(
                $dsn,
                $user,
                $pass,
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function run($query, $params = array()): self
    {
        $this->query = $query;
        $this->params = $params;
        try {
            $this->stmt = $this->conn->prepare($this->query);
            $this->stmt->execute($this->params);
            return $this;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    private function type(): string
    {
        $spacePosition = strpos($this->query, ' ');
        if ($spacePosition !== false) return substr($this->query, 0, $spacePosition);
        return $this->query;
    }

    public function all(): mixed
    {
        if ($this->type() === 'SELECT') return $this->stmt->fetchAll();
    }

    public function one(): mixed
    {
        if ($this->type() === 'SELECT') return $this->stmt->fetch();
    }

    public function add($autoIncrementColumn = null, $primaryKeyValue = null): mixed
    {
        if ($this->type() === 'INSERT') {
            if ($autoIncrementColumn) return $this->conn->lastInsertId($autoIncrementColumn);
            else if ($primaryKeyValue) return $primaryKeyValue;
            else return true;
        }
        return false;
    }

    public function del(): int|bool
    {
        if ($this->type() === 'DELETE') return $this->stmt->rowCount();
        return false;
    }

    public function edit(): int|bool
    {
        if ($this->type() === 'UPDATE') return $this->stmt->rowCount();
        return false;
    }
}
