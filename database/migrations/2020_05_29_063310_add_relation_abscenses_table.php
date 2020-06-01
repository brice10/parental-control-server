<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationAbscensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abscences', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('sequence_id');
            $table->unsignedInteger('nbr_abscence');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            //$table->foreign('sequence_id')->references('id')->on('sequences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abscences');
    }
}
