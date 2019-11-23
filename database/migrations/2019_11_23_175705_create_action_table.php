<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('action', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("customer_id");
            $table->double("amount");
            $table->integer("type");
            $table->text("details");
            $table->integer("category_id");
            $table->date("date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('action');
    }
}
