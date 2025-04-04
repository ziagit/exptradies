export default {
  setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  },
  getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(";");
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == " ") {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  },
  checkCookie(name) {
    let user = this.getCookie(name);
    if (user != "") {
      return user;
    } else {
      this.setCookie(name, this.cookieValue(), 365);
      return this.getCookie(name);
    }
  },
  cookieValue() {
    var rn = Math.random().toString(36).substr(2, 10);
    return rn + "@exptradies.com";
  },
};
