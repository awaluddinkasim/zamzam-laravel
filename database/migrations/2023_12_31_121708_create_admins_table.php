<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('level', ['admin', 'owner'])->default('admin');
            $table->rememberToken();
            $table->timestamps();
        });

        $admin = new Admin();
        $admin->nama = "Administrator";
        $admin->email = "admin@localhost";
        $admin->password = Hash::make("123");
        $admin->save();

        $admin = new Admin();
        $admin->nama = "Owner";
        $admin->email = "owner@localhost";
        $admin->password = Hash::make("123");
        $admin->level = 'Owner';
        $admin->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
