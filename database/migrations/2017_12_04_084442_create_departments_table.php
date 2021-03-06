<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index('idx_user_id_id', ['id', 'user_id']);
            $table->integer('division_id')->unsigned()->index('idx_division_id_id', ['id', 'division_id']);
            $table->integer('assigned_id')->unsigned()->index('idx_assigned_id_id', ['id', 'assigned_id']);
            $table->string('title');
            $table->text('description');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
