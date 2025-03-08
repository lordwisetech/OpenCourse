<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);
            $table->text('description');
            $table->text('video_url')->nullable();     // Use text to support long URLs
            $table->text('thumbnail')->nullable();       // Use text for longer file paths
            $table->json('contents')->nullable();        // Store course content as JSON
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
