<?php

namespace Model;

use Core\Database;

class CustomerModel extends Database
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getCustomer(array $data)
    {
        $query = "SELECT * FROM customers WHERE customer_id=:c";
        return $this->run($query, [":c" => $data["id"]])->one();
    }

    public function register(array $data)
    {
        $query = "INSERT INTO customers (name, email, phone_number, address, password, gender, photo_url) 
                VALUES (:nm, :em, :pn, :ad, :pw, :gd, :pu)";
        $params = [
            ":nm" => $data["name"],
            ":nm" => $data["email"],
            ":nm" => $data["phone_number"],
            ":nm" => $data["address"],
            ":nm" => password_hash($data['password'], PASSWORD_BCRYPT),
            ":nm" => $data["gender"],
            ":nm" => $data["photo_url"]
        ];
        return $this->run($query, $params)->add(true);
    }

    public function login(array $data)
    {
        // Implement your logic to verify customer credentials
        // Return true on success, false on failure
    }

    public function FunctionName()
    {
    }

    public function setNotification(array $data)
    {
        // Implement your logic to verify customer credentials
        // Return true on success, false on failure
    }
}
