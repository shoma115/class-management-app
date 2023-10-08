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
        Schema::create('credited_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cacadeOnDelete();
            $table->string("class_name");
            $table->string('teacher_name')->nullable(true);
            $table->integer('amount_credit');
            $table->string('division_1')->nullable(true);
            $table->string('division_2')->nullable(true);
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
        Schema::dropIfExists('credited_classes');
    }
};
