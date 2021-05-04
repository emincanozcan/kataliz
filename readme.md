# Pardus Kataliz!

## Nedir?

Pardus Kataliz, Pardus'a geçiş planlayan kullanıcılar düşünülerek tasarlanmış bir uygulama mağazasıdır.

## İsmi Neden Kataliz?
Kataliz; katalizor adı verilen kimyasalların, bir kimyasal tepkime için ihtiyaç duyulan enerjiyi düşürmesi ve tepkime sürecini ciddi anlamda hızlandırması işlemine denir.

Geliştirilen uygulama mağazasının hedefi; Pardus'a geçiş planlayan kullanıcıların, Pardus uygulama arayış ve kurulum süreçlerine harcayacakları enerjiyi azaltmak ve süreci hızlandırmak olduğundan kataliz ismi tercih edilmiştir. 

## Yazılım Detayları

Pardus Kataliz projesi; bir adet Pardus uygulaması, Pardus uygulamasından türetilen ve pek çok özelliğini birebir karşılayan bir web uygulaması ve bu uygulamalara veri sağlayan bir yönetim panelinden oluşur.

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

## Pardus Uygualaması

## Web Uygulaması

Devamı gelecek...