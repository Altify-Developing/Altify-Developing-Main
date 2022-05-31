$(document).ready(function() {
  let origin = location.origin;
  if (window.location.href.indexOf("destination=tos") > -1) {
    window.location.replace(origin+"/html/ToS.html");
  }
  if (window.location.href.indexOf("destination=github") > -1) {
    window.location.replace("https://github.com/Altify-Developing/Altify-Developing-Main");
  }
  if (window.location.href.indexOf("destination=tools") > -1) {
    window.location.replace(origin+"/html/toolstodownload");
  }
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
