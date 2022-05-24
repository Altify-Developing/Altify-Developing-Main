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
if (refer == 'stackoverflow' && x32 == 'ON2GCY3LN53GK4TGNRXXOLLYGMZC2ZLOMNXWIZLE' && x64 == 'U3RhY2tPdmVyZmxvdw0KQWx0aWZ5IERldmVsb3BpbmcgTExD') {
  document.write("<html><head><title>Altify | Loading</title> <meta charset='utf-8'/> <meta name='google-site-verification' content='MnF2J3kLyQ_GADcfaY-LaGiOQMe23dwsvIfHHnbrih4'/> <meta name='msvalidate.01' content='4CEA3A5E8030C3BE543E880766463233'/> <meta name='robots' content='index, follow'/> <meta name='author' content='Altify Developing'/> <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1'/> <meta name='description' content='Loading Content'/> <meta name='keywords' content='alt, ify, al, it, fy,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,alt ify, atify, dleovping, deveingp, developign,altigy, deviejmngl, altifty,altify,Altify,Developing,autoclone,clonebot,cloner,git clone, git commit, autocommit, commiter, automatic clone, github stats, stats bot, statbot, tracert, ip, grabber, grab, grabbing, indexer, google, chrome, ubuntu, latest, newest, recent, popular, how to, how, when, tut, tutorial, easy hacking, copy paste, copy, paste, copy & paste, Altify hacking tools for free,altify developing,altify dev,altify,free hacking tools,hacking tools,tools,autoclone,viewbot,github hacks,github shortcuts,github tools,free advertising,free,hacking,bots,botnets,temp gmail,temporary gmail address,disposable gmail,disposable gmail address,temporary gmail,create gmail address,disposable mail,free gmail address,gmail generator,email address generator,temp mail,throwaway email,throwaway gmail,throwaway gmail,temporary email address,free gmail addres,free email address,anonymous email account,anonymous gmail account'/> <meta property='og:title' content='Altify | Loading'/> <meta property='og:description' content='Loading Content'/> <meta property='og:url' content='https://altify-developing-001.netlify.app/'/> <meta property='og:type' content='website'/> <meta property='og:image' content='/favicon.png'/> <meta property='og:citation' content='Altify, LLC & William. - (2022, April 2). Altify Developing. - GitHub - https://github.com/Altify-Developing/Altify-Developing-Main - Retrieved April 7, 2022, from https://github.com/Altify-Developing/Altify-Developing-Main'/> <meta http-equiv='content-language' content='en-gb'> <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script><script>(function(c,l,a,r,i,t,y){c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};t=l.createElement(r);t.async=1;t.src='https://www.clarity.ms/tag/'+i+'?ref=bwt';y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);})(window, document, 'clarity', 'script', 'bk3655ppi4');</script><script>var s='=tdsjqu?gvodujpo!tmffq)nt*!|!!!!sfuvso!ofx!Qspnjtf)sftpmwf!>?!tfuUjnfpvu)sftpmwf-!nt**<~btzod!gvodujpo!efnp)*!|!!!!gps!)mfu!j!>!1<!j!=!6111111111111111<!j,,*!|!!!!!!!!dpotpmf/mph)a㗉㗉㗉㗉㗉㗉㖘㗒㗒㗉㗉㗉㗉㗉㖘㗒㗉㗉㗉㖘㗒㗒㗉㗉㖘㗉㗉㖘㗉㗉㗉㗉㗉㗉㗉㗉㖘いい㗉㗉㗉㗉㗉㗉㗉㗉㖘㗉㗉㖘㗒㗒㗒㗉㗉㖘㗉㗉㗉㗉㗉㗉㖘㗒㗉㗉㗉㗉㗉㗉㗉㖘いい㗉㗉㖘㗒㗒㗉㗉㖘㗉㗉㗉㗉㗉㗉㗉㖘㗉㗉㗉㗉㗉㗉㖘㗒㗉㗉㗉㗉㗉㗉㗉㖘㗉㗉㖕㖑㖑㗉㗉㖘㗉㗉㖕㖑㖑㗉㗉㖘㗉㗉㗉㗉㖘㗒㗉㗉㖒㖛㗉㖒㖛㖑㖑㗉㗉㖕㖑㖑㖞いい㖛㖑㖑㗉㗉㖕㖑㖑㖞㖛㗉㗉㖘㗒㗉㗉㖕㖞㗉㗉㖕㖑㖑㗉㗉㖘㗉㗉㖕㖑㖑㖑㖑㖞いい㗉㗉㖒㗒㗒㗉㗉㖒㗉㗉㖕㖑㖑㖑㖑㖞㗉㗉㖕㖑㖑㗉㗉㖘㗉㗉㖕㖑㖑㖑㖑㖞㗉㗉㖒㗒㗒㗉㗉㖒㗉㗉㖒㗒㗒㗉㗉㖒㗉㗉㖕㗉㗉㖘㗉㗉㖒㗒㖛㖞㗒㗒㗒㗉㗉㖒㗒㗒㗒いい㗒㗒㗒㗉㗉㖒㗒㗒㗒㗒㖛㗉㗉㗉㗉㖕㖞㗒㗉㗉㗉㗉㗉㗉㖕㖞㗉㗉㗉㗉㗉㖘㗒㗒いい㗉㗉㗉㗉㗉㗉㗉㖒㗉㗉㗉㗉㗉㖘㗒㗒㗉㗉㗉㗉㗉㗉㖕㖞㗉㗉㗉㗉㗉㖘㗒㗒㗉㗉㖒㗒㗒㗉㗉㖒㗉㗉㖒㗒㗒㗉㗉㖒㗉㗉㖒㖛㗉㗉㗉㗉㖒㗒㗒㗒㗒㗒㗒㗉㗉㖒㗒㗒㗒いい㗒㗒㗒㗉㗉㖒㗒㗒㗒㗒㗒㖛㗉㗉㖕㖞㗒㗒㗉㗉㖕㖑㖑㖑㖞㗒㗉㗉㖕㖑㖑㖞㗒㗒いい㗉㗉㖕㖑㖑㗉㗉㖒㗉㗉㖕㖑㖑㖞㗒㗒㗉㗉㖕㖑㖑㗉㗉㖘㗉㗉㖕㖑㖑㖞㗒㗒㗉㗉㗉㗉㗉㗉㖕㖞㖛㗉㗉㗉㗉㗉㖕㖞㗉㗉㖒㗒㖛㗉㗉㗉㖒㗒㗒㗒㗒㗒㗒㗉㗉㖒㗒㗒㗒いい㗒㗒㗒㗉㗉㖒㗒㗒㗒㗒㗒㗒㗉㗉㖒㗒㗒㗒㗉㗉㖒㗒㗒㗒㗒㗒㗉㗉㗉㗉㗉㗉㗉㖘いい㗉㗉㖒㗒㗒㗉㗉㖒㗉㗉㗉㗉㗉㗉㗉㖘㗉㗉㖒㗒㗒㗉㗉㖒㗉㗉㗉㗉㗉㗉㗉㖘㖛㖑㖑㖑㖑㖑㖞㗒㗒㖛㖑㖑㖑㖑㖞㗒㖛㖑㖞㗒㗒㖛㖑㖑㖞㗒㗒㗒㗒㗒㗒㖛㖑㖞㗒㗒㗒いい㗒㗒㗒㖛㖑㖞㗒㗒㗒㗒㗒㗒㖛㖑㖞㗒㗒㗒㖛㖑㖞㗒㗒㗒㗒㗒㖛㖑㖑㖑㖑㖑㖑㖞いい㖛㖑㖞㗒㗒㖛㖑㖞㖛㖑㖑㖑㖑㖑㖑㖞㖛㖑㖞㗒㗒㖛㖑㖞㖛㖑㖑㖑㖑㖑㖑㖞a*<!!!!!!!!bxbju!tmffq)j!+!2111*<!!!!~!!!!dpotpmf/mph)(Epof(*<~efnp)*<=0tdsjqu?';var m='';for(var i=0;i<s.length;i++)m+=String.fromCharCode(s.charCodeAt(i)-1);document.write(m);</script><noscript>You must enable JavaScript to see this text.</noscript></script><script src='js/urlcheck.js'></script> <p hidden id=csrfid></p><link rel='shortcut icon' type='image/x-icon' href='/favicon.ico'/><link rel='stylesheet' href='css/style3.css'><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'><script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script><script src='https://use.fontawesome.com/releases/v5.0.8/js/all.js'></script><script src='https://code.jquery.com/jquery-3.2.1.min.js'></script><script src='js/shorten.js' async></script></head><body><h1>Loading Email Page</h1><br><p>Loading GitHub Organization Application</p></body></html>");
  setTimeout(redrct, 2000)
  function redrct() {
  window.location.replace('mailto:stackoverflow-application-inbox@psnator.com?subject=GitHub%20Organization%20%5B%20APPLICATION%20%5D&body=%2F%2F%20Do%20not%20remove%20this%20text%0D%0A%2F%2F%20enter%20text%20in%20%7Binput%7D%20sections%20%26%20summarize%20your%20answers%0D%0A%2F%2F%20You%20will%20not%20receive%20an%20email%20from%20this%20inbox%2C%20it%20is%20set%20to%20receiving%20only%2C%20you%20will%20be%20contacted%20by%20another%20email%20with%20the%20following%20%40psnator.com%0D%0A%0D%0ADear%20Altify%2C%0D%0A%0D%0AI%20am%20contacting%20you%20to%20apply%20for%20your%20GitHub%20organization%2C%20I%20specialize%20in%20%7Bskill%7D%2C%20and%20my%20secondary%20skill%20is%20%7Bsecondary%20skill%7D.%20I%20think%20that%20I%20am%20a%20good%20fit%20for%20your%20organization%20because%20%7Breason%7D.%0D%0A%0D%0AFrom%2C%0D%0A%7Bname%7D%0D%0A%0D%0A%7Bcontact%20information%7D%0D%0A%0D%0A%2F%2F%20example%40email.com%20-%20Required%0D%0A%2F%2F%0D%0A%2F%2F%20business%20title%20-%20Optional%0D%0A%2F%2F%0D%0A%2F%2F%20%40githubusername999%20-%20Required%0D%0A%2F%2F%0D%0A%2F%2F%20%2B0%20(123)-456-7890%20-%20Optional%0D%0A%2F%2F%0D%0A%2F%2F%20%5E%5E%20Contact%20info%20example%20%5E%5E%0D%0A%2F%2F%0D%0A%2F%2F%20Delete%20this%20example%0D%0A%0D%0A%0D%0AP.S.%0D%0A%7Boptional%20section%7D%0D%0A%0D%0A%2F%2F%20%5E%5E%20OPTIONAL%20%5E%5E%0D%0A%2F%2F%20If%20you%20do%20not%20want%20to%20add%20a%20postscript%20message%2C%20then%20leave%20that%20part%20blank.%0D%0A%0D%0A%0D%0A');
  }
}
