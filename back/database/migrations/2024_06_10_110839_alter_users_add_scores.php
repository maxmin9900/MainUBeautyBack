<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->float('trustedScore')->default(0)->nullable();
            $table->float('popularScore')->default(0)->nullable();
            $table->unsignedTinyInteger('serviceCount')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('trustedScore');
            $table->dropColumn('popularScore');
            $table->dropColumn('serviceCount');
        });
    }
};
