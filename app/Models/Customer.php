<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property bool active
 * @property float balance
 */
class Customer extends Model {

    public $table = "customer";
    public $fillable = ["name", "phone", "address", "balance"];
}
