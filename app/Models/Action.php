<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property double amount
 * @property int type
 * @property int id
 */
class Action extends Model {

    public $table = "action";
    public $fillable = ["customer_id", "amount", "type", "details", "category_id", "date"];

    const ACTION_TYPE_WITHDRAW = 1;
    const ACTION_TYPE_DEPOSIT = 2;

    public function customer() {
        return $this->hasOne("App\Models\Customer", "id", "customer_id");
    }

    public function category() {
        return $this->hasOne("App\Models\Category", "id", "category_id");
    }
}
