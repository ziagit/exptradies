window.Vue = require("vue");
import VueRouter from "vue-router";
import Home from "./components/web/Home";
import LandingComponent from "./components/web/LandingComponent";
import About from "./components/web/About";
import Services from "./components/web/Services";
import Posts from "./components/web/Posts";
import Businesses from "./components/web/Businesses";
import Help from "./components/web/Help";
import Terms from "./components/web/Terms";
import Privacy from "./components/web/Privacy";
import BecomeEmployee from "./components/web/BecomeEmployee";
import Login from "./components/web/auth/Login.vue";
import Password from "./components/web/auth/Password.vue";
import ForgetPassword from "./components/web/auth/ForgetPassword.vue";
import ResetPassword from "./components/web/auth/ResetPassword.vue";
import VerifyContact from "./components/web/auth/Verify.vue";
import VerifyEmail from "./components/web/auth/VerifyEmail";
import NewPassword from "./components/web/auth/NewPassword";
import NotFoundPage from "./components/shared/pages/NotFoundPage.vue";

import Post from "./components/web/post/Post.vue";
import Location from "./components/web/post/Location.vue";
import StepTemplate from "./components/web/post/Step.vue";
import Contact from "./components/web/post/Contact.vue";

import SuboptionComponent from "./components/web/post/SubOption.vue";
import TestComponent from "./components/web/post/Test.vue";

import Confirm from "./components/web/post/Confirm.vue";

import Employee from "./components/web/employee/Employee.vue";
import EmployeeProfile from "./components/web/employee/profile/Profile.vue";
import EmployeeAddProfile from "./components/web/employee/profile/Add.vue";
import EmployeeEditProfile from "./components/web/employee/profile/Edit.vue";
import EmployeeTabs from "./components/web/employee/leads/Tabs.vue";
import EmployeeExperiences from "./components/web/employee/experiences/Experiences.vue";

import EmployeeLead from "./components/web/employee/leads/Lead.vue";
import EmployeePosts from "./components/web/employee/posts/Posts.vue";
import EmployeePost from "./components/web/employee/posts/Post.vue";

import EmployeePaymentMethodsTab from "./components/web/employee/payments/Tabs.vue";
import EmployeeInvoice from "./components/web/employee/payments/invoices/Invoice.vue";

import ChatLoading from "./components/web/chat/Loading.vue";
import ChatContainer from "./components/web/chat/Container.vue";
import Inbox from "./components/web/inbox/Inbox.vue";

import Admin from "./components/admin/Admin.vue";
import Dashboard from "./components/admin/dashboard/Dashboard.vue";
import AdminAbout from "./components/admin/pages/about/About.vue";
import AdminCities from "./components/admin/pages/cities/Cities.vue";

import Blog from "./components/admin/pages/blog/List.vue";
import AddBlog from "./components/admin/pages/blog/Add.vue";
import EditBlog from "./components/admin/pages/blog/Edit.vue";

import AddAbout from "./components/admin/pages/about/Add.vue";
import EditAbout from "./components/admin/pages/about/Edit.vue";
import AdminFaq from "./components/admin/pages/faq/FAQ.vue";
import AddFaq from "./components/admin/pages/faq/Add.vue";
import EditFaq from "./components/admin/pages/faq/Edit.vue";
import AdminPrivacy from "./components/admin/pages/privacy/Privacy.vue";
import AddPrivacy from "./components/admin/pages/privacy/Add.vue";
import EditPrivacy from "./components/admin/pages/privacy/Edit.vue";
import AdminTerms from "./components/admin/pages/terms/Terms.vue";
import AddTerm from "./components/admin/pages/terms/Add.vue";
import EditTerm from "./components/admin/pages/terms/Edit.vue";
import CompanyContainer from "./components/admin/pages/company/Container.vue";

import AdminServiceTypes from "./components/admin/posts/serviceType/ServiceType.vue";
import AdminServices from "./components/admin/posts/services/Services.vue";

import AdminSteps from "./components/admin/posts/steps/Steps.vue";
import AdminOptions from "./components/admin/posts/options/Options.vue";
import AdminSuboptions from "./components/admin/posts/suboptions/Suboptions.vue";

import AdminEmployees from "./components/admin/employees/Employees.vue";
import AdminEmployee from "./components/admin/employees/Employee.vue";

import AdminJobs from "./components/admin/jobs/Jobs.vue";
import AdminJob from "./components/admin/jobs/Job.vue";

import AdminUsers from "./components/admin/users/Users.vue";

import AdminReports from "./components/admin/finance/reports/Reports.vue";
import AdminPayments from "./components/admin/finance/payments/Tabs.vue";

import AdminChatContainer from "./components/admin/chat/Container.vue";
import AdminChatroom from "./components/admin/chat/ChatBot.vue";

import Settings from "./components/admin/settings/Settings.vue";
import DatabaseBackups from "./components/admin/settings/DatabaseBackups.vue";

import store from "./store";

//prevent from existing route to be pushed
const originalPush = VueRouter.prototype.push;
VueRouter.prototype.push = function push(location) {
    return originalPush.call(this, location).catch((err) => err);
};

function supportGuard(to, from, next) {
    var user = store.getters["auth/user"];
    if (store.getters["auth/authenticated"]) {
        if (user.role.name === "Admin" || user.role.name === "Support") {
            next();
        } else {
            next("/signin");
        }
    } else {
        next("/signin");
    }
}
function adminGuard(to, from, next) {
    var user = store.getters["auth/user"];
    if (store.getters["auth/authenticated"]) {
        if (user.role.name === "Admin") {
            next();
        } else {
            next("/signin");
        }
    } else {
        next("/signin");
    }
}
Vue.use(VueRouter);
export default new VueRouter({
    mode: "history",
    hash: false,
    routes: [
        {
            path: "/",
            component: Home,
            children: [
                {
                    path: "",
                    redirect: "home",
                },
                {
                    name: "home",
                    path: "home",
                    component: LandingComponent,
                },
                {
                    name: "about",
                    path: "about",
                    component: About,
                },
                {
                    name: "services",
                    path: "services/:id",
                    component: Services,
                },
                {
                    name: "posts",
                    path: "posts",
                    component: Posts,
                },
                {
                    name: "businesses",
                    path: "businesses",
                    component: Businesses,
                },
                {
                    name: "help",
                    path: "help",
                    component: Help,
                },
                {
                    name: "terms",
                    path: "terms",
                    component: Terms,
                },
                {
                    name: "privacy",
                    path: "privacy",
                    component: Privacy,
                },
                {
                    name: "become-employee",
                    path: "become-employee",
                    component: BecomeEmployee,
                },
                {
                    name: "signin",
                    path: "signin",
                    component: Login,
                },
                {
                    path: "password",
                    component: Password,
                },
                {
                    path: "forget-password",
                    component: ForgetPassword,
                },
                {
                    path: "reset-password",
                    component: ResetPassword,
                },
                {
                    path: "verify",
                    component: VerifyContact,
                },
                {
                    path: "verify-email",
                    component: VerifyEmail,
                },
                {
                    path: "new-password",
                    component: NewPassword,
                },
                {
                    path: "chat/loading/:id",
                    component: ChatLoading,
                },
                {
                    path: "chat",
                    component: ChatContainer,
                },
                {
                    path: "post",
                    component: Post,
                    children: [
                        {
                            path: "",
                            redirect: "location",
                        },
                        {
                            path: "location",
                            component: Location,
                        },
                        {
                            path: "step",
                            component: StepTemplate,
                        },
                        {
                            path: "test",
                            name: "testsuboptions",
                            component: TestComponent,
                        },
                        {
                            path: "suboptions",
                            name: "suboptions",
                            component: SuboptionComponent,
                            props: true,
                        },
                        {
                            path: "contact",
                            component: Contact,
                        },
                        {
                            path: "confirm",
                            component: Confirm,
                        },
                    ],
                },
                {
                    path: "employee",
                    component: Employee,
                    children: [
                        {
                            path: "",
                            redirect: "profile",
                        },
                        {
                            path: "profile",
                            component: EmployeeProfile,
                        },
                        {
                            path: "profile/add",
                            component: EmployeeAddProfile,
                        },
                        {
                            path: "profile/edit/:id",
                            component: EmployeeEditProfile,
                        },
                        {
                            path: "experiences",
                            component: EmployeeExperiences,
                        },
                        {
                            path: "leads",
                            component: EmployeeTabs,
                        },
                        {
                            path: "leads/:id",
                            component: EmployeeLead,
                        },
                        {
                            path: "posts",
                            component: EmployeePosts,
                        },
                        {
                            path: "posts/:id",
                            component: EmployeePost,
                        },
                        {
                            path: "payment-methods",
                            component: EmployeePaymentMethodsTab,
                        },
                        {
                            name: "employee-invoice",
                            path: "invoices/:id",
                            component: EmployeeInvoice,
                        },
                        {
                            name: "employee-inbox",
                            path: "inbox",
                            component: Inbox,
                        },
                        {
                            name: "employee-chat",
                            path: "chat/loading/room",
                            props: true,
                            component: ChatLoading,
                        },
                        {
                            name: "employee-room",
                            path: "chat/room",
                            props: true,
                            component: ChatContainer,
                        },
                    ],
                },
            ],
        },
        {
            path: "/admin",
            component: Admin,
            children: [
                {
                    path: "",
                    redirect: "dashboard",
                },
                {
                    path: "dashboard",
                    component: Dashboard,
                },
                {
                    path: "about",
                    component: AdminAbout,
                },
                {
                    path: "cities",
                    component: AdminCities,
                },
                {
                    path: "blog",
                    component: Blog,
                },
                {
                    path: "blog/add",
                    component: AddBlog,
                },
                {
                    path: "blog/edit",
                    component: EditBlog,
                },
                {
                    path: "about/add",
                    component: AddAbout,
                },
                {
                    path: "about/edit",
                    component: EditAbout,
                },
                {
                    path: "faq",
                    component: AdminFaq,
                },
                {
                    path: "faq/add",
                    component: AddFaq,
                },
                {
                    path: "faq/edit",
                    component: EditFaq,
                },
                {
                    path: "privacy",
                    component: AdminPrivacy,
                },
                {
                    path: "privacy/add",
                    component: AddPrivacy,
                },
                {
                    path: "privacy/edit",
                    component: EditPrivacy,
                },
                {
                    path: "terms",
                    component: AdminTerms,
                },
                {
                    path: "terms/add",
                    component: AddTerm,
                },
                {
                    path: "terms/edit",
                    component: EditTerm,
                },
                {
                    path: "company",
                    component: CompanyContainer,
                },
                {
                    path: "services",
                    component: AdminServices,
                },
                {
                    path: "service-types",
                    component: AdminServiceTypes,
                },
                {
                    path: "service/:id",
                    component: AdminSteps,
                },
                {
                    path: "service/step/:id",
                    component: AdminOptions,
                },
                {
                    path: "service/step/option/:id",
                    component: AdminSuboptions,
                },
                {
                    path: "employees",
                    component: AdminEmployees,
                },
                {
                    path: "employee/:id",
                    component: AdminEmployee,
                },
                {
                    path: "posts",
                    component: AdminJobs,
                },
                {
                    path: "posts/:id",
                    component: AdminJob,
                },
                {
                    path: "users",
                    component: AdminUsers,
                },
                {
                    path: "chat",
                    component: AdminChatContainer,
                },
                {
                    path: "reports",
                    component: AdminReports,
                },
                {
                    path: "payments",
                    component: AdminPayments,
                    beforeEnter: adminGuard,
                },
                {
                    name: "admin-chatroom",
                    path: "chatroom",
                    props: true,
                    component: AdminChatroom,
                },
                {
                    name: "inbox",
                    path: "inbox",
                    component: Inbox,
                },
                {
                    path: "settings",
                    component: Settings,
                    children: [
                        { path: "", redirect: "backups" },
                        {
                            path: "backups",
                            component: DatabaseBackups,
                        },
                    ],
                },
            ],
            beforeEnter: supportGuard,
        },
        {
            path: "/blog",
            redirect: "/blog/list",
        },
        {
            path: "/blog/details",
            redirect: "/blog/details",
        },

        { path: "/404", component: NotFoundPage },
        { path: "*", redirect: "/404" },
    ],
    scrollBehavior() {
        window.scrollTo(0, 0);
    },
});
