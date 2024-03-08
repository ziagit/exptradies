export default {
    isLt2MB(file) {
        return file.size / 1024 / 1024 < 2;
    },
    isLt5MB(file) {
        return file.size / 1024 / 1024 < 5;
    },
    isGt15MB(file) {
        return file.size / 1024 / 1024 > 15;
    }

};
