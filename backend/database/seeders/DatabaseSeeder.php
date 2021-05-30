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

            if ($data->likes < 51) {
                continue;
            }

            if ($data->linux === false) {
                $nonPardusApp = $this->firstOrCreateNonPardusApp($data);
                $this->generateAlternatives($nonPardusApp, $data->alternativeIds);
                continue;
            }

            $pardusApp = $this->firstOrCreatePardusApp($data);

            if ($data->mac === true || $data->windows === true) {
                $this->firstOrCreateNonPardusApp($data)->pardusApps()->attach($pardusApp->id);
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

            $pardusApp = $this->firstOrCreatePardusApp($alternativeAppData);
            $nonPardusApp->pardusApps()->attach($pardusApp->id);
        }
    }

    protected function firstOrCreatePardusApp($data)
    {
        return PardusApp::firstOrCreate(
            ['name' => $data->name, 'alternativeto_likes' => $data->likes],
            ['image_path' => $this->getImagePath($data->img)]
        );
    }

    protected function firstOrCreateNonPardusApp($data)
    {
        return NonPardusApp::firstOrCreate(
            ['name' => $data->name, 'alternativeto_likes' => $data->likes],
            ['image_path' => $this->getImagePath($data->img)]
        );
    }
}
