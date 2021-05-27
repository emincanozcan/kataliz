<?php

namespace Database\Seeders;

use App\Models\NonPardusApp;
use App\Models\PardusApp;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
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

        $path = base_path('database/seeders/alternativeto-scraper/app-data');
        $dir = opendir($path);
        while (false !== ($filename = readdir($dir))) {
            if (!str_contains($filename, 'json')) {
                continue;
            }

            $data = json_decode(file_get_contents(base_path('database/seeders/alternativeto-scraper/app-data/' . $filename)));

            if ($data->likes < 50) {
                continue;
            }

            if ($data->linux === false) {
                $nonPardusApp = NonPardusApp::firstOrCreate([
                    'name' => $data->name,
                    'image_path' => $this->getImagePath($data->img)
                ]);
                $this->generateAlternatives($nonPardusApp, $data->alternativeIds);
                continue;
            }

            $pardusApp = PardusApp::firstOrCreate([
                'name' => $data->name,
                'image_path' => $this->getImagePath($data->img)
            ]);

            if ($data->mac === true || $data->windows === true) {
                $nonPardusApp = NonPardusApp::firstOrCreate([
                    'name' => $data->name,
                    'image_path' => $this->getImagePath($data->img)
                ]);
                $nonPardusApp->pardusApps()->attach($pardusApp->id);

                $this->generateAlternatives($nonPardusApp, $data->alternativeIds);
            }

        }

        $this->call(PardusAppSeeder::class);
    }

    protected function generateAlternatives($nonPardusApp, $alternativeIds)
    {
        foreach ($alternativeIds as $alternativeId) {
            try {
                $alternativeAppData = json_decode(file_get_contents(base_path('database/seeders/alternativeto-scraper/app-data/' . $alternativeId . '.json')));
            } catch (\Exception $exception) {
                continue;
            }

            $pardusApp = PardusApp::firstOrCreate([
                'name' => $alternativeAppData->name,
                'image_path' => $this->getImagePath($alternativeAppData->img)
            ]);
            $nonPardusApp->pardusApps()->attach($pardusApp->id);
        }
    }
}
