<template>
        <div class="d-flex justify-content-start align-items-center">
            <input type="file" id="file" accept="image/*" ref="file" @change="onChange" style="display: none;" />
            <b-spinner variant="warning" v-if="isLoading" class="mr-2"></b-spinner>
            <b-button v-else variant="light" @click="openFile()" class="mr-2">
                <b-icon icon="image"></b-icon>
            </b-button>
        </div>
</template>

<script>
import axios from 'axios';
import compressor from '../../shared/services/compressor';
import fileChecker from '../../shared/services/fileChecker';
export default {
    name: "UploadChatImage",
    components: {},
    data: () => ({
        images: [],
        isLoading: false,
    }),
    created() {
        
    },
    methods: {
        async onChange(e) {
            this.isLoading = true;
            const file = e.target.files[0];

            if (this.isFileExist(file)) {
                this.isLoading = false;
                return;
            }
            if (fileChecker.isLt2MB(file)) {
                console.log("les than 2bm")
                this.upload(file);
                return;
            }
            if (fileChecker.isGt15MB(file)) {
                this.$refs.toaster.show(
                    "danger",
                    "b-toaster-top-center",
                    "Faild",
                    "File size is too large."
                );
                return;
            }
            await compressor.make(file);
            setTimeout(() => {
                const img = compressor.get();
                console.log('dd; ', img)
                this.upload(img);
            }, 5000);
        },

        upload(img) {
            var fd = new FormData();
            fd.append('chat-image', img)
            axios.post('file/upload', fd).then(res => {
                console.log("uploaded: ",res.data)
                this.isLoading = false;
                this.$emit("uploaded",res.data)
                return;
            }).catch(err => console.log(err.response))
        },

        openFile() {
            this.$refs.file.click()
        },

        remove(img, index) {
            console.log("image: ",img)
            axios.post('file/remove', img).then(res => {
                this.images.splice(index, 1);
                localData.save('item-images', this.images)
            }).catch(err => console.log(err.response))
        },
        isFileExist(file) {
            return (this.images.indexOf(file.name) > -1);
        }
    },

}
</script>
<style lang="scss" scoped>
.b-avatar-img {
    border-radius: 5px !important;
}

.avatar-container {
    position: relative;
    border-radius: 5px;
}

.close-icon {
    display: none !important;
    position: absolute;
    right: -2px;
    top: -2px;
}

.avatar-container:hover {
    .close-icon {
        display: block !important;
    }
}
</style>