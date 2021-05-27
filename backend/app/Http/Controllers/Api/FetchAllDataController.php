<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppPackage;
use App\Models\NonPardusApp;
use App\Models\PardusApp;

class FetchAllDataController extends Controller
{
    public function __invoke()
    {
        // caching this all data probably good idea for production usage.
        $pardusApps = PardusApp::select(['id', 'name', 'image_url', 'scripts'])
            ->whereNotNull('scripts')
            ->get();

        $nonPardusApps = NonPardusApp::select(['id', 'name', 'image_url'])
            ->whereHas('pardusApps', function ($q) {
                $q->whereNotNull('scripts');
            })
            ->with(['pardusApps:id'])
            ->get()
            ->toArray();

        foreach ($nonPardusApps as $k => $v) {
            $alternatives = collect($v['pardus_apps'])->pluck('id')->toArray();
            foreach ($alternatives as $key => $pardus_app_id) {
                if ($pardusApps->where('id', $pardus_app_id)->count() < 1) {
                    unset($alternatives[$key]);
                }
            }

            $nonPardusApps[$k]['pardus_apps'] = array_values($alternatives);
        }

        $appPackages = AppPackage::select(['id', 'name', 'image_url'])->with('pardusApps:id')->get()->toArray();
        foreach ($appPackages as $k => $v) {
            $appPackages[$k]['pardus_apps'] = collect($v['pardus_apps'])->pluck('id')->toArray();
        }

        return response([
            'success' => true,
            'message' => 'Data is fetched successfully.',
            'data' => [
                'pardus_apps' => $pardusApps,
                'non_pardus_apps' => $nonPardusApps,
                'app_packages' => $appPackages
            ]
        ]);
    }
}
