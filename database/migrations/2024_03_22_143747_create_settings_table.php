<?php

use App\Models\Setting;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        });

        Setting::insert([
            [
                'key' => 'pemilik',
                'value' => 'Hj. Hasni',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'rekening',
                'value' => '1234578',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'bank',
                'value' => 'BCA',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
