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
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

			// relasi ke tabel users
			$table->foreignId('user_id')
			->nullable()
			->constrained('users')
			->nullOnDelete();

			// Konten Utama Post
			$table->string('title',255); //varchar
			$table->text('content'); //text
			$table->date('publish_date')->nullable();
			$table->boolean('is_publish')->default(false); //post tidak langsung di publish
			$table->string('image')->nullable(); //string

			// Default Created & Updated
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
