<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Repositories\ActionRepository;
use Illuminate\Http\Request;

class ReportController extends Controller {

    /**
     * @var ActionRepository
     */
    private $actionRepository;

    public function __construct(ActionRepository $actionRepository) {
        $this->actionRepository = $actionRepository;
    }

    public function customerReport(Request $request) {
        $result = null;
        $customerId = $request->get('customer_id');
        if ($customerId) {
            $fromDate = $request->query("fromDate");
            $toDate = $request->query("toDate");
            $result = $this->actionRepository->reportForCustomer($customerId, $fromDate, $toDate);
        }
        $customers = Customer::all();
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
}
