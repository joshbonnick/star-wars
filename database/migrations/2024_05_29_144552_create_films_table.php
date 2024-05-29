<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index()
                ->comment('The title of this film');
            $table->integer('episode_id')
                ->unique()
                ->comment('The episode number of this film.');
            $table->text('opening_crawl')
                ->comment('The opening paragraphs at the beginning of this film.');
            $table->string('director')
                ->comment('The name of the director of this film.');
            $table->json('producers')
                ->comment('The name(s) of the producer(s) of this film. Comma separated.');
            $table->date('released_at')
                ->comment('The ISO 8601 date format of film release at original creator country.');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
