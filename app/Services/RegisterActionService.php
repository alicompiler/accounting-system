<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 11/23/19
 * Time: 9:26 PM
 */

namespace App\Services;


use App\Models\Action;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class RegisterActionService {

    private $action;
    private $customer;

    /**
     * RegisterActionService constructor.
     * @param Action $action
     * @param Customer $customer
     */
    public function __construct(Action $action, Customer $customer) {
        $this->action = $action;
        $this->customer = $customer;
    }


    public function register() {
        DB::transaction(function () {
            $this->action->save();
            if ($this->action->type == Action::ACTION_TYPE_WITHDRAW) {
                $this->customer->balance -= $this->action->amount;
            }
            else if ($this->action->type == Action::ACTION_TYPE_DEPOSIT) {
                $this->customer->balance += $this->action->amount;
            }
            $this->customer->save();
        });
    }


}