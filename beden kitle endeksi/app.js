document.getElementById("bmiForm").addEventListener("submit", function(event) {
    event.preventDefault(); 

    let kilo = Number(document.getElementById("weight").value);
    let boy = Number(document.getElementById("height").value);

    boy = boy / 100; 

    let sonuc = kilo / (boy * boy);

    let mesaj = "";
    if (sonuc < 18.5) {
        mesaj = "İdeal kilonun altında";
    } else if (sonuc >= 18.5 && sonuc <= 24.9) {
        mesaj = "İdeal kilo";
    } else if (sonuc >= 25 && sonuc <= 29.9) {
        mesaj = "İdeal kilonun üstünde";
    } else if (sonuc >= 30 && sonuc <= 39.9) {
        mesaj = "İdeal kilonun çok üstünde Obez(I)";
    } else if (sonuc >= 40) {
        mesaj = "İdeal kilonun çok üstünde Obez(II)";
    }
    document.getElementById("result").textContent = mesaj + " (BMI: " + sonuc.toFixed(2) + ")";
});
