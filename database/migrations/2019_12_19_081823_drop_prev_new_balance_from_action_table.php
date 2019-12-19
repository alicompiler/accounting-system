<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPrevNewBalanceFromActionTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('action', function (Blueprint $table) {
            $table->dropColumn("prevBalance");
            $table->dropColumn("newBalance");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('action', function (Blueprint $table) {
            $table->double("prevBalance");
            $table->double("newBalance");
        });
    }
}
