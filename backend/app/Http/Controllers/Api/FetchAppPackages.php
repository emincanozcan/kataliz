<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppPackage;
use App\Models\NonPardusApp;
use Illuminate\Http\Request;

class FetchAppPackages extends Controller
{
    public function __invoke()
    {
        $data = AppPackage::with('pardusApps')->get();
        return response([
            'success' => true,
            'message' => 'App packages are fetched successfully.',
            'data' => [
                'app_packages' => $data,
            ]
        ]);
    }
}
