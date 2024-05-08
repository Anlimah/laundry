<?php

namespace Controller;

use Model\CustomerModel;

class CustomerController extends CustomerModel
{
    public function show(array $data)
    {
        $response = $this->getCustomer($data);
        if (!$response) return $this->sendResponse(404, ['message' => 'Customer not found']);
        return $this->sendResponse(200, $response);
    }

    public function create(array $data)
    {
        $response = $this->register($data);
        if (!$response) return $this->sendResponse(404, ['message' => 'Customer not found']);
        return $this->sendResponse(200, $response);
    }

    public function update(array $data)
    {
        $response = $this->register($data);
        if (!$response) return $this->sendResponse(404, ['message' => 'Customer not found']);
        return $this->sendResponse(200, $response);
    }

    public function delete(array $data)
    {
        $response = $this->register($data);
        if (!$response) return $this->sendResponse(404, ['message' => 'Customer not found']);
        return $this->sendResponse(200, $response);
    }

    private function sendResponse($status, $data)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        return json_encode($data);
    }
}
