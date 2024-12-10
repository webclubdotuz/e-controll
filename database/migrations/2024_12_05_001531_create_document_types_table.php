<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // 1.1 – Кўрсатма
        // 1.2 – Шарҳ
        // 1.3 – Баённома
        // 1.4 -  Сўровнома
        // 1.5 – Бошқа

        DB::table('document_types')->insert([
            ['name' => 'Кўрсатма'],
            ['name' => 'Шарҳ'],
            ['name' => 'Баённома'],
            ['name' => 'Сўровнома'],
            ['name' => 'Бошқа'],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};
