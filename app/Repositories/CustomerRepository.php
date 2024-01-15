<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 11/23/19
 * Time: 5:57 PM
 */

namespace App\Repositories;


use App\Models\Customer;

class CustomerRepository {

    public function allActive() {
        return Customer::where("active", true)->get();
    }

    public function store(Customer $customer) {
        $customer->active = true;
        $customer->save();
        return $customer;
    }

    public function edit(Customer $customer) {
        return $customer->save();
    }

    public function changeActive(Customer $customer, bool $active) {
        $customer->active = $active;
        return $customer->save();
    }

    public function all() {
        return Customer::orderBy("active", "DESC")->get();
    }

    public function find(string $query) {
        return Customer::where("name", "LIKE", "%$query%")->get();
    }
}