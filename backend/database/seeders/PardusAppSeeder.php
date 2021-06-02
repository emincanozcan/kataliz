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

    private function appImage($name, $downloadUrl)
    {
        $userName = '$(logname)';
        $appImagesFolder = '/home/' . $userName . '/kataliz-appimages';
        $appImagePath = $appImagesFolder . '/' . $name . '.AppImage';

        $desktopPath = '/usr/share/applications/' . $name . '.desktop';

        $this->setScript($name, [
            "sudo mkdir -p $appImagesFolder",
            "sudo wget -O $appImagePath $downloadUrl",
            "sudo chown $userName:$userName $appImagePath",
            "sudo chmod +x $appImagePath",
            "sudo tee $desktopPath <<EOF
#!/usr/bin/env xdg-open
[Desktop Entry]
Type=Application
Name=$name
Exec=$appImagePath
EOF
echo 'Tee ok.'",
            "sudo chmod +x $desktopPath",
            "sudo chown $userName:$userName $desktopPath",
        ]);
    }

    protected function ondokuzon($name, $packageName)
    {
        $this->setScript($name, ['sudo DEBIAN_FRONTEND=noninteractive apt-get install ' . $packageName . ' -y']);
    }

    protected function snap($name, $packageName)
    {
        $this->setScript($name, [
            'sudo apt install snapd -y',
            'sudo snap install ' . $packageName . ' --classic'
        ]);
    }

    protected function wgetDeb(string $name, string $wgetUrl, array $preInstallCommands = [])
    {
        $fileName = md5($name) . '.deb';
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
            'sudo apt install curl -y',
            'curl -L https://parsehub.com/static/client/parsehub.tar.gz | tar -xzf - -C /tmp',
            'sudo mv /tmp/parsehub /opt/',
            'sudo ln -s /opt/parsehub/parsehub /usr/local/bin/',
            'rm -f parsehub.tar.gz'
        ]);

        $this->setScript('Celestia', [
            'sudo apt install curl -y',
            'curl https://celestia.space/packages/celestia.key | sudo apt-key add -',
            'echo deb https://celestia.space/packages buster main | sudo tee /etc/apt/sources.list.d/celestia.list',
            'sudo apt install celestia -y',
        ]);

        $this->setScript('Pale Moon', [
            'sudo apt install curl -y',
            "echo 'deb http://download.opensuse.org/repositories/home:/stevenpusser/Debian_9.0/ /' | sudo tee /etc/apt/sources.list.d/home:stevenpusser.list",
            'curl -fsSL https://download.opensuse.org/repositories/home:stevenpusser/Debian_9.0/Release.key | gpg --dearmor | sudo tee /etc/apt/trusted.gpg.d/home_stevenpusser.gpg > /dev/null',
            'sudo apt update',
            'sudo apt install palemoon'
        ]);

        $this->setScript('DBeaver', [
            "wget -O - https://dbeaver.io/debs/dbeaver.gpg.key | sudo apt-key add -",
            'echo "deb https://dbeaver.io/debs/dbeaver-ce /" | sudo tee /etc/apt/sources.list.d/dbeaver.list',
            "sudo apt update",
            "sudo apt -y install dbeaver-ce",
        ]);

        $this->setScript('Element', [
            "sudo apt install -y wget apt-transport-https",
            'sudo wget -O /usr/share/keyrings/riot-im-archive-keyring.gpg https://packages.riot.im/debian/riot-im-archive-keyring.gpg',
            'echo "deb [signed-by=/usr/share/keyrings/riot-im-archive-keyring.gpg] https://packages.riot.im/debian/ default main" | sudo tee /etc/apt/sources.list.d/riot-im.list',
            "sudo apt update",
            "sudo apt install element-desktop",
        ]);

        $this->setScript('Mozilla Firefox', ['( sudo apt install firefox-esr -y || sudo apt install firefox -y)']);

        $this->appImage('Cryptomator', "https://github.com/cryptomator/cryptomator/releases/download/1.5.15/cryptomator-1.5.15-x86_64.AppImage");
        $this->wgetDeb('Vagrant', 'https://releases.hashicorp.com/vagrant/2.2.9/vagrant_2.2.9_x86_64.deb');
        $this->wgetDeb('Angry IP Scanner', 'https://github.com/angryip/ipscan/releases/download/3.7.6/ipscan_3.7.6_amd64.deb');
        $this->wgetDeb('Insomnia REST Client', 'https://updates.insomnia.rest/downloads/ubuntu/latest?&app=com.insomnia.app&source=website');
        $this->wgetDeb('Google Chrome', 'https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb');
        $this->wgetDeb('GitKraken', 'https://release.gitkraken.com/linux/gitkraken-amd64.deb');
        $this->wgetDeb('SmartGit', 'https://www.syntevo.com/downloads/smartgit/smartgit-20_2_5.deb');
        $this->wgetDeb('4k Video Downloader', 'https://dl.4kdownload.com/app/4kvideodownloader_4.16.0-1_amd64.deb');
        $this->wgetDeb('Tixati', 'https://download2.tixati.com/download/tixati_2.83-1_amd64.deb');
        $this->wgetDeb('Trillian', 'https://www.trillian.im/get/linux/6.3/?deb=64');
        $this->wgetDeb('1Password', 'https://downloads.1password.com/linux/debian/amd64/stable/1password-latest.deb');
        $this->wgetDeb('PeaZip', 'https://github.com/peazip/PeaZip/releases/download/7.9.0/peazip_7.9.0.LINUX.x86_64.GTK2.deb');
        $this->wgetDeb('Bitwarden', 'https://github.com/bitwarden/desktop/releases/download/v1.26.4/Bitwarden-1.26.4-amd64.deb');
        $this->wgetDeb('VeraCrypt', 'https://launchpad.net/veracrypt/trunk/1.24-update7/+download/veracrypt-1.24-Update7-Debian-10-amd64.deb');
        $this->wgetDeb('MEGA', 'https://mega.nz/linux/MEGAsync/Debian_10.0/amd64/megasync_4.4.0-1.1_amd64.deb');
        $this->wgetDeb('Pencil Project', 'https://pencil.evolus.vn/dl/V3.1.0.ga/pencil_3.1.0.ga_amd64.deb');
        $this->wgetDeb('WPS Office', 'https://wdl1.pcfg.cache.wpscdn.com/wpsdl/wpsoffice/download/linux/10161/wps-office_11.1.0.10161.XA_amd64.deb');
        $this->wgetDeb('Mattermost', 'https://releases.mattermost.com/desktop/4.6.2/mattermost-desktop-4.6.2-linux-amd64.deb');
        $this->wgetDeb('ManicTime', 'https://cdn.manictime.com/setup/linux/v1_3_5_0/ManicTime.deb');
        $this->makeInstallationSame('WPS Office', 'WPS Writer');
        $this->wgetDeb('Steam', 'https://media.steampowered.com/client/installer/steam.deb', [
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
        $this->ondokuzon('Wireshark', 'wireshark');
        $this->ondokuzon('Slack', 'slack-desktop');
        $this->ondokuzon('Nextcloud', 'nextcloud-desktop');
        $this->ondokuzon('Apache NetBeans', 'netbeans');
        $this->ondokuzon('Clementine', 'clementine');
        $this->ondokuzon('Deluge', 'deluge');
        $this->ondokuzon('Launchy', 'launchy');
        $this->ondokuzon('Tor Browser', 'torbrowser-launcher');
        $this->makeInstallationSame('Tor Browser', 'Tor');
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
//        $this->ondokuzon('Tiny Tiny RSS', 'tt-rss');
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
        $this->ondokuzon('Ardour', 'ardour');
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
        $this->ondokuzon('AbiWord', 'abiword');
        $this->ondokuzon('CherryTree', 'cherrytree');
        $this->ondokuzon('TaskWarrior', 'taskwarrior');
        $this->ondokuzon('Taskade', 'taskade');
        $this->ondokuzon('LMMS', 'lmms');

        $this->snap('Shotcut', 'shotcut');
        $this->snap('Typora', 'typora');
        $this->snap('WebStorm', 'webstorm');
        $this->snap('PhpStorm', 'phpstorm');
        $this->snap('DataGrip', 'datagrip');
        $this->snap('IntelliJ IDEA', 'intellij-idea-ultimate');
        $this->snap('Eclipse', 'eclipse');
        $this->snap('scrcpy', 'scrcpy');
        $this->snap('Simplenote', 'simplenote');
        $this->snap('Standard Notes', 'standard-notes');
        $this->snap('ONLYOFFICE', 'onlyoffice-desktopeditors');

//        [ "C++", "C (programming language)", "C#","PHP", "Go (Programming Language)",  ]
    }
}
