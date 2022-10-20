<?php

use App\Models\Terminal;
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
        Schema::create('terminals', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->text('address');
            $table->string('province');
            $table->string('district');
            $table->string('sub_district');
            $table->enum('type', [Terminal::TYPE]);
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
        Schema::dropIfExists('terminals');
    }
};
