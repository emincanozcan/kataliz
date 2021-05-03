<?php

namespace Database\Seeders;

use App\Models\AppPackage;
use App\Models\PardusApp;
use Illuminate\Database\Seeder;

class AppPackageSeeder extends Seeder
{
    private function addWithName()
    {

    }

    public function run()
    {
        $libreOffice = PardusApp::whereName('Libre Office')->firstOrFail();
        $gedit = PardusApp::whereName('Gedit')->firstOrFail();
        $thunderbird = PardusApp::whereName('Mozilla Thunderbird')->firstOrFail();
        $kdenlive = PardusApp::whereName('KdenLive')->firstOrFail();
        $openshot = PardusApp::whereName('OpenShot')->firstOrFail();
        $vscode = PardusApp::whereName('Visual Studio Code (VS CODE)')->firstOrFail();
        $python = PardusApp::whereName('Python')->firstOrFail();
        $pip = PardusApp::whereName('PIP (Python Paket Yöneticisi)')->firstOrFail();
        $docker = PardusApp::whereName('Docker')->firstOrFail();
        $dockerCompose = PardusApp::whereName('Docker Compose')->firstOrFail();
        $telegram = PardusApp::whereName('Telegram')->firstOrFail();
        $discord = PardusApp::whereName('Discord')->firstOrFail();
        $zoom = PardusApp::whereName('Zoom')->firstOrFail();
        $git = PardusApp::whereName('Git')->firstOrFail();
        $okular = PardusApp::whereName('Okular')->firstOrFail();

        AppPackage::create([
            "name" => "Docker Paketi",
            "image_url" => "https://cdn.worldvectorlogo.com/logos/docker.svg",
        ])->pardusApps()->attach([$docker->id, $dockerCompose->id]);

        AppPackage::create([
            "name" => "İletişim Uygulamaları Paketi",
            "image_url" => "https://upload.wikimedia.org/wikipedia/commons/4/4b/Phone_font_awesome.svg",
        ])->pardusApps()->attach([$telegram->id, $zoom->id, $discord->id]);

        AppPackage::create([
            "name" => "Video Editörü Paketi",
            "image_url" => "https://cdn.icon-icons.com/icons2/1713/PNG/512/iconfinder-videoeditorfilmsproduction-3993846_112661.png",
        ])->pardusApps()->attach([$openshot->id, $kdenlive->id,]);

        AppPackage::create([
            "name" => "Ofis Paketi",
            "image_url" => "https://icons.iconarchive.com/icons/inipagi/job-seeker/512/front-office-icon.png",
        ])->pardusApps()->attach([$gedit->id, $libreOffice->id, $thunderbird->id, $okular->id]);

        AppPackage::create([
            "name" => "Python Geliştirici Paketi",
            "image_url" => "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/1024px-Python-logo-notext.svg.png",
        ])->pardusApps()->attach([$python->id, $pip->id, $vscode->id, $git->id]);
    }
}
