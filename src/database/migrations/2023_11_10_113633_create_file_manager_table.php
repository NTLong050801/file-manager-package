<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ntlong050801\FileManager\app\Models\FileManager;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('file_manager', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('file_manager')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('is_trash')->default(false);
            $table->boolean('is_direct_deleted')->default(false);
            $table->timestamps();
        });
        $users = \App\Models\User::all();
        foreach ($users as $user){
            $userFolder = "user_{$user->id}";
            $rootPath = "File-manager/{$userFolder}";
            Storage::makeDirectory($rootPath);

            // Lưu thông tin thư mục gốc vào cơ sở dữ liệu
            FileManager::create([
                'name' => $user->name . "'s Document",
                'file_path' => $rootPath,
                'user_id' => $user->id,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_manager');
    }
};
