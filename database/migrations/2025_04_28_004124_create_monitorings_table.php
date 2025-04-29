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
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_id'); // platform_id tanpa foreign key constraint
            $table->unsignedBigInteger('user_id'); // user_id tanpa foreign key constraint
            $table->string('link'); // Link monitoring
            $table->text('content')->nullable(); // Isi konten monitoring
            $table->string('author')->nullable(); // Nama akun author

            $table->string('like')->nullable(); // like content
            $table->string('comment')->nullable(); // comment content
            $table->string('share')->nullable(); // share content
            $table->string('view')->nullable(); // view content



            $table->timestamp('published_at')->nullable(); // Waktu publikasi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};
