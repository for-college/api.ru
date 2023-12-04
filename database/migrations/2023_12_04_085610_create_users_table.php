<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('lastname');
            $table->string('name');
            $table->string('patronymic')->nullable();
            $table->boolean('sex');
            $table->date('birth');
            $table->string('login')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->foreignId('role_id')
                ->default(1)
                ->constrained()
                ->onUpdate('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};