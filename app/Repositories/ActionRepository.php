<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 11/23/19
 * Time: 9:25 PM
 */

namespace App\Repositories;


use App\Models\Action;
use Illuminate\Support\Facades\DB;

class ActionRepository {

    public function reportForCustomer($customerId, $fromDate, $toDate) {
        $sql = "SELECT * FROM (
                        SELECT action.* ,
                                              CASE WHEN  action.type = ? THEN 
                                                      @total := @total + action.amount 
                                                  WHEN action.type = ? THEN 
                                                      @total := @total - action.amount
                                                  ELSE 
                                                      @total 
                                              END AS total,
                                              CASE WHEN  action.type = ? THEN @totalDeposit := @totalDeposit + action.amount ELSE @totalDeposit END AS totalDeposit,
                                              CASE WHEN  action.type = ? THEN @totalWithdraw := @totalWithdraw + action.amount ELSE @totalWithdraw END AS totalWithdraw
                                        FROM action , (SELECT @total := 0 , @totalDeposit :=0 , @totalWithdraw := 0) T
                                        WHERE customer_id = ?
                                        ORDER BY date
        )T WHERE 1 ";

        $params = [Action::ACTION_TYPE_DEPOSIT, Action::ACTION_TYPE_WITHDRAW, Action::ACTION_TYPE_DEPOSIT, Action::ACTION_TYPE_WITHDRAW,
            $customerId];
        if ($fromDate) {
            $sql = $sql . " AND date >= ?";
            $params[] = $fromDate;
        }
        if ($toDate) {
            $sql = $sql . " AND date <= ?";
            $params[] = $toDate;
        }

        $sql = $sql . " ORDER BY date";
        return DB::select($sql, $params);
    }

    public function reportForActions($fromDate, $toDate) {
        $sql = "SELECT action.* , customer.name AS customerName ,
                      CASE WHEN  action.type = ? THEN @totalDeposit := @totalDeposit + action.amount ELSE @totalDeposit END AS totalDeposit,
                      CASE WHEN  action.type = ? THEN @totalWithdraw := @totalWithdraw + action.amount ELSE @totalWithdraw END AS totalWithdraw
                FROM action JOIN customer ON customer.id = customer_id CROSS JOIN (SELECT @totalWithdraw := 0 , @totalDeposit := 0)T";

        $conditions = ($fromDate ? 1 : 0) + ($toDate ? 1 : 0);
        $params = [Action::ACTION_TYPE_DEPOSIT, Action::ACTION_TYPE_WITHDRAW];
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