<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Client intéressé
            $table->foreignId('agency_id')->constrained('users')->onDelete('cascade'); // Agence propriétaire
            $table->string('type'); // 'location' ou 'achat'
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->text('message')->nullable();
            $table->enum('status', ['nouveau', 'contacte', 'en_cours', 'converti', 'perdu'])->default('nouveau');
            $table->timestamp('contacted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leads');
    }
};
