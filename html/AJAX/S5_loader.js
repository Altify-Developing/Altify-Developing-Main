  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("S5-List").innerHTML = this.responseText;
    }
  xhttp.open("GET", "SOCKS5.html", true);
  xhttp.send();
