<?php

namespace Database\Seeders;

use App\Models\NonPardusApp;
use App\Models\PardusApp;
use Illuminate\Database\Seeder;

class NonPardusAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $libreOffice = PardusApp::whereName('Libre Office')->firstOrFail();
        $gedit = PardusApp::whereName('Gedit')->firstOrFail();
        $firefox = PardusApp::whereName('Mozilla Firefox')->firstOrFail();
        $chromium = PardusApp::whereName('Chromium')->firstOrFail();
        $thunderbird = PardusApp::whereName('Mozilla Thunderbird')->firstOrFail();
        $kdenlive = PardusApp::whereName('KdenLive')->firstOrFail();
        $openshot = PardusApp::whereName('OpenShot')->firstOrFail();
        $vscode = PardusApp::whereName('Visual Studio Code (VS CODE)')->firstOrFail();
        $telegram = PardusApp::whereName('telegram')->firstOrFail();
        $discord = PardusApp::whereName('Discord')->firstOrFail();
        $zoom = PardusApp::whereName('Zoom')->firstOrFail();

        NonPardusApp::create([
            'name' => 'Microsoft Office',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/5/5f/Microsoft_Office_logo_%282019%E2%80%93present%29.svg",
        ])->pardusApps()->attach([$libreOffice->id]);

        NonPardusApp::create([
            'name' => 'Notepad / Wordpad',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/7/71/Notepad_icon.svg",
        ])->pardusApps()->attach([$gedit->id]);

        NonPardusApp::create([
            'name' => 'Internet Explorer / Microsoft Edge',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/1/1b/Internet_Explorer_9_icon.svg",
        ])->pardusApps()->attach([$firefox->id, $chromium->id]);

        NonPardusApp::create([
            'name' => "Mozilla Firefox",
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/6/67/Firefox_Logo%2C_2017.svg",
        ])->pardusApps()->attach([$firefox->id, $chromium->id]);

        NonPardusApp::create([
            'name' => "Google Chrome",
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/e/e2/Google_Chrome_icon_%282011%29.svg",
        ])->pardusApps()->attach([$firefox->id, $chromium->id]);

        NonPardusApp::create([
            'name' => "Microsoft Outlook",
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/d/df/Microsoft_Office_Outlook_%282018%E2%80%93present%29.svg",
        ])->pardusApps()->attach([$thunderbird->id]);

        NonPardusApp::create([
            'name' => "Windows Movie Maker",
            'image_url' => "https://upload.wikimedia.org/wikipedia/tr/3/37/Windows_Live_Movie_Maker_logo.png",
        ])->pardusApps()->attach([$kdenlive->id, $openshot->id]);

        NonPardusApp::create([
            'name' => "Adobe Premiere Pro",
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/4/40/Adobe_Premiere_Pro_CC_icon.svg",
        ])->pardusApps()->attach([$kdenlive->id, $openshot->id]);

        NonPardusApp::create([
            'name' => "Visual Studio Code (VS CODE)",
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/9/9a/Visual_Studio_Code_1.35_icon.svg",
        ])->pardusApps()->attach([$vscode->id]);

        NonPardusApp::create([
            'name' => "Telegram",
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/8/83/Telegram_2019_Logo.svg",
        ])->pardusApps()->attach([$telegram->id]);
        NonPardusApp::create([
            'name' => "Discord",
            'image_url' => "https://discord.com/assets/f8389ca1a741a115313bede9ac02e2c0.svg",
        ])->pardusApps()->attach([$discord->id]);
        NonPardusApp::create([
            'name' => "Zoom",
            'image_url' => "https://seeklogo.com/images/Z/zoom-fondo-azul-vertical-logo-8246E36E95-seeklogo.com.png",
        ])->pardusApps()->attach([$zoom->id]);
    }
}
