/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function kiemTraDangNhap() {
    if (checkCookie("username") !== "") {
        return true;
    } else {
        $.notify("Bạn cần đăng nhập trước khi đặt mua món ăn", "warn");
        return false;
    }

}

function checkCookie(name) {
    var cookie = getCookie(name);
    if (cookie != "") {
        return cookie;
    } else {
        return "";
    }
}

window.fbAsyncInit = function () {
    FB.init({
        appId: '2002167313362798',
        cookie: true, // enable cookies to allow the server to access 
        // the session
        xfbml: true, // parse social plugins on this page
        version: 'v2.8' // use graph api version 2.8
    });

};

// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function fbLogoutUser() {
    FB.getLoginStatus(function (response) {
        if (response && response.status === 'connected') {
            FB.logout(function (response) {
                setCookie("username", "", 0.0001);
                localStorage.removeItem("maTaiKhoan");
                localStorage.removeItem("anhDaiDien");
                document.location.href = 'index.jsp';
            });
        }
    });

    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        console.log('User signed out.');
        setCookie("username", "", 0.0001);
        localStorage.removeItem("maTaiKhoan");
        localStorage.removeItem("anhDaiDien");
        document.location.href = 'index.jsp';
    });
}

function login() {
    document.location.href = "login.jsp";
}

function delete_cookie(name) {
    document.cookie = name + "=" + "" + "; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function setCookieMinutes(cname, cvalue, minute) {
    var d = new Date();
    d.setTime(d.getTime() + (minute * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function activePhanTrang() {
    var trangHienTai = document.getElementById("trangHienTai").value;
    document.getElementById("trang" + trangHienTai).classList.toggle("active");
}
