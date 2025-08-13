<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id');
            // Foreign key constraint
            $table->foreign('training_id')
              ->references('id')   // Column in parent table
              ->on('training_modules')        // Parent table
              ->onDelete('cascade') // Action when parent is deleted
              ->onUpdate('cascade'); // Action when parent is updated
            $table->string("question")->nullable();
            $table->enum("type",['selection','singleChoice'])->nullable();
            $table->json("options")->nullable();
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
        Schema::dropIfExists('training_lessons');
    }
};
