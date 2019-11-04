<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('request_text');
            $table->json('parser')->nullable();
            $table->string('status')->default('NEW');
            $table->bigInteger('user_id')->nullable();
            $table->timestamps();
        });

        DB::unprepared(
            "ALTER TABLE api_requests
              ADD CONSTRAINT api_requests_fk FOREIGN KEY (user_id)
                REFERENCES users(id)
                ON DELETE set null
                ON UPDATE CASCADE
                NOT DEFERRABLE;");

        Schema::table('api_requests', function (Blueprint $table) {
            $table->index(['status', 'created_at']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_requests');
    }
}
