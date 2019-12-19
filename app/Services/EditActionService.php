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
            $this->action->customer_id = $prevAction->customer_id;
            $this->action->id = $prevAction->id;
            $this->action->exists = true;
            $this->action->save();
        });
    }

}