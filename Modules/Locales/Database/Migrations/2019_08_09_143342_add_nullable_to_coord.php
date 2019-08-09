<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToCoord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locales__locals', function (Blueprint $table) {
            $table->string('latitud')->nullable()->change();
            $table->string('longitud')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locales__locals', function (Blueprint $table) {
            $table->string('latitud')->nullable(false)->change();
            $table->string('longitud')->nullable(false)->change();
        });
    }
}
