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
document.getElementById("csrfid").innerHTML = (csrf);
document.getElementById("csrfid2").innerHTML = (csrf2);
/*document.write(
"<form><label for='ip'>ip:</label><input type='text' id='ip' name='ip' value="+csrf3+"><br></form>"+
"<p id='csrfid'></p>"
);*/
alert(csrf3);
document.getElementById("csrfid4").innerHTML = ("<label for=csrfid'>:</label><input type='text' id='csrfid' name='csrfid' value="+csrf3+"><br>");
