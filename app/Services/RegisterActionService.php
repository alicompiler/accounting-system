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
            $this->action->prevBalance = $this->customer->balance;

            $newAmount = $this->action->amount;
            if ($this->action->type == Action::ACTION_TYPE_WITHDRAW) {
                $newAmount = -1 * $this->action->amount;
            }
            else if ($this->action->type == Action::ACTION_TYPE_DEPOSIT) {
                $newAmount = $this->action->amount;
            }

            $newBalance = $this->customer->balance + $newAmount;
            $this->action->newBalance = $newBalance;
            $this->action->save();
            $this->customer->balance = $newBalance;
            $this->customer->save();
        });
    }


}