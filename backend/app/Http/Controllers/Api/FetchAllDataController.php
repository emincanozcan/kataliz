<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppPackage;
use App\Models\NonPardusApp;
use App\Models\PardusApp;
use Illuminate\Http\Request;

class FetchAllDataController extends Controller
{
    public function __invoke()
    {
        // caching this all data probably good idea for production usage.
        $pardusApps = PardusApp::select(['id', 'name', 'image_url', 'scripts'])->get();

        $nonPardusApps = NonPardusApp::select(['id', 'name', 'image_url'])->with(['pardusApps:id'])->get()->toArray();
        foreach ($nonPardusApps as $k => $v) {
            $nonPardusApps[$k]['pardus_apps'] = collect($v['pardus_apps'])->pluck('id')->toArray();
        }

        $appPackages = AppPackage::select(['id', 'name', 'image_url'])->with('pardusApps:id')->get()->toArray();
        foreach ($appPackages as $k => $v) {
            $appPackages[$k]['pardus_apps'] = collect($v['pardus_apps'])->pluck('id')->toArray();
        }

        return response([
            'success' => true,
            'message' => 'Alternative apps are fetched successfully.',
            'data' => [
                'pardus_apps' => $pardusApps,
                'non_pardus_apps' => $nonPardusApps,
                'app_packages' => $appPackages
            ]
        ]);
    }
}
