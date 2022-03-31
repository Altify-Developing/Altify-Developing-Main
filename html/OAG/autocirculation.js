$(document).ready(function() {
    if (window.location.href.indexOf("circulation=true") > -1) {
      setInterval(randomString, 1000);
        setInterval(refrsh, 1000);
        function refrsh() {
          window.location.replace("https://altify-developing-001.netlify.app/html/oag/aio_plain.src.html/?circulation=true&ref%20count="+refcount);
        }
    }
  });
