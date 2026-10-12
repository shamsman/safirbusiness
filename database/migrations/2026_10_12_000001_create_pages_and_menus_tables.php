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
        // 1. Dynamic Pages
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('template')->default('default'); // 'default', 'about'
            $table->json('title');                          // { "en": "...", "ar": "...", "tr": "..." }
            $table->json('summary')->nullable();            // { "en": "...", "ar": "...", "tr": "..." }
            $table->json('content')->nullable();            // { "en": "...", "ar": "...", "tr": "..." }
            $table->json('blocks')->nullable();             // Structured data e.g. founders CVs
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        // 2. Navigation Menus
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->unique(); // 'header', 'footer_pillars', 'footer_quick_links', 'footer_legal'
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 3. Navigation Menu Items
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menus')->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('menu_items')->cascadeOnDelete();
            $table->json('label');                           // { "en": "...", "ar": "...", "tr": "..." }
            $table->string('type')->default('url');          // 'page', 'route', 'url'
            $table->string('url')->nullable();
            $table->string('route_name')->nullable();
            $table->foreignId('page_id')->nullable()->constrained('pages')->nullOnDelete();
            $table->string('target')->default('_self');       // '_self', '_blank'
            $table->string('icon')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('pages');
    }
};
