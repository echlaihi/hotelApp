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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references("id")->on("users");
            $table->foreignId("partner_id")->nullable(true)->references("id")->on("partners");
            $table->foreignId("room_id")->references("id")->on("rooms");
            $table->string("marriage_contract")->nullable();
            $table->string("status"); // active, ready, disactive, terminate
            $table->date("start_date");
            $table->date("end_date");
            $table->float("invoice");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
