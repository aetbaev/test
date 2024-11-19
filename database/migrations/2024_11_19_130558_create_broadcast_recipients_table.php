<?php

use App\Models\Broadcast;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('broadcast_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Broadcast::class)->constrained()->onDelete('cascade');
            $table->string('phone');
            $table->string('message_api_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('broadcast_recipients');
    }
};
