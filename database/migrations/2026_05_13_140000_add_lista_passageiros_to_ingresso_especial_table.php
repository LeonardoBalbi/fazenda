<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('ingresso_especial', 'lista_passageiros')) {
            Schema::table('ingresso_especial', function (Blueprint $table) {
                $table->text('lista_passageiros')->nullable()->after('observacao');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('ingresso_especial', 'lista_passageiros')) {
            Schema::table('ingresso_especial', function (Blueprint $table) {
                $table->dropColumn('lista_passageiros');
            });
        }
    }
};
