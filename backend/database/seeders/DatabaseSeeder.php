<?php

namespace Database\Seeders;

use App\Models\NonPardusApp;
use App\Models\PardusApp;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    function getImagePath($image)
    {
        if ($image === "not_found") return "";
        return Storage::disk('public')->putFile("images", base_path('database/seeders/alternativeto-scraper/images/' . $image));
    }

    public function run()
    {
        User::create([
            'name' => 'Emincan Ozcan',
            'email' => 'emincanozcann@gmail.com',
            'password' => bcrypt('password')
        ]);
//        $this->call(PardusAppSeeder::class);
//        $this->call(NonPardusAppSeeder::class);
//        $this->call(AppPackageSeeder::class);

        $path = base_path('database/seeders/alternativeto-scraper/app-data');
        $dir = opendir($path);
        while (false !== ($filename = readdir($dir))) {
            if (!str_contains($filename, 'json')) continue;

            $data = json_decode(file_get_contents(base_path('database/seeders/alternativeto-scraper/app-data/' . $filename)));

            if ($data->id === $data->alternativeIds[0] && count($data->alternativeIds) === 1) {
                if (!$nonPardusApp = NonPardusApp::where('name', $data->name)->first()) {
                    $nonPardusApp = NonPardusApp::create([
                        'name' => $data->name,
                        'image_path' => $this->getImagePath($data->img)
                    ]);
                }
                if (!$pardusApp = PardusApp::where('name', $data->name)->first()) {
                    $pardusApp = PardusApp::create([
                        'name' => $data->name,
                        'image_path' => $this->getImagePath($data->img)
                    ]);
                }
                $nonPardusApp->pardusApps()->attach($pardusApp->id);

            } else {
                // means it is an nonpardus app and have linux alternatives..

                if (!$nonPardusApp = NonPardusApp::where('name', $data->name)->first()) {
                    $nonPardusApp = NonPardusApp::create([
                        'name' => $data->name,
                        'image_path' => $this->getImagePath($data->img)
                    ]);
                }

                foreach ($data->alternativeIds as $alternativeId) {
                    try {
                        $alternativeAppData = json_decode(file_get_contents(base_path('database/seeders/alternativeto-scraper/app-data/' . $alternativeId . '.json')));
                    } catch (\Exception $exception) {
                        continue;
                    }

                    if (!$pardusApp = PardusApp::where('name', $alternativeAppData->name)->first()) {
                        $pardusApp = PardusApp::create([
                            'name' => $alternativeAppData->name,
                            'image_path' => $this->getImagePath($alternativeAppData->img)
                        ]);
                    }
                    $nonPardusApp->pardusApps()->attach($pardusApp->id);
                }

            }


        }
    }
}
