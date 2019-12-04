<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToContactos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('contacto', function (Blueprint $table) {
        $table->boolean('importante')->default(false);
        $table->string('tipo')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('contacto', function (Blueprint $table) {
        $table->dropColumn('importante');
        $table->dropColumn('tipo');
      });
    }
}
