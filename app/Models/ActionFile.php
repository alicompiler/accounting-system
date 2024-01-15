<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Action
 *
 * @property int id
 * @property int action_id
 * @property string filename
 * @property int is_image
 * @mixin \Eloquent
 */
class ActionFile extends Model {

    public $table = "action_file";

    public $fillable = ["action_id", "filename", "is_image"];

    public function action() {
        return $this->hasOne("App\Models\Action", "id", "action_id");
    }
}
