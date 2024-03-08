export default{
    get(){
        var osName = "Unknown OS";
      var browserName = "Unknown Browser";
      let userAgent = navigator.userAgent;

      if (navigator.appVersion.indexOf("Win") != -1) osName = "Windows";

      if (navigator.appVersion.indexOf("Mac") != -1) osName = "MacOS";

      if (navigator.appVersion.indexOf("X11") != -1) osName = "UNIX";

      if (navigator.appVersion.indexOf("Linux") != -1) osName = "Linux";
      if (userAgent.match(/chrome|chromium|crios/i)) {
        browserName = "Chrome";
      } else if (userAgent.match(/firefox|fxios/i)) {
        browserName = "Firefox";
      } else if (userAgent.match(/safari/i)) {
        browserName = "Safari";
      } else if (userAgent.match(/opr\//i)) {
        browserName = "Opera";
      } else if (userAgent.match(/edg/i)) {
        browserName = "Edge";
      } else {
        browserName = "No browser";
      }
    return osName+' '+browserName;
    }
}