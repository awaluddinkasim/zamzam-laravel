<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('alamat');
            $table->string('no_hp')->unique();
            $table->rememberToken();
            $table->timestamps();
        });

        $user = new User();
        $user->nama = "User";
        $user->email = "user@gmail.com";
        $user->password = Hash::make('123');
        $user->alamat = "Rumah";
        $user->no_hp = "018230198312";
        $user->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
