import axios from "axios";
export default {
    async get(path, options) {
        var response = await axios.get(path);
        let myArray = [];
        for (let i = 0; i < options.length; i++) {
            let obj = { qus: null, ans: null };
            for (let j = i; j < response.data.steps.length; j++) {
                if (options[i].step_id == response.data.steps[j].id) {
                    obj.qus = response.data.steps[j].title;
                    obj.ans =
                        options[i].title + this.subOpt(options[i].suboptions);
                    myArray.push(obj);
                }
            }
        }
        return myArray;
    },
    subOpt(options) {
        if (options.length === 0) {
            return "";
        }
        return " (" + options[0].title + ")";
    },
};
