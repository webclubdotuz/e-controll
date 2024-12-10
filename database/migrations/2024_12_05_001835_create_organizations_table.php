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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        $organizations = [
            ['name' => 'Toshkent shahar hokimligi'],
            ['name' => 'Oliy va o\'rta maxsus ta\'lim vazirligi'],
            ['name' => 'Oliy va o\'rta maxsus ta\'lim boshqarmasi'],
            ['name' => 'Oliy va o\'rta maxsus ta\'lim muassasasi'],
        ];

        DB::table('organizations')->insert($organizations);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
