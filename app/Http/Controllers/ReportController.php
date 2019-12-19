<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Customer;
use App\Repositories\ActionRepository;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class ReportController extends Controller {

    /**
     * @var ActionRepository
     */
    private $actionRepository;
    private $customerRepository;


    public function __construct(ActionRepository $actionRepository, CustomerRepository $customerRepository) {
        $this->actionRepository = $actionRepository;
        $this->customerRepository = $customerRepository;
    }

    public function customerReport(Request $request) {
        $result = null;
        $customerId = $request->get('customer_id');
        if ($customerId) {
            $fromDate = $request->query("fromDate");
            $toDate = $request->query("toDate");
            $result = $this->actionRepository->reportForCustomer($customerId, $fromDate, $toDate);
        }
        $customers = $this->customerRepository->allActive();
        return view("report.customer", ["customers" => $customers, "result" => $result]);
    }

    public function actionReport(Request $request) {
        $result = $this->actionRepository->reportForActions($request->get("fromDate"), $request->get("toDate"));
        return view("report.action", ["result" => $result]);
    }

    public function allCustomersReport() {
        $result = Customer::where("active", 1)->get();
        return view("report.all_customers", ["result" => $result]);
    }

    public function printActionsReport(Request $request) {
        $result = $this->actionRepository->reportForActions($request->get("fromDate"),
            $request->get("toDate"));
        return view("prints.action_report", ["result" => $result]);

    }

    public function printCustomersReport(Request $request) {
        $result = $this->actionRepository->reportForCustomer($request->get("customer_id"), $request->get("fromDate"),
            $request->get("toDate"));
        $customer = Customer::findOrFail($request->get("customer_id"));
        return view("prints.customer_report", ["result" => $result, "customer" => $customer]);
    }

    public function printSingleActionReport($id) {
        $action = Action::findOrFail($id);
        return view("prints.single_action_report", ["action" => $action]);
    }
}
