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
        Schema::create('blogs', function (Blueprint $table) {
            /** BASIC INFO */
            $table->id();
            $table->string('title')->nullable();
            $table->string('desc')->nullable();
            $table->string('cover')->nullable();
            $table->string('cover_alt')->nullable()->default('');
            $table->text('body')->nullable();
            $table->enum('status', ['draft', 'published', 'validating'])->default('draft');

            /** BLOG CONFIGURATION */
            $table->boolean('include_title_and_desc_on_body')->default(true);

            /** FOREIGN KEYS */
            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('verifier_id')->nullable()->constrained('users');

            /** TIMESTAMPS */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
