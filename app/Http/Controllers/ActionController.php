<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Category;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use App\Services\EditActionService;
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

    public function edit($id) {
        $action = Action::findOrFail($id);
        $customers = $this->customerRepository->allActive();
        $categories = Category::all();

        return view("action.edit", ["action" => $action, "categories" => $categories, "customers" => $customers]);
    }

    public function store(Request $request) {
        $action = new Action($request->all());
        $customer = Customer::findOrFail($request->get("customer_id"));
        $service = new RegisterActionService($action, $customer);
        $service->register();
        return redirect(route("actions:single", ["id" => $action->id]));
    }


    public function update(Request $request) {
        $action = new Action($request->all());
        $prevActionId = $request->get("id");
        $service = new EditActionService($action, $prevActionId);
        try {
            $service->update();
            return redirect(route("actions:single", ["id" => $action->id]));
        }
        catch (\Throwable $e) {
            dd($e);
            return redirect()->back()->withErrors(["حدث خلل خلال عملية التعديل ، يرجى اعادة المحاولة"]);
        }
    }

    public function single($id) {
        $action = Action::findOrFail($id);
        return view("action.single", ["action" => $action]);
    }
}
