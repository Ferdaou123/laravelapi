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
    Schema::table('invoices', function (Blueprint $table) {
        $table->string('file_path')->nullable(); // Ajoutez une colonne de type string
    });
}

public function down()
{
    Schema::table('invoices', function (Blueprint $table) {
        $table->dropColumn('file_path');
    });
}

    };
