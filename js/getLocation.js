/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var listLatHome = document.getElementsByClassName('latHome');
for (var i = 0; i < listLatHome.length; i++) {
    listLatHome[i].value = getCookie("latHome");
}
var listLngHome = document.getElementsByClassName('lngHome');
for (var i = 0; i < listLngHome.length; i++) {
    listLngHome[i].value = getCookie("lngHome");
}


//Lấy tọa độ của máy hiện tại
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {

    var listLatHome = document.getElementsByClassName('latHome');
    for (var i = 0; i < listLatHome.length; i++) {
        listLatHome[i].value = position.coords.latitude;
    }
    var listLngHome = document.getElementsByClassName('lngHome');
    for (var i = 0; i < listLngHome.length; i++) {
        listLngHome[i].value = position.coords.longitude;
    }
    console.log(position.coords.latitude + " : " + position.coords.longitude);

    setCookieMinutes("latHome", position.coords.latitude, 30);
    setCookieMinutes("lngHome", position.coords.longitude, 30);
}

getLocation();

