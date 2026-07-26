<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('job_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('worker_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->decimal('offered_price', 12, 2)->unsigned();
            $table->text('message');
            $table->timestamps();

            $table->unique(['job_id', 'worker_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};