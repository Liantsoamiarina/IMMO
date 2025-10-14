<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['free', 'silver', 'gold']);
            $table->enum('status', ['active', 'inactive', 'expired'])->default('inactive');
            $table->decimal('price', 10, 2); // Augmenté pour supporter 79000 Ar
            $table->timestamp('starts_at')->nullable(); // ← Ajout de nullable()
            $table->timestamp('expires_at')->nullable(); // ← Ajout de nullable()
            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};
