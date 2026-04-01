<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Thêm cột phone (cho phép null nếu người dùng chưa cập nhật)
            $table->string('phone')->nullable()->after('email'); 
            
            // Thêm cột photo để lưu đường dẫn ảnh
            $table->string('photo')->nullable()->after('phone');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'photo']);
        });
    }
};
