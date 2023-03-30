# Garanti BBVA Php Kütüphanesi
Bu kütüphane ile garanti bbva apileri ile banka hesabınızla ilgili para giriş çıkışını veya hesap bakiyesi gibi işlemleri yapabilirsiniz.

## Nasıl kurulur?
```shell
composer require hasokeyk/garanti-bbva-php
```

Yukarıdaki komutu kullarak kütüphaneyi projenize dahil edebilirsiniz.

## Ne amaçla kullanılır?
Crm yazılımlarınızda havale ile gelecek olan para girişlerini, muhasebesel olarak eşleştirebilirsiniz.

## Nasıl kullanılır?

1. https://developers.garantibbva.com.tr/ websitesine girin ve kayıt olun.
2. https://developers.garantibbva.com.tr/admin/app/applications bu linke girin ve yeni bir uygulama oluşturun.

### Details Sekmesi

Application Name : İstediğiniz ismi verebilirsiniz.

### Custom Fields Sekmesi

Platform : Hybrid seçmelisiniz. Böylece tüm platformlarda kullanabilirsiniz.

### Api Management Sekmesi

Bu kısımda kullanacağınız API lere erişim izni alıyorsunuz. 

Account Information : Hesap bakiye bilgisi
Account Trancations : Hesaba para giriş çıkış bilgisi

Diğer API'ları inceleyebilirsiniz.

### Authentication Sekmesi

Callback/Redirect URL(s) : Bu kısma web sitenizin altında bulunan ve verialabilen bir php dosyası koymalsınız.

Örnek 

```php
<?php
 
    $json = file_get_contents("php://input");
    
    echo $json;
```

Scope : Bu kısma sadece "oob" tırnaklar hariç yazmalsınız.

Type : Garanti yetkilileri "Confidential" seçmenizi tavsiye ediyor.

### Key sekmesi

Burada zaten client id ve client secret bilgileriniz var. Save butonuna basıp onay bekliyorsunuz. Manuel onaylanmayan uygulamalar 1 saat sonra otomatik onaylanıyorlar.


# Peki Garanti BBVA banka hesabı ile nasıl eşleştiririm?

Kişisel hesaplarınız maalesef ki kullanamıyorsunuz. Kurumsal hesaplarınızı kullanabilirsiniz. 

1. Kurumsal hesabınızla garanti online işlemlere girin.
2. Üst menüden "Başvur" menüsünün üstün gelin ve "Elektronik Hesap Özeti (EHÖ)" menüsüne tıklayın.
3. Açılan sayfada sizden client_id isteyecektir. Uygulamanızda oluşturduğunuz client_id yi buraya girin. 36 haneli bir id olması lazım eğer size verilen client_id 34 hane ise başına 0 eklerek 36 hane ile tamamlayın.
4. Yeni açılan ekranda hangi hesaplara erişim vereceğinizi seçmelisiniz.
5. Şimdi geldik benide şoka uğratan bölüme. Aylık 194tl ye bu api hizmetini kullanabiliyorsunuz. Bu garanti bankasının sizden aylık olarak keseceği para. Bu işlemide geçince başvurunu alınacak ve size consentId tanımlanacak. 
6. Bu consentId ile kütüphaneyi kullanarak bilgileri alabilirsiniz.


