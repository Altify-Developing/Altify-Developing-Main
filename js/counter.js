var counterContainer = document.querySelector(".website-counter");
var milestoneContainer = document.querySelector(".milestone-counter");
var visitCount = localStorage.getItem("page_view");

// Check if page_view entry is present
if (visitCount) {
  visitCount = Number(visitCount) + 1;
  localStorage.setItem("page_view", visitCount);
  if (visitCount == 150) alert("Welcome 150th Visitor");
  if (visitCount == 175) alert("Welcome 175th Visitor");
  if (visitCount == 200) alert("Welcome 200th Visitor");
  if (visitCount == 215) alert("Welcome 215th Visitor");
  if (visitCount == 230) alert("Welcome 230th Visitor");
  if (visitCount == 245) alert("Welcome 245th Visitor");
  if (visitCount == 250) alert("Welcome 250th Visitor");
  if (visitCount == 275) alert("Welcome 275th Visitor");
  if (visitCount == 300) alert("Welcome 300th Visitor");
  if (visitCount == 315) alert("Welcome 315th Visitor");
  if (visitCount == 330) alert("Welcome 330th Visitor");
  if (visitCount == 345) alert("Welcome 345th Visitor");
  if (visitCount == 360) alert("Welcome 360th Visitor");
  if (visitCount == 375) alert("Welcome 375th Visitor");
  if (visitCount == 400) alert("Welcome 400th Visitor");
  if (visitCount == 415) alert("Welcome 415th Visitor");
  if (visitCount == 430) alert("Welcome 430th Visitor");
  if (visitCount == 445) alert("Welcome 445th Visitor");
  if (visitCount == 450) alert("Welcome 450th Visitor");
  if (visitCount == 475) alert("Welcome 475th Visitor");
  if (visitCount == 500) alert("Welcome 500th Visitor");
  const rndInt = Math.floor(Math.random() * 10) + 1
  document.cookie = 'VisitorCount='+visitCount+'; expires=Wed, 1 Jan 2070 13:47:11 UTC; path=/';
} else {
  visitCount = 1;
  localStorage.setItem("page_view", 1);
}
counterContainer.innerHTML = visitCount;
