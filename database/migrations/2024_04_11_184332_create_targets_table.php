<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('staff_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('particular_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('p_june')->default(0)->nullable();
            $table->integer('january')->default(0)->nullable();
            $table->integer('february')->default(0)->nullable();
            $table->integer('march')->default(0)->nullable();
            $table->integer('april')->default(0)->nullable();
            $table->integer('may')->default(0)->nullable();
            $table->integer('june')->default(0)->nullable();
            $table->integer('july')->default(0)->nullable();
            $table->integer('august')->default(0)->nullable();
            $table->integer('september')->default(0)->nullable();
            $table->integer('october')->default(0)->nullable();
            $table->integer('november')->default(0)->nullable();
            $table->integer('december')->default(0)->nullable();
            $table->integer('ac_january')->default(0)->nullable();
            $table->integer('ac_february')->default(0)->nullable();
            $table->integer('ac_march')->default(0)->nullable();
            $table->integer('ac_april')->default(0)->nullable();
            $table->integer('ac_may')->default(0)->nullable();
            $table->integer('ac_june')->default(0)->nullable();
            $table->integer('ac_july')->default(0)->nullable();
            $table->integer('ac_august')->default(0)->nullable();
            $table->integer('ac_september')->default(0)->nullable();
            $table->integer('ac_october')->default(0)->nullable();
            $table->integer('ac_november')->default(0)->nullable();
            $table->integer('ac_december')->default(0)->nullable();
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
        Schema::dropIfExists('targets');
    }
};
