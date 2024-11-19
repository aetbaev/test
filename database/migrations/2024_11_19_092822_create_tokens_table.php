<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cabinet_user_id');
            $table->string('access_token');
            $table->timestamp('access_token_end_time');
            $table->string('refresh_token');
            $table->timestamp('refresh_token_end_time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tokens');
    }
};
