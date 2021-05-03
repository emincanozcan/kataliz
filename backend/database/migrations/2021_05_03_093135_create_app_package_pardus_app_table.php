<?php

use App\Models\AppPackage;
use App\Models\PardusApp;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppPackagePardusAppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_package_pardus_app', function (Blueprint $table) {
            $table->foreignIdFor(AppPackage::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PardusApp::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_package_pardus_app');
    }
}
