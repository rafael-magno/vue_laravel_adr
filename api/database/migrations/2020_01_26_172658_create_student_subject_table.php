<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubjectTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('student_subject', function (Blueprint $table) {
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('subject_id')->unsigned();
            $table->timestamps();
            $table->primary(['student_id', 'subject_id']);
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('students_subjects');
    }
}
