<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId("project_id")
                ->constrained()
                ->onDelete('cascade');
            $table->longText('message');
            $table->boolean('accepted')->nullable()->default(NULL);
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
        Schema::dropIfExists('project_applications');
    }
}
