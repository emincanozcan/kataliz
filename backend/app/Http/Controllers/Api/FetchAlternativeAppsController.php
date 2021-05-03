<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NonPardusApp;
use Illuminate\Http\Request;

class FetchAlternativeAppsController extends Controller
{
    public function __invoke()
    {
        // @todo send only id fields of pardus apps, client itself should fetch pardusApps and merge data.
        $data = NonPardusApp::with('pardusApps')->get();
        return response([
            'success' => true,
            'message' => 'Alternative apps are fetched successfully.',
            'data' => [
                'alternative_apps' => $data,
            ]
        ]);
    }
}
