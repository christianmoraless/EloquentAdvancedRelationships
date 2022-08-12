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
        Schema::table('users', function (Blueprint $table) {

            $table->bigInteger('level_id')->unsigned()->nulleable()->after('id');

            $table->foreign('level_id')
                    ->references('id')
                    ->on('levels');
                    // ->onDelete('set null')
                    // ->onCascade('cascade');
                    // ->cascadeOnUpdate()
                    // ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
