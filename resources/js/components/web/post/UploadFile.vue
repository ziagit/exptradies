<template>
    <div>
        <div class="my-2">
            <div class="d-flex justify-content-start align-items-center">
                <input type="file" id="file" accept="image/*" ref="file" @change="onChange" style="display: none;" />
                <b-spinner variant="warning" v-if="isLoading" class="mr-2"></b-spinner>
                <b-button v-else variant="light" @click="openFile()" class="mr-2">
                    <b-icon icon="camera"></b-icon>
                </b-button>
                <small>Uploading photos of the job will help traders to be prepared.</small>
            </div>
        </div>
        <div v-if="images.length > 0" class="d-flex justify-content-between align-items-center">
            <div class="d-flex flex-wrap">
                <div v-for="(img, index) in images" :key="index" class="m-2 avatar-container">
                    <b-avatar square href="#" :src="'/storage/images/posts/' + img.name" size="4.5rem" variant="light">
                    </b-avatar>
                    <b-icon class="close-icon" icon="x-circle-fill" variant="dark" @click="remove(img, index)">
                    </b-icon>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import compressor from '../../shared/services/compressor';
import fileChecker from '../../shared/services/fileChecker';
import localData from '../../shared/services/localData';
export default {
    name: "UploadItemImage",
    components: {},
    data: () => ({
        images: [],
        isLoading: false,
    }),
    created() {
        this.get()
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
                this.upload(img);
            }, 5000);
        },

        upload(img) {
            var fd = new FormData();
            fd.append('post-image', img)
            axios.post('file/upload', fd).then(res => {
                console.log("uploaded: ",res.data)
                this.images.push(res.data);
                localData.save('item-images', this.images)
                this.isLoading = false;
                return;
            }).catch(err => console.log(err.response))
        },

        openFile() {
            this.$refs.file.click()
        },

        get() {
            const imgs = localData.read('item-images')
            if (imgs) {
                this.images = imgs
            }
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