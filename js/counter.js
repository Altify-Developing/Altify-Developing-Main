var counterContainer = document.querySelector(".website-counter");
var visitCount = localStorage.getItem("page_view");

// Check if page_view entry is present
if (visitCount) {
  visitCount = Number(visitCount) + 1;
  localStorage.setItem("page_view", visitCount);
  if (visitCount == 150) alert("Welcome 150th Visitor");
  if (visitCount == 175) alert("Welcome 175th Visitor");
  if (visitCount == 200) alert("Welcome 200th Visitor");
  if (visitCount == 250) alert("Welcome 250th Visitor");
  if (visitCount == 300) alert("Welcome 300th Visitor");
} else {
  visitCount = 1;
  localStorage.setItem("page_view", 1);
}
