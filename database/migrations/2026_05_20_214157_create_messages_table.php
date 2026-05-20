<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            // Coloanele adăugate pentru formularul de contact
            $table->string('nume');
            $table->string('email');
            $table->string('subiect')->nullable(); // Nullable în caz că vizitatorul nu vrea să treacă un subiect
            $table->text('continut'); // Text lung pentru mesajul propriu-zis
            $table->boolean('citit')->default(false); // Flag util pentru admin (să știi ce ai citit)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};