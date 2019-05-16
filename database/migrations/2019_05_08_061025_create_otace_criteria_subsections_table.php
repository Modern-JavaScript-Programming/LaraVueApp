<?php

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtaceCriteriaSubsectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otace_criteria_subsections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('section_id')->index();
            $table->string('subsection_name');
            $table->text('subsection_desc');
            $table->enum('rating', ['Y', 'N'])->default('N');
            $table->timestamps();
        });

        Schema::table('otace_criteria_subsections', function (Blueprint $table) {
            $table->foreign('section_id')
                ->references('id')
                ->on('otace_criteria_sections')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otace_criteria_subsections');
    }
}
