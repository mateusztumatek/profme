<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('email')->nullable(false);
            $table->string('official_name');
            $table->string('image')->nullable(true);
            $table->string('postal_code')->nullable(false);
            $table->string('street')->nullable(true);
            $table->integer('street_number')->nullable(false);
            $table->string('nip')->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('country')->nullable(false);
            $table->boolean('is_verify')->default(false);
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
        Schema::dropIfExists('companies');
    }
}
