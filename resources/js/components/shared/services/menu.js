export default {
  employee() {
    return [
      {
        name: "employee-profile",
        title: "Profile",
        path: "/employee/profile",
      },
      {
        name: "employee-experiences",
        title: "Galery",
        path: "/employee/experiences",
      },
      {
        name: "employee-leads",
        title: "Leads",
        path: "/employee/leads",
      },
      {
        name: "employee-payment-method",
        title: "Payments",
        path: "/employee/payment-methods",
      },
    ];
  },
  employer() {
    return [
      {
        name: "employer-profile",
        title: "Profile",
        path: "/employer/profile",
      },
      {
        name: "employer-posts",
        title: "Jobs",
        path: "/employer/posts",
      },
    ];
  },
  support() {
    return [{}];
  },
  admin() {
    return [{}];
  },
};
