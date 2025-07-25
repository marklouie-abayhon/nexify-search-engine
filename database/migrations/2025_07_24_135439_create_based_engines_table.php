<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('based_engines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cx');
            $table->boolean('image')->default(false);
            $table->boolean('video')->default(false);
            $table->boolean('subtitle')->default(false);
            $table->boolean('news')->default(false);
            $table->integer('position')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('based_engines');
    }
};