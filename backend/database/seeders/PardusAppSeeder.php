<?php

namespace Database\Seeders;

use App\Models\PardusApp;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Seeder;

class PardusAppSeeder extends Seeder
{
    protected function setScript(string $name, array $scripts)
    {
        try {
            PardusApp::where('name', $name)->firstOrFail()->update([
                'scripts' => $scripts
            ]);
        } catch (ModelNotFoundException $model) {
            echo "Record not found for: " . $name;
        }
    }

    protected function ondokuzon($name, $packageName)
    {
        $this->setScript($name, ['sudo apt-get install ' . $packageName . ' -y']);
    }

    protected function snap($name, $packageName)
    {
        $this->setScript($name, [
            'sudo apt install snapd -y',
            'sudo snap install ' . $packageName . ' --classic'
        ]);
    }

    protected function wgetDeb(string $name, string $fileName, string $wgetUrl, array $preInstallCommands = [])
    {
        $this->setScript($name, array_merge($preInstallCommands, [
            'wget -O ' . $fileName . ' ' . $wgetUrl,
            'sudo apt install ./' . $fileName . ' -y',
            'rm -f ' . $fileName
        ]));
    }

    protected function makeInstallationSame($mainName, $otherName)
    {
        $this->setScript($otherName, PardusApp::where('name', $mainName)->firstOrFail()->scripts);
    }

    public function run()
    {
        $this->setScript('Signal', [
            "wget -O- https://updates.signal.org/desktop/apt/keys.asc | gpg --dearmor > signal-desktop-keyring.gpg",
            "cat signal-desktop-keyring.gpg | sudo tee -a /usr/share/keyrings/signal-desktop-keyring.gpg > /dev/null",
            "echo 'deb [arch=amd64 signed-by=/usr/share/keyrings/signal-desktop-keyring.gpg] https://updates.signal.org/desktop/apt xenial main' | sudo tee -a /etc/apt/sources.list.d/signal-xenial.list",
            "sudo apt update && sudo apt install signal-desktop -y"
        ]);

        $this->setScript('Docker', [
            'sudo apt install docker.io -y',
            'sudo systemctl start docker',
            'sudo systemctl enable docker',
            'sudo apt install curl -y',
            'sudo curl -L "https://github.com/docker/compose/releases/download/1.29.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose',
            'sudo chmod +x /usr/local/bin/docker-compose',
        ]);
        $this->setScript('ParseHub', [
            'apt install curl -y',
            'curl -L https://parsehub.com/static/client/parsehub.tar.gz | tar -xzf - -C /tmp',
            'sudo mv /tmp/parsehub /opt/',
            'sudo ln -s /opt/parsehub/parsehub /usr/local/bin/',
            'rm -f parsehub.tar.gz'
        ]);

        $this->setScript('DBeaver', [
            "wget -O - https://dbeaver.io/debs/dbeaver.gpg.key | sudo apt-key add -",
            'echo "deb https://dbeaver.io/debs/dbeaver-ce /" | sudo tee /etc/apt/sources.list.d/dbeaver.list',
            "sudo apt update",
            "sudo apt -y install dbeaver-ce",
        ]);

        $this->setScript('Mozilla Firefox', ['( sudo apt install firefox-esr -y || sudo apt install firefox -y)']);

        $this->wgetDeb('Vagrant', 'vagrant.deb', 'https://releases.hashicorp.com/vagrant/2.2.9/vagrant_2.2.9_x86_64.deb');
        $this->wgetDeb('Angry IP Scanner', 'angryip.deb', 'https://github.com/angryip/ipscan/releases/download/3.7.6/ipscan_3.7.6_amd64.deb');
        $this->wgetDeb('Insomnia REST Client', 'insomnia.deb', 'https://updates.insomnia.rest/downloads/ubuntu/latest?&app=com.insomnia.app&source=website');
        $this->wgetDeb('Google Chrome', 'chrome.deb', 'https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb');
        $this->wgetDeb('GitKraken', 'gitkraken.deb', 'https://release.gitkraken.com/linux/gitkraken-amd64.deb');
        $this->wgetDeb('SmartGit', 'smartgit.deb', 'https://www.syntevo.com/downloads/smartgit/smartgit-20_2_5.deb');
        $this->wgetDeb('Steam', 'steam.deb', 'https://media.steampowered.com/client/installer/steam.deb', [
            "sudo dpkg --add-architecture i386",
            'sudo apt update',
            "sudo apt install libgl1-mesa-glx:i386 -y",
        ]);


        $this->ondokuzon('Spotify', 'spotify-client');
        $this->ondokuzon('Audacity', 'audacity');
        $this->ondokuzon('VLC Media Player', 'vlc');
        $this->ondokuzon('GIMP', 'gimp');
        $this->ondokuzon('Krita', 'krita');
        $this->ondokuzon('Okular', 'okular');
        $this->ondokuzon('Evince', 'evince');
        $this->ondokuzon('qBittorrent', 'qbittorrent');
        $this->ondokuzon('Telegram', 'telegram-desktop');
        $this->ondokuzon('Zoom', 'zoom');
        $this->ondokuzon('Discord', 'discord');
        $this->ondokuzon('Visual Studio Code', 'code');
        $this->ondokuzon('LibreOffice', 'libreoffice');
        foreach (["LibreOffice - Writer", "LibreOffice - Calc", "LibreOffice - Draw", "LibreOffice - Impress", "LibreOffice - Base", "LibreOffice - Math",] as $childOfLibre) {
            $this->makeInstallationSame('LibreOffice', $childOfLibre);
        }
        $this->ondokuzon('gedit', 'gedit');
        $this->ondokuzon('Chromium', 'chromium');
        $this->ondokuzon('Thunderbird', 'thunderbird');
        $this->ondokuzon('Kdenlive', 'kdenlive');
        $this->ondokuzon('OpenShot', 'openshot-qt');
//        $this->$this->ondokuzon('Python', 'python3');
        $this->ondokuzon('Dropbox', 'dropbox');
        $this->ondokuzon('TeamViewer', 'teamviewer');
        $this->ondokuzon('VirtualBox', 'virtualbox6.1');
        $this->ondokuzon('Sublime Text', 'sublime-text');
        $this->ondokuzon('FileZilla', 'filezilla');
        $this->ondokuzon('Opera', 'opera-stable');
        $this->ondokuzon('Git', 'git');
        $this->ondokuzon('HandBrake', 'handbrake');
        $this->ondokuzon('Pidgin', 'pidgin');
        $this->ondokuzon('KeePass', 'keepass2');
        $this->ondokuzon('Transmission', 'transmission');
        $this->ondokuzon('Blender', 'blender');
        $this->ondokuzon('PuTTY', 'putty');
        $this->ondokuzon('Kodi', 'kodi');
        $this->ondokuzon('Vim', 'vim');
        $this->ondokuzon('calibre', 'calibre');
        $this->ondokuzon('Atom', 'atom');
        $this->ondokuzon('Vivaldi', 'vivaldi-stable');
        $this->ondokuzon('GParted', 'gparted');
        $this->ondokuzon('ownCloud', 'owncloud-client');
//        $this->ondokuzon('Wireshark', 'wireshark');  # it broke process because of questions..
        $this->ondokuzon('Slack', 'slack-desktop');
        $this->ondokuzon('Nextcloud', 'nextcloud-desktop');
        $this->ondokuzon('Apache NetBeans', 'netbeans');
        $this->ondokuzon('Clementine', 'clementine');
        $this->ondokuzon('Deluge', 'deluge');
        $this->ondokuzon('Launchy', 'launchy');
        $this->ondokuzon('Tor Browser', 'torbrowser-launcher');
        $this->ondokuzon('Wine', 'wine');
        $this->ondokuzon('FLAC', 'flac');
        $this->ondokuzon('Brave', 'brave-browser');
        $this->ondokuzon('BleachBit', 'bleachbit');
        $this->ondokuzon('Geany', 'geany');
        $this->ondokuzon('Syncthing', 'syncthing');
        $this->ondokuzon('Double Commander', 'doublecmd-qt');
        $this->ondokuzon('Anki', 'anki');
        $this->ondokuzon('FFmpeg', 'ffmpeg');
        $this->ondokuzon('Zim', 'zim');
        $this->ondokuzon('Mumble', 'mumble');
        $this->ondokuzon('Dia', 'dia');
        $this->ondokuzon('Rhythmbox', 'rhythmbox');
        $this->ondokuzon('SMPlayer', 'smplayer');
        $this->ondokuzon('Wget', 'wget');
        $this->ondokuzon('Godot Engine', 'godot3');
        $this->ondokuzon('DOSBox', 'dosbox');
        $this->ondokuzon('Meld', 'meld');
        $this->ondokuzon('MPV', 'mpv');
        $this->ondokuzon('GNU Emacs', 'emacs');
        $this->ondokuzon('GnuCash', 'gnucash');
        $this->ondokuzon('MusicBrainz Picard', 'picard');
        $this->ondokuzon('Scribus', 'scribus');
        $this->ondokuzon('TestDisk', 'testdisk');
//        $this->ondokuzon('Tiny Tiny RSS', 'tt-rss');  # it broke process because of questions..
        $this->ondokuzon('AnyDesk', 'anydesk');
        $this->ondokuzon('Viber', 'viber');
        $this->ondokuzon('Stellarium', 'stellarium');
        $this->ondokuzon('HTTrack', 'httrack');
        $this->ondokuzon('LAME', 'lame');
        $this->ondokuzon('FreeCAD', 'freecad');
        $this->ondokuzon('Brasero', 'brasero');
        $this->ondokuzon('KeePassXC', 'keepassxc');
        $this->ondokuzon('digiKam', 'digikam');
        $this->ondokuzon('Nmap', 'nmap');
        $this->ondokuzon('SpeedCrunch', 'speedcrunch');
        $this->ondokuzon('Code::Blocks', 'codeblocks');
        $this->ondokuzon('Audacious', 'audacious');
        $this->ondokuzon('Redshift', 'redshift');
        $this->ondokuzon('Sweet Home 3D', 'sweethome3d');
        $this->ondokuzon('Pinta', 'pinta');
        $this->ondokuzon('PlayOnLinux', 'playonlinux');
        $this->ondokuzon('darktable', 'darktable');
        $this->ondokuzon('Android Studio', 'android-studio');
        $this->ondokuzon('Midnight Commander', 'mc');
        $this->ondokuzon('Freeplane', 'freeplane');
        $this->ondokuzon('CopyQ', 'copyq');
        $this->ondokuzon('HexChat', 'hexchat');
        $this->ondokuzon('FBReader', 'fbreader');
        $this->ondokuzon('Baobab Disk Usage Analyzer', 'baobab');
        $this->ondokuzon('FocusWriter', 'focuswriter');
        $this->ondokuzon('GoldenDict', 'goldendict');
        $this->ondokuzon('PDFsam', 'pdfsam');
//        $this->ondokuzon('Ardour', 'ardour'); # it broke process because of questions..
        $this->ondokuzon('MuseScore', 'musescore');
        $this->ondokuzon('MKVToolnix', 'mkvtoolnix-gui');
        $this->ondokuzon('I2P', 'i2p');
        $this->ondokuzon('LyX', 'lyx');
        $this->ondokuzon('Workrave', 'workrave');
        $this->ondokuzon('Remmina', 'remmina');
        $this->ondokuzon('Shotwell', 'shotwell');
        $this->ondokuzon('Zulip', 'zulip');
        $this->ondokuzon('QuiteRSS', 'quiterss');
        $this->ondokuzon('Jami', 'jami');
        $this->ondokuzon('uGet', 'uget');
        $this->ondokuzon('Compiz', 'compiz');
        $this->ondokuzon('Synaptic', 'synaptic');
        $this->ondokuzon('Conky', 'conky');
        $this->ondokuzon('Bluefish Editor', 'bluefish');
        $this->ondokuzon('Liferea', 'liferea');
        $this->ondokuzon('Falkon', 'falkon');
        $this->ondokuzon('KDE Connect', 'kdeconnect');
        $this->ondokuzon('SageMath', 'sagemath');
        $this->ondokuzon('Task Coach', 'taskcoach');
        $this->ondokuzon('Mixxx', 'mixxx');
        $this->ondokuzon('SimpleScreenRecorder', 'simplescreenrecorder');
        $this->ondokuzon('Thunar', 'thunar');
        $this->ondokuzon('GeoGebra', 'geogebra');
        $this->ondokuzon('Franz', 'franz');
        $this->ondokuzon('Skype', 'skypeforlinux');
        $this->ondokuzon('OBS Studio', 'obs-studio');

        $this->ondokuzon('Node.js', 'nodejs');
        $this->ondokuzon('Java', 'default-jdk');
        $this->ondokuzon('Scala', 'scala');
        $this->ondokuzon('Python', 'python3');
        $this->ondokuzon('Lua', 'lua5.3');
        $this->ondokuzon('R (programming language)', 'r-base');
        $this->ondokuzon('Perl', 'perl');
        $this->ondokuzon('Go (Programming Language)', 'perl');
        $this->ondokuzon('Ruby', 'ruby-full');
        $this->ondokuzon('Rust', 'rustc');

        $this->ondokuzon('Flameshot', 'flameshot');
        $this->ondokuzon('Ferdi', 'ferdi');
        $this->ondokuzon('Olive Video Editor', 'olive-editor');
        $this->ondokuzon('Kazam', 'kazam');
        $this->ondokuzon('Arduino IDE', 'arduino');
        $this->ondokuzon('Geary', 'geary');
        $this->ondokuzon('PiTiVi', 'pitivi');
        $this->ondokuzon('Spyder', 'spyder3');
        $this->ondokuzon('PyCharm', 'pycharm');

        $this->snap('Shotcut', 'shotcut');
        $this->snap('Typora', 'typora');
        $this->snap('WebStorm', 'webstorm');
        $this->snap('PhpStorm', 'phpstorm');
        $this->snap('DataGrip', 'datagrip');
        $this->snap('IntelliJ IDEA', 'intellij-idea-ultimate');

//        [ "C++", "C (programming language)", "C#","PHP", "Go (Programming Language)",  ]
    }
}
