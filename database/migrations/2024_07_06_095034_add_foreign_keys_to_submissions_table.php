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
        Schema::table('submissions', function (Blueprint $table) {
            $table->foreign('selection_id')->references('id')->on('selection_regists')->onDelete('cascade');
            $table->foreign('athlet_id')->references('id')->on('athletes')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign(['selection_id']);
            $table->dropForeign(['athlet_id']);
            $table->dropForeign(['branch_id']);
        });
    }
};
