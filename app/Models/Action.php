<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property double amount
 * @property int type
 */
class Action extends Model {

    public $table = "action";
    public $fillable = ["customer_id", "amount", "type", "details", "category_id", "date"];

    const ACTION_TYPE_WITHDRAW = 1;
    const ACTION_TYPE_DEPOSIT = 2;
}
