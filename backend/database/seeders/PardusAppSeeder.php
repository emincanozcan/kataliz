<?php

namespace Database\Seeders;

use App\Models\PardusApp;
use Illuminate\Database\Seeder;

class PardusAppSeeder extends Seeder
{
    public function setScript(string $name, array $scripts)
    {
        PardusApp::where('name', $name)->firstOrFail()->update([
            'scripts' => $scripts
        ]);
    }

    public function run()
    {
        $this->setScript('Spotify', ['sudo apt-get install spotify-client -y']);
        $this->setScript('Audacity', ['sudo apt-get install audacity -y']);
        $this->setScript('VLC Media Player', ['sudo apt-get install vlc -y']);
        $this->setScript('GIMP', ["sudo apt-get install gimp -y"]);
        $this->setScript('Krita', ["sudo apt-get install krita -y"]);
        $this->setScript('Okular', ["sudo apt-get install okular -y"]);
        $this->setScript('Evince', ["sudo apt-get install evince -y"]);
        $this->setScript('GitKraken', [
            "sudo wget https://release.gitkraken.com/linux/gitkraken-amd64.deb",
            "sudo dpkg -i gitkraken-amd64.deb",
            "sudo rm -f gitkraken-amd64.deb",
        ]);
        $this->setScript('qBittorrent', ["sudo apt-get install qbittorrent -y"]);
        $this->setScript('Telegram', ["sudo apt-get install telegram-desktop -y"]);
        $this->setScript('Zoom', ["sudo apt-get install zoom -y"]);
        $this->setScript('Discord', ["sudo apt-get install discord -y"]);
        $this->setScript('Visual Studio Code', ["sudo apt-get install code -y"]);
        $this->setScript('Docker', [
            'sudo apt install docker.io -y',
            'sudo systemctl start docker',
            'sudo systemctl enable docker',
            'sudo apt install curl -y',
            'sudo curl -L "https://github.com/docker/compose/releases/download/1.29.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose',
            'sudo chmod +x /usr/local/bin/docker-compose',
        ]);
        $this->setScript('LibreOffice', ["sudo apt-get install libreoffice -y"]);
        $this->setScript('gedit', ["sudo apt-get install gedit -y"]);
        $this->setScript('Mozilla Firefox', ['( sudo apt install firefox-esr -y || sudo apt install firefox -y)']);
        $this->setScript('Chromium', ["sudo apt-get install chromium -y"]);
        $this->setScript('Thunderbird', ["sudo apt-get install thunderbird -y"]);
        $this->setScript('Kdenlive', ["sudo apt-get install kdenlive -y"]);
        $this->setScript('OpenShot', ["sudo apt-get install openshot-qt -y"]);
        $this->setScript('Python', ["sudo apt-get install python3 -y"]);
        $this->setScript('Dropbox', ["sudo apt-get install dropbox -y"]);
        $this->setScript('TeamViewer', ["sudo apt-get install teamviewer -y"]);
        $this->setScript('VirtualBox', ["sudo apt-get install virtualbox -y"]);
        $this->setScript('Sublime Text', ["sudo apt-get install sublime-text -y"]);
        $this->setScript('FileZilla', ["sudo apt-get install filezilla -y"]);
        $this->setScript('Opera', ["sudo apt-get install opera-stable -y"]);
        $this->setScript('HandBrake', ["sudo apt-get install handbrake -y"]);
        $this->setScript('Pidgin', ["sudo apt-get install pidgin -y"]);
        $this->setScript('KeePass', ["sudo apt-get install keepass2 -y"]);
        $this->setScript('Transmission', ["sudo apt-get install transmission -y"]);
        $this->setScript('Blender', ["sudo apt-get install blender -y"]);
        $this->setScript('PuTTY', ["sudo apt-get install putty -y"]);
        $this->setScript('Kodi', ["sudo apt-get install kodi -y"]);
        $this->setScript('Vim', ["sudo apt-get install vim -y"]);
        $this->setScript('calibre', ["sudo apt-get install calibre -y"]);
        $this->setScript('Atom', ["sudo apt-get install atom -y"]);
        $this->setScript('Vivaldi', ["sudo apt-get install vivaldi-stable -y"]);
        $this->setScript('GParted', ["sudo apt-get install gparted -y"]);
        $this->setScript('ownCloud', ["sudo apt-get install owncloud-client -y"]);
    }
}
