<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customers_id');
            $table->unsignedBigInteger('vouchers_id');
            $table->unsignedBigInteger('unique_links_id');
            $table->string('imei');
            $table->string('device_type');
            $table->string('device_manufacturer');
            $table->string('device_model');
            $table->string('device_ram');
            $table->string('device_storage');
            $table->tinyInteger('screen_has_problem');
            $table->string('status');
            $table->string('reason_for_rejected')->nullable();
            $table->string('chronology_for_requested_claim')->nullable();
            $table->string('reason_for_rejected_claim')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('actived_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->foreign('customers_id')->references('id')->on('customers')->onCascade('delete');
            $table->foreign('vouchers_id')->references('id')->on('vouchers')->onCascade('delete');
            $table->foreign('unique_links_id')->references('id')->on('unique_links')->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('processes');
    }
}
