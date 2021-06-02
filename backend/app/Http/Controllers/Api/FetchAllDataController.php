<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppPackage;
use App\Models\NonPardusApp;
use App\Models\PardusApp;
use Illuminate\Support\Facades\Cache;

class FetchAllDataController extends Controller
{
    public function __invoke()
    {
        $data = Cache::remember('api-all-data', 60 * 5, function () {
            $pardusApps = PardusApp::select(['id', 'name', 'image_path', 'scripts'])
                ->whereNotNull('scripts')
                ->orderByDesc('alternativeto_likes')
                ->get();

            $nonPardusApps = NonPardusApp::select(['id', 'name', 'image_path'])
                ->whereHas('pardusApps', function ($q) {
                    $q->whereNotNull('scripts');
                })
                ->with(['pardusApps:id'])
                ->orderByDesc('alternativeto_likes')
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

            $pardusApps = $pardusApps->toArray();
            foreach ($pardusApps as $key => $value) {
                unset($pardusApps[$key]['image_path']);
            }

            $appPackages = AppPackage::select(['id', 'name', 'image_path'])->with('pardusApps:id')->get()->toArray();
            foreach ($appPackages as $k => $v) {
                $appPackages[$k]['pardus_apps'] = collect($v['pardus_apps'])->pluck('id')->toArray();
            }

            return [
                'success' => true,
                'message' => 'Data is fetched successfully.',
                'data' => [
                    'pardus_apps' => $pardusApps,
                    'non_pardus_apps' => $nonPardusApps,
                    'app_packages' => $appPackages
                ]
            ];
        });

        return response($data);
    }
}
