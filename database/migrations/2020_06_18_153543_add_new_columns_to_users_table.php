<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->after('email')->constrained('roles', 'id');
            $table->string('last_name')->after('name');
            $table->string('company')->nullable()->after('last_name');
            $table->string('tel')->after('password');
            $table->string('tel2')->after('tel');
            $table->string('state')->after('tel2');
            $table->string('city')->after('state');
            $table->boolean('isActive')->default(1)->after('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
