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
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->integer('cost')->nullable();
            $table->string('address')->nullable();
            $table->integer('rate')->default(0);
            $table->text('description')->nullable();
            $table->foreignId('user_id')->unique()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ;
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
        Schema::dropIfExists('experts');
    }
};
