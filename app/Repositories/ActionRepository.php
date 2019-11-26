<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 11/23/19
 * Time: 9:25 PM
 */

namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class ActionRepository
{
    public function reportForCustomer($customerId, $fromDate, $toDate)
    {
        $sql = "SELECT action.* , category.name AS categoryName 
                FROM action JOIN category ON category_id = category.id 
                WHERE customer_id = ? ";
        $params = [$customerId];
        if ($fromDate) {
            $sql = $sql . " AND date >= ?";
            $params[] = $fromDate;
        }
        if ($toDate) {
            $sql = $sql . " AND date <= ?";
            $params[] = $toDate;
        }
        return DB::select($sql, $params);
    }
}