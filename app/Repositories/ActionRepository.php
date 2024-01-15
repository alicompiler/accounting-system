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

    public function reportForCustomer($customerId, $fromDate, $toDate, $categoryId) {
        // SHOULD NOT ORDER BY created_at BECAUSE date is the main field for ordering
        // date is set by user and created_at is set by system
        // the user may set the date of the action to be in the past
        $sql = "SELECT T.*, createdBy.name AS createByName, updatedBy.name AS updatedByName , category.name AS categoryName, (SELECT COUNT(*) FROM action_file WHERE action_id = T.id) AS filesCount FROM (
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
        )T LEFT JOIN category ON T.category_id = category.id 
        LEFT JOIN user AS createdBy ON T.created_by_id = createdBy.id
        LEFT JOIN user AS updatedBy ON T.updated_by_id = updatedBy.id
        WHERE 1 ";

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

        if ($categoryId && $categoryId != 0) {
            $sql = $sql . " AND category_id = ?";
            $params[] = $categoryId;
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