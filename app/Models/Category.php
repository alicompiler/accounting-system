<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property bool active
 */
class Category extends Model {

    public $table = "category";
    public $fillable = ["name"];
}
