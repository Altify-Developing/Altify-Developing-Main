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

let reloaded = localStorage.getItem("page_view_2");
if (reloaded) {
  reloaded = Number(reloaded) + 1;
  localStorage.setItem("page_view_2", reloaded);
  const rndInt = Math.floor(Math.random() * 10) + 1
  document.cookie = 'IsRefreshed?='+reloaded+'; path=/';
} else {
  reloaded = 1;
  localStorage.setItem("page_view_2", 1);
  let visitorCount = (reloaded + 1);
  window.location.replace("https://altify-developing-001.netlify.app/html/ajax/info?visitor-count="+visitorCount);
}
counterContainer.innerHTML = reloaded;
delete reloaded;
