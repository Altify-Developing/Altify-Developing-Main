const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
  
var vars = {'debug':false}

for (var key in vars)
	{if (urlParams.has(key))
		{if (key == "start" || key == "end")
			{vars[key] = new Date(urlParams.get(key) + "T00:00")}
		 else
			{vars[key] = urlParams.get(key)}}}

function buildDropdowns () {
		// ------------------------------------------------------- //
		// Multi Level dropdowns
		// ------------------------------------------------------ //
		$("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
			event.preventDefault();
			event.stopPropagation();

			$(this).siblings().toggleClass("show");

			if (!$(this).next().hasClass('show')) {
				$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
				}
			$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
				$('.dropdown-submenu .show').removeClass("show");
				});
			});
		}

function showDebug(str)
	{if (vars["debug"])
		{console.log("DEBUG");
		 console.log(str);}}
	
// From: https://www.freecodecamp.org/forum/t/how-to-capitalize-the-first-letter-of-a-string-in-javascript/18405
function capitalizeFirstLetter(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}
	
function pad(num, size) {
    var s = num+"";
    while (s.length < size) s = "0" + s;
    return s;
}
