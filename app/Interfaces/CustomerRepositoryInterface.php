<?php

namespace App\Interfaces;

interface CustomerRepositoryInterface
{
    public function getAllCustomers();
    public function getCustomerById($id);
    public function createCustomer(array $data);
    public function updateCustomer($id, array $data);
    public function deleteCustomer($id);
    public function updateCustomerStatus($id, $status);
} 