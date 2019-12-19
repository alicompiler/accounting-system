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

    /**
     * RegisterActionService constructor.
     * @param Action $action
     */
    public function __construct(Action $action) {
        $this->action = $action;
    }


    /**
     * @throws \Throwable
     */
    public function register() {
        DB::transaction(function () {
            $this->action->category_id = -1;
            $this->action->save();
        });
    }


}