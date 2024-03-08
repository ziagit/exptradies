export default {
    save(name, data) {
        return sessionStorage.setItem(name, JSON.stringify(data));
    },
    read(name) {
        return JSON.parse(sessionStorage.getItem(name));
    },
    remove(name) {
        return sessionStorage.removeItem(name);
    },
    removeAll() {
        sessionStorage.removeItem("service");
        sessionStorage.removeItem("step_length");
        sessionStorage.removeItem("current_step");
        sessionStorage.removeItem("address");
        sessionStorage.removeItem("contact");
        sessionStorage.removeItem("post");
        sessionStorage.removeItem("optionArray");
        sessionStorage.removeItem("item-images");
        sessionStorage.removeItem("emp_id");
        sessionStorage.removeItem("prev-route");
        return;
    }
};
