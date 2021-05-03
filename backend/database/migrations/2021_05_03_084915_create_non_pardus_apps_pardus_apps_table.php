<?php

use App\Models\NonPardusApp;
use App\Models\PardusApp;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNonPardusAppsPardusAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_pardus_app_pardus_app', function (Blueprint $table) {
            $table->foreignIdFor(NonPardusApp::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('non_pardus_apps_pardus_apps');
    }
}
