<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 11/23/19
 * Time: 9:25 PM
 */

namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class ActionRepository {

    public function reportForCustomer($customerId, $fromDate, $toDate) {
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

        $sql = $sql . " ORDER BY action.date";
        return DB::select($sql, $params);
    }

    public function reportForActions($fromDate, $toDate) {
        $sql = "SELECT action.* , category.name AS categoryName , customer.name AS customerName 
                FROM action JOIN category ON category_id = category.id JOIN customer ON customer.id = customer_id";

        $conditions = ($fromDate ? 1 : 0) + ($toDate ? 1 : 0);
        $params = [];
        if ($conditions > 0) {
            $sql = $sql . " WHERE";
        }
        if ($fromDate) {
            $sql = $sql . " date >= ? " . ($conditions == 2 ? " AND " : "");
            $params[] = $fromDate;
        }
        if ($toDate) {
            $sql = $sql . " date <= ? ";
            $params[] = $toDate;
        }

        $sql = $sql . " ORDER BY action.date LIMIT 1000";

        return DB::select($sql, $params);
    }
}