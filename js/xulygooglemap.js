/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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

    latHome = parseFloat(getCookie("latHome"));
    lngHome = parseFloat(getCookie("lngHome"));
}

var latHome;
var lngHome;

if (checkCookie("latHome") !== "") {
    latHome = parseFloat(getCookie("latHome"));
    lngHome = parseFloat(getCookie("lngHome"));
} else {
    getLocation();
}

var latCuaHang = $('#latCuaHang').val();
var lngCuaHang = $('#lngCuaHang').val();

var home = {
    lat: Number(latHome),
    lng: Number(lngHome)
};

var map;

var diemDen = {
    lat: Number(latCuaHang),
    lng: Number(lngCuaHang)
};

//Khởi tạo google map API
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 18,
        center: diemDen
    });
    var marker = new google.maps.Marker({
        position: diemDen,
        map: map
    });


//    var directionsDisplay = new google.maps.DirectionsRenderer({
//        map: map
//    });
//
//    // Set destination, origin and travel mode.
//    var request = {
//        destination: diemDen,
//        origin: home,
//        travelMode: 'DRIVING'
//    };
//
//
//    //Lay khoang cach
//    var a = new google.maps.LatLng(home.lat, home.lng);
//    var b = new google.maps.LatLng(diemDen.lat, diemDen.lng);
//
//    var service = new google.maps.DistanceMatrixService();
//    service.getDistanceMatrix(
//            {
//                origins: [a],
//                destinations: [b],
//                travelMode: 'DRIVING'
//            }, callback);
//    function callback(response, status) {
//        if (status == 'OK') {
//            var origins = response.originAddresses;
//            var destinations = response.destinationAddresses;
//
//            for (var i = 0; i < origins.length; i++) {
//                var results = response.rows[i].elements;
//                for (var j = 0; j < results.length; j++) {
//                    var element = results[j];
//                    var distance = element.distance.text;
//                    var duration = element.duration.text;
//                    var from = origins[i];
//                    var to = destinations[j];
//
//                    //Hien khoang cach
//                    var node = document.createElement("p");
//                    var textnode = document.createTextNode("Khoảng cách đến cửa hàng: " + distance);
//                    node.appendChild(textnode);
//                    document.getElementById("khoangCach").appendChild(node);
//                }
//            }
//        }
//    }
//
//    // Pass the directions request to the directions service.
//    var directionsService = new google.maps.DirectionsService();
//    directionsService.route(request, function (response, status) {
//        if (status == 'OK') {
//            // Display the route on the map.
//            directionsDisplay.setDirections(response);
//        }
//    });
}
