<?php

namespace App\Repositories;
use App\Models\Customer;
use App\Interfaces\CustomerRepositoryInterface;
class CustomerRepository implements CustomerRepositoryInterface
{ 
    public function getAllCustomers()
    {
        $customer = Customer::orderBy('id','desc')->get();
        return $customer;
    }
    public function getCustomerById($id)
    {
        $customer = Customer::findOrFail($id);
        return $customer;
    }
    public function createCustomer(array $data)
    {
        $customer = new Customer();
        $customer->firstname = $data['firstname'];
        $customer->lastname = $data['lastname'];
        $customer->email = $data['email'];
        $customer->password = $data['password'];
        $customer->phone = $data['phone'];
        $customer->address = $data['address'];
        $customer->city = $data['city'];
        $customer->state = $data['state'];
        $customer->postal_code = $data['postal_code'];
        $customer->country = $data['country'];
        $customer->gender = $data['gender'];
        $customer->save();
        return $customer;
    }
    public function updateCustomer($id, array $data)
    {
        $customer = Customer::findOrFail($id);
        $customer->firstname = $data['firstname'];
        $customer->lastname = $data['lastname'];
        $customer->email = $data['email'];
        if (isset($data['password'])) {
            $customer->password = $data['password'];
        }
        $customer->phone = $data['phone'];
        $customer->address = $data['address'];
        $customer->city = $data['city'];
        $customer->state = $data['state'];
        $customer->postal_code = $data['postal_code'];
        $customer->country = $data['country'];
        $customer->gender = $data['gender'];
        $customer->save();
        return $customer;
    }
    public function deleteCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        if($customer)
        {
            $customer->delete();
        }
        return $customer;
    }
    public function updateCustomerStatus($id, $status)
    {
        $customer = Customer::findOrFail($id);
        $customer->status = $status;
        $customer->save();
        return $customer;
    } 
}