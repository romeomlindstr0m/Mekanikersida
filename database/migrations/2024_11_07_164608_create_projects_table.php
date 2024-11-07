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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name', length: 255);
            $table->string('car_model', length: 255);
            $table->string('car_make', length: 255);
            $table->integer('car_year');
            $table->string('license_plate', length: 255);
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('project_status_id')->constrained();
            $table->text('issue_description');
            $table->text('work_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
