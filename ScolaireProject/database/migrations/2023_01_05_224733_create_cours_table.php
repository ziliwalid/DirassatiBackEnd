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
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->string('nom_cours');
            $table->integer('anne');
            $table->unsignedBigInteger('groupe_id');

            $table->foreign('groupe_id')->references('id')->on('groupes')->onDelete('cascade');
            $table->unsignedBigInteger('module_id');

            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->unsignedBigInteger('enseigant_id');


            $table->foreign('enseigant_id')->references('id')->on('enseigants')->onDelete('cascade');
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
        Schema::dropIfExists('cours');
    }
};
