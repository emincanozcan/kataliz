<?php

namespace Database\Seeders;

use App\Models\NonPardusApp;
use App\Models\PardusApp;
use Illuminate\Database\Seeder;

class NonPardusAppSeeder extends Seeder
{
    private function haveSame($name)
    {
        $app = PardusApp::whereName($name)->firstOrFail();
        NonPardusApp::create([
            'name' => $app->name,
            'image_url' => $app->image_url,
        ])->pardusApps()->attach([$app->id]);
    }

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
        $gimp = PardusApp::whereName('Gimp')->firstOrFail();
        $krita = PardusApp::whereName('Krita')->firstOrFail();
        $evince = PardusApp::whereName('Evince')->firstOrFail();
        $okular = PardusApp::whereName('Okular')->firstOrFail();
        $gitCola = PardusApp::whereName('Git Cola')->firstOrFail();
        $gitKraken = PardusApp::whereName('Git Kraken')->firstOrFail();
        $qBitTorrent = PardusApp::whereName('QBittorrent')->firstOrFail();

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
            'name' => 'Adobe Photoshop',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/a/af/Adobe_Photoshop_CC_icon.svg",
        ])->pardusApps()->attach([$gimp->id, $krita->id]);

        NonPardusApp::create([
            'name' => 'Adobe Reader',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/0/0a/Adobe_Acrobat_DC_icon.svg",
        ])->pardusApps()->attach([$evince->id, $okular->id]);

        NonPardusApp::create([
            'name' => 'SourceTree',
            'image_url' => "https://cdn.worldvectorlogo.com/logos/sourcetree-1.svg",
        ])->pardusApps()->attach([$gitCola->id, $gitKraken->id]);

        NonPardusApp::create([
            'name' => 'UTorrent',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/6/61/%CE%9CTorrent_2.2_icon.svg",
        ])->pardusApps()->attach([$qBitTorrent->id]);

        $this->haveSame('Git');
        $this->haveSame('Visual Studio Code (VS CODE)');
        $this->haveSame('Discord');
        $this->haveSame('Zoom');
        $this->haveSame('Telegram');
        $this->haveSame('Spotify');
        $this->haveSame('Audacity');
        $this->haveSame('Vlc Player');
        $this->haveSame('Python');
        $this->haveSame('PIP (Python Paket Yöneticisi)');
    }
}
