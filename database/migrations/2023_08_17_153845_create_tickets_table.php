<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->boolean('A')->default(false);
            $table->boolean('B')->default(false);
            $table->boolean('C')->default(false);
            $table->boolean('D')->default(false);
            $table->boolean('E')->default(false);
            $table->boolean('F')->default(false);
            $table->boolean('G')->default(false);
            $table->boolean('H')->default(false);
            $table->boolean('I')->default(false);
            $table->boolean('J')->default(false);
            $table->boolean('K')->default(false);
            $table->boolean('L')->default(false);
            $table->boolean('M')->default(false);
            $table->boolean('N')->default(false);
            $table->boolean('O')->default(false);
            $table->boolean('P')->default(false);
            $table->boolean('Q')->default(false);
            $table->boolean('R')->default(false);
            $table->boolean('S')->default(false);
            $table->boolean('T')->default(false);
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
        Schema::dropIfExists('tickets');
    }
}
