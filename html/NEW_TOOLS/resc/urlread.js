function getAllUrlParams(url) {
  var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
  var obj = {};

  if (queryString) {
    queryString = queryString.split('#')[0];
    var arr = queryString.split('&');

    for (var i = 0; i < arr.length; i++) {
      var a = arr[i].split('=');
      var paramName = a[0];
      var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];

      paramName = paramName.toLowerCase();
      if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();

      if (paramName.match(/\[(\d+)?\]$/)) {
        var key = paramName.replace(/\[(\d+)?\]/, '');
        if (!obj[key]) obj[key] = [];

        if (paramName.match(/\[\d+\]$/)) {
          var index = /\[(\d+)\]/.exec(paramName)[1];
          obj[key][index] = paramValue;
        } else {
          obj[key].push(paramValue);
        }
      } else {
        if (!obj[paramName]) {
          obj[paramName] = paramValue;
        } else if (obj[paramName] && typeof obj[paramName] === 'string'){
          obj[paramName] = [obj[paramName]];
          obj[paramName].push(paramValue);
        } else {
          obj[paramName].push(paramValue);
        }
      }
    }
  }

  return obj;
}
var origin = window.location.href
let refer = getAllUrlParams(origin).ref
let mail1 = getAllUrlParams(origin).mo
let mail2 = getAllUrlParams(origin).mt
let mail3 = getAllUrlParams(origin).mh
let mail4 = getAllUrlParams(origin).mf
if (refer == 'Indeed') {
  document.getElementById("refsrc").innerHTML = 'Referred by: '+refer;
} else if (refer == 'GitHub') {
    document.getElementById("refsrc").innerHTML = "Referred by: <a href='https://github.com/Altify-Developing'>"+refer+"</a>";
}
if ((mail1 == '1' && mail2 == 'ps') || (mail3 == 'com' && mail4 == 'lit')) {
  document.getElementById("mailing").innerHTML = "<a href='mailto:gitref@psnator.com?subject=Message%20for%20Altify&body=%2F%2F%20Only%20use%20this%20email%20for%20messages%20that%20are%20important%20to%20my%20business%2C%20or%20information%20that%20could%20be%20helpful%20for%20me.%0D%0A%0D%0AHello%20Altify%2C%0D%0A%0D%0AI%20am%20contacting%20you%20about%20%7Binput%7D.%0D%0A%0D%0AFrom%2C%0D%0A%7Bname%7D%0D%0A%0D%0A%7Bcontact%20information%7D%0D%0A%0D%0A%2F%2F%0D%0A%2F%2F%20example%40email.com%0D%0A%2F%2F%0D%0A%2F%2F%20business%20title%0D%0A%2F%2F%0D%0A%2F%2F%20%40githubusername999%0D%0A%2F%2F%0D%0A%2F%2F%20Contact%20info%20example%0D%0A%2F%2F%0D%0A%0D%0A'>email</a>";
}
