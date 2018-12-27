<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('icon');
            $table->integer('count')->nullable();
            $table->float('rate')->nullable();
            $table->integer('diligence_count')->nullable();
            $table->flaot('diligence')->nullable();
            $table->integer('punctuality_count')->nullable();
            $table->float('punctuality')->nullable();
            $table->integer('knowledge_count')->nullable();
            $table->float('knowledge')->nullable();
            $table->string('sex')->nullable();
            $table->boolean('active')->default(true);
            $table->string('group');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('privileges');
    }
}
