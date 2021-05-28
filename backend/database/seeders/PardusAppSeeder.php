<?php

namespace Database\Seeders;

use App\Models\PardusApp;
use Illuminate\Database\Seeder;

class PardusAppSeeder extends Seeder
{
    protected function setScript(string $name, array $scripts)
    {
        PardusApp::where('name', $name)->firstOrFail()->update([
            'scripts' => $scripts
        ]);
    }

    protected function ondokuzon($name, $packageName)
    {
        $this->setScript($name, ['sudo apt-get install ' . $packageName . ' -y']);
    }

    public function run()
    {

        $this->setScript('GitKraken', [
            "sudo wget https://release.gitkraken.com/linux/gitkraken-amd64.deb",
            "sudo dpkg -i gitkraken-amd64.deb",
            "sudo rm -f gitkraken-amd64.deb",
        ]);

        $this->setScript('Docker', [
            'sudo apt install docker.io -y',
            'sudo systemctl start docker',
            'sudo systemctl enable docker',
            'sudo apt install curl -y',
            'sudo curl -L "https://github.com/docker/compose/releases/download/1.29.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose',
            'sudo chmod +x /usr/local/bin/docker-compose',
        ]);
        $this->setScript('Mozilla Firefox', ['( sudo apt install firefox-esr -y || sudo apt install firefox -y)']);

        $this->ondokuzon('Spotify','spotify-client');
        $this->ondokuzon('Audacity','audacity');
        $this->ondokuzon('VLC Media Player','vlc');
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
        $this->ondokuzon('Terminator', 'terminator');
        $this->ondokuzon('Conky', 'conky');
        $this->ondokuzon('Bluefish Editor', 'bluefish');
        $this->ondokuzon('Liferea', 'liferea');
        $this->ondokuzon('Falkon', 'falkon');
    }
}
