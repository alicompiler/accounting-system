<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Customer
 *
 * @property bool active
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Customer extends Model {

    public $table = "customer";
    public $fillable = ["name", "phone", "address"];

    public function balance() {
        $sql = "SELECT CASE WHEN  action.type = ? THEN 
                              @total := @total + action.amount 
                          WHEN action.type = ? THEN 
                              @total := @total - action.amount
                          ELSE 
                              @total 
                      END AS balance
                FROM action , (SELECT @total := 0) T
                WHERE customer_id = ? ORDER BY date";
        $params = [Action::ACTION_TYPE_DEPOSIT, Action::ACTION_TYPE_WITHDRAW, $this->id];
        $result = \DB::select($sql, $params);
        if ($result && count($result) > 0) {
            return $result[count($result) - 1]->balance;
        }
        return 0;
    }
}
