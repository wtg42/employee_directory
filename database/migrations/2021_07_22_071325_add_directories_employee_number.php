<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDirectoriesEmployeeNumber extends Migration
{
    /**
     * Run the migrations.
     * employee_number 員工編號
     *
     * @return void
     */
    public function up()
    {
        Schema::table('directories', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_number', false)->after('id')->unique()->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('directories', function (Blueprint $table) {
            $table->dropColumn('employee_number');
        });
    }
}
