import Compressor from 'compressorjs';
import fileChecker from './fileChecker';

export default {
    data: () => ({
        compressed: null,
    }),
    async make(file) {
        const that = this;

        if (!file) {
            return;
        }

        new Compressor(file, {
            quality: 0.6,
            maxHeight: 600,
            maxWidth: 600,
            success(result) {
                const myFile = new File([result], result.name, {
                    type: result.type,
                });
                that.init(myFile);
            },
            error(err) {
                console.log(err.message);
            },
        });
        return;
    },
    init(file) {
        this.compressed = file;
    },
    get() {
        return this.compressed;
    }
}