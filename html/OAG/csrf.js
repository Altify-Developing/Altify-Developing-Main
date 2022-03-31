setTimeout(randomString, 200);
function randomString(length, chars) {
refcount = Math.floor(Math.random() * 100000) + 1;
var result = '';
for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
return result;
}
csrf = randomString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
document.getElementById("csrfid").innerHTML = (csrf);
document.cookie = 'X-CSRF-Token='+crsf;
let x = document.cookie;
alert(x);
