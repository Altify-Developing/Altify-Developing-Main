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
let x32 = getAllUrlParams(origin).cor
let x64 = getAllUrlParams(origin).lec
if (refer == 'indeed') {
  document.getElementById("refsrc").innerHTML = 'Referred by: '+refer;
} else if (refer == 'github') {
    document.getElementById("refsrc").innerHTML = 'Referred by: '+refer;
}
if (mail1 == '1' && mail2 == 'ps') {
  document.getElementById("mailing").innerHTML = "<a href='mailto:gitref@psnator.com?subject=Message%20for%20Altify&body=%2F%2F%20Only%20use%20this%20email%20for%20messages%20that%20are%20important%20to%20my%20business%2C%20or%20information%20that%20could%20be%20helpful%20for%20me.%0D%0A%0D%0AHello%20Altify%2C%0D%0A%0D%0AI%20am%20contacting%20you%20about%20%7Binput%7D.%0D%0A%0D%0AFrom%2C%0D%0A%7Bname%7D%0D%0A%0D%0A%7Bcontact%20information%7D%0D%0A%0D%0A%2F%2F%0D%0A%2F%2F%20example%40email.com%0D%0A%2F%2F%0D%0A%2F%2F%20business%20title%0D%0A%2F%2F%0D%0A%2F%2F%20%40githubusername999%0D%0A%2F%2F%0D%0A%2F%2F%20Contact%20info%20example%0D%0A%2F%2F%0D%0A%0D%0A'>email</a>";
}
if ((x32 == 'ON2GCY3LN53GK4TGNRXXOLLYGMZC2ZLOMNXWIZLE' && x64 == 'U3RhY2tPdmVyZmxvdw0KQWx0aWZ5IERldmVsb3BpbmcgTExD') || (refer == 'stackoverflow')) {
  document.write("<h1>Redirecting</h1>");
  setTimeout(redrct, 2000)
  function redrct() {
  window.location.replace('mailto:stackoverflow-application-inbox@psnator.com?subject=GitHub%20Organization%20%5B%20APPLICATION%20%5D&body=%2F%2F%20Do%20not%20remove%20this%20text%0D%0A%2F%2F%20enter%20text%20in%20%7Binput%7D%20sections%20%26%20summarize%20your%20answers%0D%0A%2F%2F%20You%20will%20not%20receive%20an%20email%20from%20this%20inbox%2C%20it%20is%20set%20to%20receiving%20only%2C%20you%20will%20be%20contacted%20by%20another%20email%20with%20the%20following%20%40psnator.com%0D%0A%0D%0ADear%20Altify%2C%0D%0A%0D%0AI%20am%20contacting%20you%20to%20apply%20for%20your%20GitHub%20organization%2C%20I%20specialize%20in%20%7Bskill%7D%2C%20and%20my%20secondary%20skill%20is%20%7Bsecondary%20skill%7D.%20I%20think%20that%20I%20am%20a%20good%20fit%20for%20your%20organization%20because%20%7Breason%7D.%0D%0A%0D%0AFrom%2C%0D%0A%7Bname%7D%0D%0A%0D%0A%7Bcontact%20information%7D%0D%0A%0D%0A%2F%2F%20example%40email.com%20-%20Required%0D%0A%2F%2F%0D%0A%2F%2F%20business%20title%20-%20Optional%0D%0A%2F%2F%0D%0A%2F%2F%20%40githubusername999%20-%20Required%0D%0A%2F%2F%0D%0A%2F%2F%20%2B0%20(123)-456-7890%20-%20Optional%0D%0A%2F%2F%0D%0A%2F%2F%20%5E%5E%20Contact%20info%20example%20%5E%5E%0D%0A%2F%2F%0D%0A%2F%2F%20Delete%20this%20example%0D%0A%0D%0A%0D%0AP.S.%0D%0A%7Boptional%20section%7D%0D%0A%0D%0A%2F%2F%20%5E%5E%20OPTIONAL%20%5E%5E%0D%0A%2F%2F%20If%20you%20do%20not%20want%20to%20add%20a%20postscript%20message%2C%20then%20leave%20that%20part%20blank.%0D%0A%0D%0A%0D%0A');
  }
}
