var counterContainer = document.querySelector(".website-counter");
var visitCount = localStorage.getItem("page_view");
// Check if page_view entry is present
if (visitCount) {
  visitCount = Number(visitCount) + 1;
  localStorage.setItem("page_view", visitCount);
  const rndInt = Math.floor(Math.random() * 10) + 1
  document.cookie = 'VisitorCount='+visitCount+'; expires=Wed, 1 Jan 2070 13:47:11 UTC; path=/';
} else {
  visitCount = 1;
  localStorage.setItem("page_view", 1);
}
counterContainer.innerHTML = visitCount;
let visitorCount = (visitCount + 1);
SetTimeout(checkCookie, 200)
function checkCookie() {
  reloaded = Number(reloaded) + 1;
  let reloaded = getCookie("IsRefreshed?");
  if (reloaded != "2") {
    delete reloaded;
    document.cookie="IsRefreshed?=;expires=Thu, 01 Jan 1970
    window.location.replace("https://altify-developing-001.netlify.app/html/ajax/info?visitor-count="+visitorCount);
  } else {
     if (reloaded != "1") {
       document.cookie = 'IsRefreshed?='+reloaded+'; expires=Wed, 1 Jan 2070 13:47:11 UTC; path=/';
       setCookie("IsRefreshed?", reloaded, 2);
     }
  }
}
