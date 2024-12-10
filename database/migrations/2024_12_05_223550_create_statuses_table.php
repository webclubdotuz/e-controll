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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->timestamps();
        });

        // Жараёнда
//         Муддатидан аввал ижро этилди
// 9.2 – Ўз вақтида ижро этилди
// 9.3 – Кечиктириб ижро этилди

        $statuses = [
            ['name' => 'Жараёнда', 'color' => '#000000'],
            ['name' => 'Муддатидан аввал ижро этилди', 'color' => '#FF0000'],
            ['name' => 'Ўз вақтида ижро этилди', 'color' => '#00FF00'],
            ['name' => 'Кечиктириб ижро этилди', 'color' => '#0000FF'],
        ];

        foreach ($statuses as $status) {
            \App\Models\Status::create($status);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
