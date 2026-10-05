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
        // 1. Reports & Intelligence Publications
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('category')->index(); // macro_markets, logistics, incentives, defence, procurement, diplomacy
            $table->json('title'); // { "en": "...", "ar": "...", "tr": "..." }
            $table->json('summary'); // { "en": "...", "ar": "...", "tr": "..." }
            $table->json('content')->nullable(); // Rich body or key takeaways
            $table->json('tags')->nullable(); // ['macro', 'fdi', ...]
            $table->string('read_time')->default('12 min');
            $table->date('published_date');
            $table->string('pdf_file')->nullable();
            $table->unsignedInteger('downloads_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Weekly Bulletins
        Schema::create('bulletins', function (Blueprint $table) {
            $table->id();
            $table->string('issue_number'); // e.g. "Issue #48"
            $table->date('published_date');
            $table->json('title');
            $table->json('summary');
            $table->json('highlights')->nullable();
            $table->string('pdf_file')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // 3. Newsletter Subscribers
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('full_name')->nullable();
            $table->string('organization')->nullable();
            $table->string('locale', 10)->default('en');
            $table->string('status')->default('active'); // active, unsubscribed
            $table->timestamps();
        });

        // 4. Inquiries & Advisory Briefing Requests
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('organization');
            $table->string('country');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('service_type'); // embassy, corporate, b2b, reports, events, consular, general
            $table->text('details');
            $table->string('status')->default('new'); // new, reviewed, in_progress, archived
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });

        // 5. Four Pillars & Sub-Services
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('pillar_key')->index(); // economy, relations, events, community
            $table->string('slug')->unique();
            $table->json('title');
            $table->json('summary');
            $table->json('description')->nullable();
            $table->json('deliverables')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('subscribers');
        Schema::dropIfExists('bulletins');
        Schema::dropIfExists('reports');
    }
};
