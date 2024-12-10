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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('leader_fullname');
            $table->timestamps();
        });

        $sections = [
            [
                'name' => 'Болим 1',
                'description' => 'Бу болимда ...',
                'leader_fullname' => 'Бошлиқ Ф.И.Ш.',
            ],
            [
                'name' => 'Болим 2',
                'description' => 'Бу болимда ...',
                'leader_fullname' => 'Бошлиқ Ф.И.Ш.',
            ],
            [
                'name' => 'Болим 3',
                'description' => 'Бу болимда ...',
                'leader_fullname' => 'Бошлиқ Ф.И.Ш.',
            ],
        ];

        foreach ($sections as $section) {
            \App\Models\Section::create($section);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
