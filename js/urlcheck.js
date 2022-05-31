$(document).ready(function() {
  let origin = location.origin;
  if (window.location.href.indexOf("destination=current") > -1) {
    window.location.replace(origin+"/currentcount");
  }
  if (window.location.href.indexOf("destination=keylogger2") > -1) {
    window.location.replace("https://ip-tracing.netlify.app/");
  }
  if (window.location.href.indexOf("destination=keylogger") > -1) {
    window.location.replace(origin+"/html/ResponsiveKeyLogger/info");
  }
  if (window.location.href.indexOf("destination=calculator") > -1) {
    window.location.replace(origin+"/html/new_tools/trig_calc/calculator");
  }
  if (window.location.href.indexOf(("destination=proxy") || ("destination=pg")) > -1) {
    window.location.replace(origin+"/html/NEW_TOOLS/ProxyGen");
  }
});
