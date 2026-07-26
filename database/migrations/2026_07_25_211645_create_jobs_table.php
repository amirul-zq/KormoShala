<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hirer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('category', 100);
            $table->text('description');
            $table->string('area');
            $table->date('work_date');
            $table->decimal('budget', 12, 2)->unsigned();

            $table->enum('status', [
                'open',
                'assigned',
                'completed',
            ])->default('open');

            $table->foreignId('selected_worker_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index('hirer_id');
            $table->index('selected_worker_id');
            $table->index('status');
            $table->index('category');
            $table->index('area');
            $table->index('work_date');

            $table->index(['status', 'category']);
            $table->index(['hirer_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};