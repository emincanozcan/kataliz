<?php

namespace Database\Seeders;

use App\Models\PardusApp;
use Illuminate\Database\Seeder;

class PardusAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        PardusApp::create([
//            'name' => 'Spotify',
//            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/1/19/Spotify_logo_without_text.svg",
//            'scripts' => [
//                'sudo apt install curl -y',
//                'sudo curl -sS https://download.spotify.com/debian/pubkey_0D811D58.gpg | sudo apt-key add -',
//                'sudo echo "deb http://repository.spotify.com stable non-free" | sudo tee /etc/apt/sources.list.d/spotify.list',
//                'sudo apt-get update -y',
//                'sudo apt-get install spotify-client -y'
//            ]
//        ]);


        PardusApp::create([
            'name' => 'Spotify',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/1/19/Spotify_logo_without_text.svg",
            'scripts' => [
                'sudo apt-get install spotify-client -y'
            ]
        ]);

        PardusApp::create([
            'name' => 'Audacity',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/f/f6/Audacity_Logo.svg",
            'scripts' => ['sudo apt-get install audacity -y']
        ]);
        PardusApp::create([
            'name' => 'Vlc Player',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/VLC_Icon.svg/1200px-VLC_Icon.svg.png",
            'scripts' => ['sudo apt-get install vlc -y']
        ]);
        PardusApp::create([
            'name' => 'Gimp',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/4/45/The_GIMP_icon_-_gnome.svg",
            'scripts' => [
                "sudo apt-get install gimp -y",
            ]
        ]);

        PardusApp::create([
            'name' => 'Krita',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/7/73/Calligrakrita-base.svg",
            'scripts' => ["sudo apt-get install krita -y"]
        ]);

        PardusApp::create([
            'name' => 'Okular',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/f/fc/Breezeicons-apps-48-okular.svg",
            'scripts' => ["sudo apt install okular -y",]
        ]);
        PardusApp::create([
            'name' => 'Evince',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/9/9b/GNOME_Document_Viewer_icon_2019.svg",
            'scripts' => ["sudo apt-get install evince -y",]
        ]);

        PardusApp::create([
            'name' => 'Git',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/3/3f/Git_icon.svg",
            'scripts' => [
                "sudo apt-get install git -y",
            ]
        ]);

        PardusApp::create([
            'name' => 'Git Cola',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/a/a6/Breezeicons-apps-48-git-cola.svg",
            'scripts' => [
                "sudo apt-get install git-cola -y",
            ]
        ]);

        PardusApp::create([
            'name' => 'Git Kraken',
            'image_url' => "https://www.gitkraken.com/downloads/brand-assets/gitkraken-logo-dark-sq.svg",
            'scripts' => [
                "sudo wget https://release.gitkraken.com/linux/gitkraken-amd64.deb",
                "sudo dpkg -i gitkraken-amd64.deb",
                "sudo rm -f gitkraken-amd64.deb",
            ]
        ]);

        PardusApp::create([
            'name' => 'QBittorrent',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/6/66/New_qBittorrent_Logo.svg",
            'scripts' => [
                "sudo apt install qbittorrent -y",
            ]
        ]);

        PardusApp::create([
            'name' => 'Telegram',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/8/83/Telegram_2019_Logo.svg",
            'scripts' => [
                "sudo apt install telegram-desktop -y",
            ]
        ]);
        PardusApp::create([
            'name' => 'Discord',
            'image_url' => "https://discord.com/assets/f8389ca1a741a115313bede9ac02e2c0.svg",
            'scripts' => [
                'sudo wget -O ~/discord.deb "https://discordapp.com/api/download?platform=linux&format=deb"',
                'sudo apt --fix-broken install ~/discord.deb -y',
                'sudo rm -f ~/discord.deb',
            ]
        ]);

//        PardusApp::create([
//            'name' => 'Zoom',
//            'image_url' => "https://seeklogo.com/images/Z/zoom-fondo-azul-vertical-logo-8246E36E95-seeklogo.com.png",
//            'scripts' => [
//                'sudo wget https://zoom.us/client/latest/zoom_amd64.deb',
//                'sudo apt --fix-broken install ~/zoom_amd64.deb -y',
//                'sudo rm -f zoom_amd64.deb',
//            ]
//        ]);

        PardusApp::create([
            'name' => 'Zoom',
            'image_url' => "https://seeklogo.com/images/Z/zoom-fondo-azul-vertical-logo-8246E36E95-seeklogo.com.png",
            'scripts' => ['sudo apt install zoom -y']
        ]);
        PardusApp::create([
            'name' => 'Visual Studio Code (VS CODE)',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/9/9a/Visual_Studio_Code_1.35_icon.svg",
            'scripts' => [
                'sudo wget -O ~/vscode.deb https://go.microsoft.com/fwlink/?LinkID=760868',
                'sudo apt --fix-broken install ~/vscode.deb -y',
                'sudo rm -f ~/vscode.deb',
            ]
        ]);

        PardusApp::create([
            'name' => 'Docker',
            'image_url' => "https://cdn.worldvectorlogo.com/logos/docker.svg",
            'scripts' => [
                'sudo apt install docker.io -y',
                'sudo systemctl start docker',
                'sudo systemctl enable docker',
            ]
        ]);


        PardusApp::create([
            'name' => 'Docker Compose',
            'image_url' => "https://bidhankhatri.com.np/assets/images/docker-compose.jpg",
            'scripts' => [
                'sudo apt install curl -y',
                'sudo curl -L "https://github.com/docker/compose/releases/download/1.29.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose',
                'sudo chmod +x /usr/local/bin/docker-compose',
            ]
        ]);

        PardusApp::create([
            'name' => 'Libre Office',
            'image_url' => "https://logos-download.com/wp-content/uploads/2020/06/LibreOffice_Logo_2.png",
            'scripts' => ['sudo apt install libreoffice -y',]
        ]);

        PardusApp::create([
            'name' => 'Gedit',
            'image_url' => "https://gitlab.gnome.org/GNOME/gedit/raw/master/data/icons/org.gnome.gedit.svg",
            'scripts' => ['sudo apt install gedit -y']
        ]);

        PardusApp::create([
            'name' => 'Mozilla Firefox',
            'image_url' => "https://www.mozilla.org/media/protocol/img/logos/firefox/browser/logo.eb1324e44442.svg",
            'scripts' => ['( sudo apt install firefox-esr -y || sudo apt install firefox -y)']
        ]);

        PardusApp::create([
            'name' => 'Chromium',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/f/f3/Chromium_Material_Icon.png",
            'scripts' => ['sudo apt install chromium -y']
        ]);

        PardusApp::create([
            'name' => 'Mozilla Thunderbird',
            'image_url' => "http://upload.turkcewiki.org/wikipedia/commons/thumb/e/e1/Thunderbird_Logo%2C_2018.svg/1200px-Thunderbird_Logo%2C_2018.svg.png",
            'scripts' => ['sudo apt install thunderbird -y']
        ]);

        PardusApp::create([
            'name' => 'Kdenlive',
            'image_url' => "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/Kdenlive-logo.svg/1280px-Kdenlive-logo.svg.png",
            'scripts' => ['sudo apt install kdenlive -y']
        ]);

        PardusApp::create([
            'name' => 'OpenShot',
            'image_url' => "https://w1.pngwing.com/pngs/392/185/png-transparent-openshot-personal-protective-equipment-video-editing-software-free-and-opensource-software-film-editing-nonlinear-editing-system-macos-avs-video-editor-computer-software-thumbnail.png",
            'scripts' => [
                'sudo apt-get install openshot-qt -y'
            ]
        ]);

        PardusApp::create([
            'name' => 'Python',
            'image_url' => "https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/267_Python_logo-512.png",
            'scripts' => [
                'sudo apt-get install python3 -y',
            ]
        ]);

        PardusApp::create([
            'name' => 'PIP (Python Paket Yöneticisi)',
            'image_url' => "https://banner2.cleanpng.com/20190124/rs/kisspng-python-selenium-programming-language-computer-icon-pip-5c4a4a7ca92d33.171618491548372604693.jpg",
            'scripts' => [
                'sudo apt install python3-pip -y',
            ]
        ]);
    }
}
