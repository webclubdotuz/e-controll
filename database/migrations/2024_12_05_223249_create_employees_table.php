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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained();
            $table->string('fullname');
            $table->string('position')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });

        $employees = [
            [
                'section_id' => 1,
                'fullname' => 'Иванов Иван Иванович',
                'position' => 'Инженер',
                'phone' => '+998901234567',
            ],
            [
                'section_id' => 1,
                'fullname' => 'Петров Петр Петрович',
                'position' => 'Инженер',
                'phone' => '+998901234567',
            ],
            [
                'section_id' => 2,
                'fullname' => 'Сидоров Сидор Сидорович',
                'position' => 'Инженер',
                'phone' => '+998901234567',
            ],
            [
                'section_id' => 2,
                'fullname' => 'Александров Александр Александрович',
                'position' => 'Инженер',
                'phone' => '+998901234567',
            ],
            [
                'section_id' => 3,
                'fullname' => 'Андреев Андрей Андреевич',
                'position' => 'Инженер',
                'phone' => '+998901234567',
            ],
            [
                'section_id' => 3,
                'fullname' => 'Алексеев Алексей Алексеевич',
                'position' => 'Инженер',
                'phone' => '+998901234567',
            ]
        ];

        foreach ($employees as $employee) {
            \App\Models\Employee::create($employee);
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
