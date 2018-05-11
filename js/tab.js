/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function openCity(cityName) {
    document.getElementById('London1').classList.remove('active-slide');
    document.getElementById('Tokyo1').classList.remove('active-slide');
    document.getElementById('Hanoi1').classList.remove('active-slide');
    var i;
    var x = document.getElementsByClassName("city");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }

    if (cityName === 'London') {
        document.getElementById('London').style.display = "flex";
        document.getElementById('London' + 1).classList.toggle('active-slide');
    }
    if (cityName === 'Tokyo') {
        document.getElementById('Tokyo').style.display = "block";
        document.getElementById('Tokyo' + 1).classList.toggle('active-slide');
    }
    if (cityName === 'Hanoi') {
        document.getElementById('Hanoi').style.display = "flex";
        document.getElementById('Hanoi1').classList.toggle('active-slide');
    }
}