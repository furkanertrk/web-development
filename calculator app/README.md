# Hesap Makinesi Uygulaması

Bu proje, HTML, CSS ve JavaScript kullanılarak oluşturulmuş basit bir web tabanlı hesap makinesidir. Temel aritmetik işlemleri yapabilir.

## Özellikler

- Toplama, çıkarma, çarpma ve bölme işlemleri.
- Ekranı temizleme (C) fonksiyonu.
- Ondalık sayı desteği.
- Basit ve kullanıcı dostu arayüz.

## Nasıl Kullanılır?

1.  Bu repoyu klonlayın veya dosyaları indirin:
    ```
    git clone https://github.com/furkanertrk/web-development.git
    ```
2.  `calculator app` klasörüne gidin.
3.  `calculator.html` dosyasını herhangi bir web tarayıcısında açın.
4.  Hesap makinesini kullanmaya başlayın!

## Kod Açıklaması

-   **`calculator.html`**: Hesap makinesinin temel yapısını ve düğmelerini içerir. Her düğmenin tıklanma olayları (`onclick`) ilgili JavaScript fonksiyonlarına bağlanmıştır.
-   **`calculator.css`**: Hesap makinesinin görünümünü, renklerini ve düzenini biçimlendirir. `grid` yapısı kullanılarak düğmelerin yerleşimi sağlanmıştır.
-   **`calculator.js`**: Hesap makinesinin işlevselliğini yönetir.
    -   `display(value)`: Tıklanan düğmenin değerini hesap makinesi ekranına ekler.
    -   `calculate()`: Ekranda bulunan matematiksel ifadeyi `eval()` fonksiyonu kullanarak hesaplar ve sonucu ekrana yazdırır.
    -   `clearScreen()`: Hesap makinesi ekranını temizler.

**Not:** Bu proje, `eval()` fonksiyonunun potansiyel güvenlik riskleri nedeniyle sadece eğitim amaçlı basit bir örnektir. Gerçek dünya uygulamalarında daha güvenli hesaplama yöntemleri tercih edilmelidir.
