<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('job_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('hirer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('worker_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('rating');
            $table->text('review')->nullable();

            $table->timestamps();

            $table->index('hirer_id');
            $table->index('worker_id');
            $table->index('rating');
            $table->index(['worker_id', 'rating']);
        });

        DB::statement(
            'ALTER TABLE reviews ADD CONSTRAINT reviews_rating_check CHECK (rating BETWEEN 1 AND 5)'
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};