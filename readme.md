# Pardus Kataliz!

## Nedir?

Pardus Kataliz, Pardus'a geçiş planlayan kullanıcılar düşünülerek tasarlanmış bir uygulama mağazasıdır. Kullanıcılara masaüstü uygulaması ve web sitesi olarak hem de hizmet sunar. Halihazırda Pardus işletim sistemini kurmuş olan kullanıcılar Kataliz Pardus uygulaması ile daha zengin bir deneyim elde ederken, Pardus'u henüz kurmamış kullanıcılar Kataliz web sürümü üzerinden pek çok özelliğe erişim sağlayaiblmekte ve Pardus'a geçiş yapmak için ön hazırlık gerçekleştirebilmektir. 

## İsmi Neden Kataliz?

Kataliz; katalizor adı verilen kimyasalların, bir kimyasal tepkime için ihtiyaç duyulan enerjiyi düşürmesi ve tepkime sürecini ciddi anlamda hızlandırması işlemine denir.

Geliştirilen uygulama mağazasının hedefi; kullanıcıların Pardus uygulama arayış - kurulum süreçlerine harcayacakları enerjiyi ve vakti azaltmak olduğundan, kataliz ismi tercih edilmiştir. 

## Yazılım Detayları / Geliştirme

Pardus Kataliz projesi; bir adet Pardus uygulaması, bir web uygulaması ve bu uygulamalara veri de sağlayan bir arka uçtan, yönetici panelinden oluşur.

Uygulamanın Pardus ve web versiyonları birlikte geliştirilebilir durumdadır; aynı kod tabanını paylaşmaktadır.

### Backend Servisi

Uygulamanın veri kaynağı olarak kullanılan bir API ve yönetim paneli sağlar. Laravel / Jetstream altyapısıyla hayata geçirilmiştir. Proje anadizininde yer alan backend klasörü üzerinden erişilebilir.

Yönetim Panelinde Bulunan Temel özellikler;
* Pardus uygulaması ekleyebilme
  * Uygulama adı
  * Uygulama görseli
  * Uygulama kurulum betikleri
* Pardus harici uygulama ekleyebilme
  * Uygulama adı
  * Uygulama görseli
  * Uygulamanın Pardus alternatifleri (Pardus uygulaması üstte belirtilen kriterlere göre eklenmiş olmalıdır.)
* Uygulama paketi oluşturabilme
  * Paket adı
  * Paket görseli
  * Paketin içerdiği Pardus uygulamaları (İlgili uygulamaların öncesinde Pardus uygulaması olarak eklenmesi gerekmektedir.) 

Projede geliştirme ortamı olarak Laravel Sail altyapısından faydalanılmaktadır. Farklı ortamlar üzerinde de geliştirilmesi sürdürülebilir ancak kullanım kolaylığı açısından Laravel Sail önerilmektedir. 

### Pardus ve Web Uygulaması

Kataliz'in Pardus uygulaması Electron - Vue alt yapısıyla hazırlanmaktadır. Pardus uygulaması ve Web uygulaması tek bir kod tabanı üzerinde geliştirilmektedir. Pardus uygulaması, Web uygulamasına ek olarak uygulama içerisinden kurulum desteği de sağlamaktadır. Pardus sürümünde yer alan bir takım özelliklerin devre dışı bırakılması veya Web'e uyarlanmasıyla Web sürümü ortaya çıkmaktadır.

İlgili uygulama(lar) proje kökdizini içerisinde client klasöründe konumlandırılmıştır. 

Projeyi geliştirme ortamında çalıştırabilmek ya da paketleyebilmek için;
  * İlk olarak `npm install` ya da `yarn` komutlarıyla bağımlılıklar indirilmeli,
  * Geliştirme ortamını ayağa kaldırmak için;
    * Masaüstü versiyonu için `yarn electron:serve` komutu
    * Web versiyonu için `yarn serve` komutu
  * Uygulamayı paketlemek için;
    * Masaüstü versiyonu için `yarn electron:build` komutu
    * Web versiyonu için `yarn build` komutu
kullanılabilmektedir.

Masaüstü uygulaması için paketleme işlemi çalıştırıldığında, appimage ve deb şeklinde iki farklı formatla uygulama paketlenir ve kullanıcıya sunulmaktadır.

### Canlı Test

Geliştirilen uygulamaya doğrudan erişim için;

* Masaüstü uygulaması; github üzerinden çeşitli versiyonlarla birlikte indirilmeye sunulmaktadır. https://github.com/emincanozcan/kataliz/releases adresi üzerinden indirilebilir.
* Web uygulaması; [kataliz.emincanozcan.com](https://kataliz.emincanozcan.com) adresi üzerinden yayınlanmaktadır, bu adres üzerinden incelenebilir.
* Arka uç ve yönetici paneli; [kataliz-admin.emincanozcan.com](https://kataliz-admin.emincanozcan.com) adresi üzerinden yayınlanmaktadır. İlgili yönetim paneline yetkisiz erişim, bu arka uca bağlanan uygulamalarda istenmeyen etkiler yaratabileceğinden yönetici bilgileri paylaşılmamaktadır. Yönetici erişimi için `emincanozcann@gmail.com` üzerinden iletişime geçilebilir.