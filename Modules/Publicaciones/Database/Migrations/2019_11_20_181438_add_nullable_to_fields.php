<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publicaciones__publicacions', function (Blueprint $table) {
          $table->string('titulo')->nullable()->change();
          $table->string('texto', 800)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publicaciones__publicacions', function (Blueprint $table) {
          $table->string('titulo')->nullable(false)->change();
          $table->string('texto', 800)->nullable(false)->change();
        });
    }
}
