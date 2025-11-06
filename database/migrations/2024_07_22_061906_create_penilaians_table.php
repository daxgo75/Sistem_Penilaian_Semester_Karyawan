<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiansTable extends Migration
{
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('datakaryawan_id')->constrained('datakaryawans')->onDelete('cascade');
            $table->float('nilai_managerial')->nullable();
            $table->float('nilai_kinerja_1')->nullable();
            $table->float('nilai_kinerja_2')->nullable();
            $table->float('nilai_kinerja_3')->nullable();
            $table->float('nilai_kinerja_4')->nullable();
            $table->float('rata_rata_kinerja')->nullable();
            $table->float('nilai_perilaku_1')->nullable();
            $table->float('nilai_perilaku_2')->nullable();
            $table->float('nilai_perilaku_3')->nullable();
            $table->float('nilai_perilaku_4')->nullable();
            $table->float('rata_rata_perilaku')->nullable();
            $table->float('rata_rata_prestasi', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaians');
    }
}
