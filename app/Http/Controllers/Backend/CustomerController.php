<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\CustomerRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function list()
    {
        return $this->customerRepository->getAllCustomers();
    }

    public function index()
    {
        $customers = $this->customerRepository->getAllCustomers();
        return view('backend.customers.customer', compact('customers'));
    }

    public function create()
    {
        return view('backend.customers.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|string|min:8',
            'phone' => 'required|numeric|unique:users|digits:11',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'gender' => 'nullable|in:male,female,other',
        ]);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $this->customerRepository->createCustomer($data);
        return redirect()->route('customers.index')->with('success', 'Customer Created Successfully!');
    }

    public function show($id)
    {
        $customer = $this->customerRepository->getCustomerById($id);
        return view('backend.customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = $this->customerRepository->getCustomerById($id);
        return view('backend.customers.edit',compact('customer'));
    }
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:users,phone,' . $id . '|digits:11',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'gender' => 'nullable|in:male,female,other',
        ]);
        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $this->customerRepository->updateCustomer($id, $data);
        return redirect()->route('customers.index')->with('success', 'Customer Updated Successfully!');
    }

    public function destroy($id)
    {
        $customer = $this->customerRepository->deleteCustomer($id);
        if(!$customer)
        {
            return redirect()->route('customers.index')->with('error','Customer not found.');
        }
        return redirect()->route('customers.index')->with('success','Customer deleted successfully.'); 
    }
    public function updateStatus($id, $status)
    {
        $customer = $this->customerRepository->updateCustomerStatus($id, $status);
        return redirect()->route('customers.index')->with('success', $status == 1 ? 'Customer activated successfully.' : 'Customer deactivated successfully.');
    }
}
