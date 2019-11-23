<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Category;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use App\Services\RegisterActionService;
use Illuminate\Http\Request;

class ActionController extends Controller {

    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository) {
        $this->customerRepository = $customerRepository;
    }

    public function create() {
        $customers = $this->customerRepository->allActive();
        $categories = Category::all();
        return view("action.create", ["categories" => $categories, "customers" => $customers]);
    }

    public function store(Request $request) {
        $action = new Action($request->all());
        $customer = Customer::findOrFail($request->get("customer_id"));
        $service = new RegisterActionService($action, $customer);
        $service->register();
        //TODO : redirect to customer action report
        return redirect(route("customers"));
    }
}
