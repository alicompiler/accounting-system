<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Action
 *
 * @property double amount
 * @property int type
 * @property int id
 * @property float prevBalance
 * @property float newBalance
 * @property int $id
 * @property int $customer_id
 * @property float $amount
 * @property int $type
 * @property string $details
 * @property int $category_id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float $prevAmount
 * @property float $newAmount
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Customer $customer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereNewAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action wherePrevAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereUpdatedAt($value)
 * @mixin \Eloquent
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
