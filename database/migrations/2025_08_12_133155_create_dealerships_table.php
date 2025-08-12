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
        Schema::create('dealerships', function (Blueprint $table) {

            // Auto-generate ID column
            $table->id();

            // Request columns
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('office_address')->nullable();
            $table->string('work_area')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('weeding_date')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('whats_app')->nullable();
            $table->string('interested_in')->nullable();

            // CreatedAt & UpdatedAt columns
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
        Schema::dropIfExists('dealerships');
    }
};
