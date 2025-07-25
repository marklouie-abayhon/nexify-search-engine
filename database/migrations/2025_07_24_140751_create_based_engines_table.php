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
        Schema::create('based_engines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cx')->nullable(); // only used by "All"
            $table->text('description')->nullable();
            $table->string('type')->nullable(); // e.g., 'web', 'images', etc.
            $table->integer('position')->default(0);
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
        Schema::dropIfExists('based_engines');
    }
};
