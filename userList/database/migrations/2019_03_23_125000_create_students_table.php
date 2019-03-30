<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade')->unique()->unsigned();
            $table->string('name');
            $table->integer('age');
            $table->integer('gender');
            $table->integer('order_p')->default(0);;
            $table->timestamps();

        });

        Schema::table('students', function (Blueprint $table) {
            $table->softDeletes();
        });      
          
        // Schema::table('students', function($table) {
        //     $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
