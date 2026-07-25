<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worker_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->string('category', 100);
            $table->string('area');
            $table->text('description');
            $table->decimal('expected_rate', 12, 2)->unsigned();

            $table->timestamps();

            $table->index('category');
            $table->index('area');
            $table->index(['category', 'area']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worker_profiles');
    }
};