<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicHolidayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_holiday', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dates', 10);
            $table->timestamps();
        });

        DB::connection('mysql')->table('public_holiday')->insert([
            /**
             * Dummy Holiday Dates
             */
            [
                'dates' => 'Nov_27',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'dates' => 'Nov_29',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public_holiday');
    }
}
