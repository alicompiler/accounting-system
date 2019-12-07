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
use DB;

class EditActionService {

    private $action;
    private $prevActionId;

    /**
     * RegisterActionService constructor.
     * @param Action $action
     * @param $prevActionId
     */
    public function __construct(Action $action, $prevActionId) {
        $this->action = $action;
        $this->prevActionId = $prevActionId;
    }

    /**
     * @throws \Throwable
     */
    public function update() {
        DB::transaction(function () {

            $prevAction = Action::findOrFail($this->prevActionId);
            $customer = Customer::findOrFail($prevAction->customer_id);

            $this->action->prevBalance = $prevAction->prevBalance;
            $this->action->customer_id = $customer->id;

            $deductionAmount = $this->getAmountSign($prevAction->type, $prevAction->amount);
            $newBalance = $customer->balance - $deductionAmount;
            $additionAmount = $this->getAmountSign($this->action->type, $this->action->amount);
            $newBalance = $newBalance + $additionAmount;

            $this->action->newBalance = $newBalance;
            $this->action->save();
            $customer->balance = $newBalance;
            $customer->save();
        });
    }

    public function getAmountSign($type, $amount) {
        if ($type == Action::ACTION_TYPE_WITHDRAW) {
            return -1 * $amount;
        }
        else if ($type == Action::ACTION_TYPE_DEPOSIT) {
            return $amount;
        }
        return $amount;
    }

}