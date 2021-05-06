# Pardus Kataliz!

## Nedir?

Pardus Kataliz, Pardus'a geçiş planlayan kullanıcılar düşünülerek tasarlanmış bir uygulama mağazasıdır. Kullanıcılara masaüstü uygulaması ve web sitesi olarak hizmet sunar. Halihazırda Pardus işletim sistemini kurmuş olan kullanıcılar Kataliz Pardus uygulaması ile daha zengin bir deneyim elde ederken, Pardus'u henüz kurmamış kullanıcılar Kataliz web sürümü üzerinden pek çok özelliğe erişim sağlayabilmekte ve Pardus'a geçiş yapmak için ön hazırlık gerçekleştirebilmektir. 

## İsmi Neden Kataliz?

Kataliz; katalizor adı verilen kimyasalların, bir kimyasal tepkime için ihtiyaç duyulan enerjiyi düşürmesi ve tepkime sürecini ciddi anlamda hızlandırması işlemine denir.

Geliştirilen uygulama mağazasının hedefi; kullanıcıların Pardus uygulama arayış - kurulum süreçlerine harcayacakları enerjiyi ve vakti azaltmak olduğundan, Kataliz ismi tercih edilmiştir. 

## Yazılım Detayları / Geliştirme

Pardus Kataliz projesi; bir adet Pardus uygulaması, bir adet web uygulaması ve istemcilerin veri kaynağı olarak kullandığı - yönetici paneli de barındıran bir arka uç uygulamasından bir oluşur.

Uygulamanın Pardus ve web versiyonları birlikte geliştirilmekte, aynı kod tabanını paylaşmaktadır.

### Arka Uç

Uygulamanın veri kaynağı olarak kullanılan bir API ve yönetim paneli sağlar. Laravel / Jetstream altyapısıyla hayata geçirilmiştir. Proje dizininde yer alan backend klasörü üzerinden erişilebilir.

Yönetim Panelinde Bulunan Temel özellikler;
* Pardus uygulaması ekleyebilme ve yönetebilme
  * Uygulama adı
  * Uygulama görseli
  * Uygulama kurulum betikleri
* Pardus harici uygulama ekleyebilme ve yönetebilme
  * Uygulama adı
  * Uygulama görseli
  * Uygulamanın Pardus ekosistemindeki alternatifleri
* Uygulama paketi ekleyebilme ve yönetebilme
  * Paket adı
  * Paket görseli
  * Pardus uygulamaları 

Arka uç için geliştirme ortamı olarak Laravel Sail altyapısından faydalanılmaktadır. Farklı ortamlar üzerinde de geliştirmeye devam edilebilir ancak Laravel Sail kullanımı önerilmektedir. Laravel Sail kullanımına dair detaylar [laravel.com/docs/8.x/sail](https://laravel.com/docs/8.x/sail) adresinden incelenebilir.

### Pardus ve Web Uygulaması

Kataliz'in Pardus uygulaması Electron - Vue alt yapısıyla hazırlanmaktadır. Pardus uygulaması ve Web uygulaması tek bir kod tabanı üzerinde geliştirilmektedir. Pardus uygulaması, Web uygulamasına ek olarak uygulama içerisinden kurulum desteği de sağlamaktadır. Pardus sürümünde yer alan bir takım özelliklerin devre dışı bırakılması veya Web'e uyarlanmasıyla Web sürümü ortaya çıkmaktadır.

İlgili uygulama(lar) proje içerisinde client klasöründe konumlandırılmıştır. 

Uygulamaları geliştirme ortamında çalıştırabilmek ya da paketleyebilmek için;
  * İlk olarak `npm install` ya da `yarn` komutlarıyla bağımlılıklar indirilmeli,
  * Geliştirme ortamını ayağa kaldırmak için;
    * Masaüstü versiyonu için `yarn electron:serve` komutu
    * Web versiyonu için `yarn serve` komutu
  * Uygulamayı paketlemek için;
    * Masaüstü versiyonu için `yarn electron:build` komutu
    * Web versiyonu için `yarn build` komutu
kullanılabilmektedir.

Masaüstü uygulaması için paketleme işlemi yapıldığında, appimage ve deb şeklinde iki farklı dosya formatıyla uygulama paketlenmekte ve kullanıcıya sunulmaktadır. 
* **Deb formatlı çıktı:** Pardus Paket Kurucu programıyla ya da alternatif metotlarla kurulum sağlamak için kullanılabilmektedir.
* **Appimage formatlı çıktı:** kurulum olmaksızın programı çalıştırmak için kullanılabilmektedir.

### Canlı Test

Geliştirilen uygulamaya doğrudan erişim için;

* Masaüstü uygulaması; github üzerinden çeşitli versiyonlarla birlikte indirilmeye sunulmaktadır. https://github.com/emincanozcan/kataliz/releases adresi üzerinden indirilebilir.
* Web uygulaması; [kataliz.emincanozcan.com](https://kataliz.emincanozcan.com) adresi üzerinden yayınlanmaktadır, bu adres üzerinden incelenebilir.
* Arka uç ve yönetici paneli; [kataliz-admin.emincanozcan.com](https://kataliz-admin.emincanozcan.com) adresi üzerinden yayınlanmaktadır. İlgili yönetim paneline yetkisiz erişim, bu arka uca bağlanan uygulamalarda istenmeyen etkiler yaratabileceğinden yönetici bilgileri paylaşılmamaktadır. Yönetici erişimi için `emincanozcann@gmail.com` üzerinden iletişime geçilebilir.