<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccademyProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accademy_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId("project_id")
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId("accademy_id")
                ->constrained()
                ->onDelete('cascade');
                
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
        Schema::dropIfExists('accademy_projects');
    }
}
