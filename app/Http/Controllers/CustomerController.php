<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller {

    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository) {
        $this->customerRepository = $customerRepository;
    }

    public function index(Request $request) {
        $query = $request->get("query");
        if (strlen(trim($query)) > 0) {
            $customers = $this->customerRepository->find(trim($query));
        }
        else {
            $customers = $this->customerRepository->allActive();
        }

        return view("customer.index", ["customers" => $customers]);
    }

    public function all() {
        $customers = $this->customerRepository->all();
        return view("customer.index", ["customers" => $customers]);
    }

    public function create() {
        return view("customer.create");
    }

    public function store(Request $request) {
        $customer = new Customer($request->all());
        $this->customerRepository->store($customer);
        return redirect(route("customers"));
    }

    public function edit($id) {
        $customer = Customer::findOrFail($id);
        return view("customer.edit", ["customer" => $customer]);
    }

    public function update(Request $request) {
        $customer = Customer::findOrFail($request->get("id"));
        $customer->fill($request->all());
        $this->customerRepository->edit($customer);
        return redirect(route("customers"));
    }

    public function disablePage($id) {
        $customer = Customer::findOrFail($id);
        return view("customer.disable", ["customer" => $customer]);
    }

    public function activePage($id) {
        $customer = Customer::findOrFail($id);
        return view("customer.active", ["customer" => $customer]);
    }

    public function disable(Request $request) {
        $customer = Customer::findOrFail($request->get("id"));
        $this->customerRepository->changeActive($customer, false);
        return redirect(route("customers"));
    }

    public function active(Request $request) {
        $customer = Customer::findOrFail($request->get("id"));
        $this->customerRepository->changeActive($customer, true);
        return redirect(route("customers"));
    }
}
