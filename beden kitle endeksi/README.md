# Beden Kitle Endeksi (BMI) Hesaplayıcı

Bu proje, HTML, CSS ve JavaScript kullanılarak geliştirilmiş basit bir Beden Kitle Endeksi (BMI) hesaplama uygulamasıdır. Kullanıcıların boy ve kilo bilgilerini girerek BMI değerlerini hesaplamasına ve bu değere göre hangi kategoride olduklarını (zayıf, normal, fazla kilolu vb.) görmesine olanak tanır.

## Özellikler

- Boy (cm) ve kilo (kg) girişi.
- Anında BMI hesaplaması.
- Hesaplanan BMI değerine göre sağlık durumu kategorilendirmesi.
- Duyarlı ve kullanıcı dostu arayüz.

## Nasıl Kullanılır?

1.  Bu repoyu klonlayın veya dosyaları indirin:
    ```bash
    git clone https://github.com/furkanertrk/web-development.git
    ```
2.  `beden kitle endeksi` klasörüne gidin.
3.  `index.html` dosyasını herhangi bir modern web tarayıcısında açın.
4.  Gerekli alanlara boy ve kilo bilgilerinizi girin ve "Hesapla" düğmesine tıklayın.
5.  BMI sonucunuzu ve sağlık kategorinizi göreceksiniz.

## Kod Açıklaması

-   **`index.html`**: Uygulamanın temel HTML yapısını, başlığı, boy ve kilo giriş alanlarını ve "Hesapla" düğmesini içerir. Sonucun gösterileceği bir alan da bulunmaktadır.
-   **`style.css`**: Uygulamanın görsel stilini tanımlar. Form elemanlarının, düğmelerin ve genel düzenin responsive ve estetik bir görünüm kazanmasını sağlar.
-   **`app.js`**: Uygulamanın ana JavaScript mantığını içerir.
    -   Form gönderildiğinde (`submit` eventi) sayfanın yeniden yüklenmesini engeller (`event.preventDefault()`).
    -   Kullanıcının girdiği boy ve kilo değerlerini alır.
    -   Boyu santimetreden metreye çevirir (boy / 100).
    -   BMI formülünü (`kilo / (boy * boy)`) kullanarak BMI değerini hesaplar.
    -   Hesaplanan BMI değerine göre ilgili sağlık kategorisi mesajını belirler (İdeal kilonun altında, İdeal kilo, İdeal kilonun üstünde, Obez vb.).
    -   Sonucu ve BMI değerini `result` id'li HTML elemanına yazdırır.

## BMI Kategorileri

-   **< 18.5**: İdeal kilonun altında
-   **18.5 - 24.9**: İdeal kilo
-   **25 - 29.9**: İdeal kilonun üstünde
-   **30 - 39.9**: İdeal kilonun çok üstünde Obez(I)
-   **>= 40**: İdeal kilonun çok üstünde Obez(II)
