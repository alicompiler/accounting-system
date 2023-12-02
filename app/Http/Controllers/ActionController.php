<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Category;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use App\Services\EditActionService;
use App\Services\RegisterActionService;
use File;
use Illuminate\Http\Request;

class ActionController extends Controller {

    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository) {
        $this->customerRepository = $customerRepository;
    }

    public function create() {
        $customers = $this->customerRepository->allActive();
        $categories = Category::where('active', true)->get();
        return view("action.create", ["customers" => $customers, "categories" => $categories]);
    }

    public function edit($id) {
        $action = Action::findOrFail($id);
        $customers = $this->customerRepository->allActive();
        $categories = Category::where('active', true)->get();

        return view("action.edit", ["action" => $action, "customers" => $customers, "categories" => $categories]);
    }

    public function store(Request $request) {
        $action = new Action($request->all());
        $files = $request->file("files");
        $service = new RegisterActionService($action);
        $service->register($files);
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

    public function remove($id) {
        $action = Action::findOrFail($id);
        return view("action.delete", ["action" => $action]);
    }

    public function delete(Request $request) {
        $action = Action::findOrFail($request->get("id"));
        $customerId = $action->customer_id;
        $action->delete();
        return redirect(route("report:customer", ["customer_id" => $customerId]));
    }

    public function single($id) {
        $action = Action::findOrFail($id);
        return view("action.single", ["action" => $action]);
    }

    public function displayImage($filename) {
        $path = storage_path('app/uploads/' . $filename);
        if(!File::exists($path)) abort(404);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = response($file, 200)->header("Content-Type", $type);
        return $response;
    }

    public function downloadFile($filename) {
        $path = storage_path('app/uploads/' . $filename);
        if(!File::exists($path)) abort(404);
        return response()->download($path);
    }
}
