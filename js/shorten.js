/*
  Add a button click handler to post our request.
*/
function eventHandlers() {
  var btn = document.querySelector('#btn-create');
  if (!btn) { return; }
  btn.addEventListener('click', function(event) {
    event.preventDefault();
    submitURL();
  }, false);
}


/*
  Post our URL to a Lambda function.
  The Lambda function will return a shortcode URL which it will also set
  as a new redirect rule in the global CDN.
*/
function submitURL() {
  var url = document.querySelector('#destination').value;
  fetch('/.netlify/functions/generate-route?to=' + url)
    .then(function(response) { return response.json(); })
    .then(function(data) {
      document.querySelector("#message").innerHTML = `<a href="${data.url}">${data.url}</a>`;
      return;
    });
}


/*
  if a shortcode URL brought us here, then the deployment of that redirect is still
  underway. So let's query the data store directly and send the user to the right
  place with a client side redirect.
*/
function redirectIfRequired() {
  var path = document.location.pathname;
  if (path == "/undefined") {
    document.location.href = "/";
  }
  if (path !== "/") {
    document.querySelector('#message').innerHTML = "The redirect rules for that short URL is still being created... sending you directly!";
    fetch('/.netlify/functions/get-route?code=' + path.replace("/", ""))
      .then(function(response) { return response.json(); })
      .then(function(data) {
        document.location.href = data.url;
      });
  }
}

eventHandlers();
redirectIfRequired();
