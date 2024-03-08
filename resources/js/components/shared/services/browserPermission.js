export default {
  askNotificationPermission(vm) {
    if (Notification.permission !== "granted") {
      if (Notification.permission !== "denied") {
        Notification.requestPermission().then((perm) => {
          if (perm == "granted") {
            var notification = new Notification("Notifications", {
              icon: "https://tingsapp.com/images/logo.png",
              body: "You will be notified when using our service!",
            });
            notification.onclick = function () {
              window.open("https://tingsapp.com/about");
            };
          } else {
            this.alertForPermission(vm);
          }
        });
      } else {
        this.alertForPermission(vm);
      }
    }
  },

  alertForPermission(vm) {
    vm.$bvToast.toast(
      "You will not receive notification from this site, because you denied permission in your browser settings..",
      {
        title: "Tingsapp says",
        variant: "danger",
        toaster: "b-toaster-top-right",
        autoHideDelay: 9000,
      }
    );
  },
};
