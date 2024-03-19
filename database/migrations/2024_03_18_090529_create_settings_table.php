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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('email');
            $table->string('phone');
            $table->tinyInteger('site_status')->default(0);
            $table->longText('closed_message_ar');
            $table->string('logo');
            $table->longText('firebase');
            $table->tinyInteger('mentanceMode')->default(0);
            $table->longText('mentanceMessage');
            $table->string('verision');
            $table->string('andriod');
            $table->string('ios');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
