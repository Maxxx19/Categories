<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default(null);
            $table->string('height')->default(null);
            $table->string('mass')->default(null);
            $table->string('hair_color')->default(null);
            $table->string('skin_color')->default(null);
            $table->string('eye_color')->default(null);
            $table->string('birth_year')->default(null);
            $table->string('gender')->default(null);
            $table->string('homeworld')->default(null);
            $table->string('url')->default(null);
            $table->date('created')->format('Y-m-d H:i:s');
            $table->date('edited')->format('Y-m-d H:i:s');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
