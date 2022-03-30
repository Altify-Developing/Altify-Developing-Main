  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("HTTP-List").innerHTML = this.responseText;
    }
  xhttp.open("GET", "HTTP.js", true);
  xhttp.send();
