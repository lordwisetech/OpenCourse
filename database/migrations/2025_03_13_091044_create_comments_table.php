<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('course_id');
        $table->unsignedBigInteger('user_id')->nullable(); // Nullable for guest comments
        $table->string('guest_name')->nullable(); // Store guest name
        $table->text('comment');
        $table->unsignedBigInteger('parent_id')->nullable(); // For replies
        $table->timestamps();

        $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
