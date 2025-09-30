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
			$table->foreignId('user_id')->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			$table->string('title',255); //varcha
			$table->text('content'); //text
			$table->date('published_at'); //date
			$table->boolean('is_active')->default(true); //boolean
			$table->text('image')->nullable(); //text
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
        Schema::dropIfExists('posts');
    }
};
