<template>
    <div>
        <div class="d-flex justify-content-between align-items-center" v-if="isLoading">
            <b-spinner variant="primary"></b-spinner>
        </div>
        <div v-else class="d-flex justify-content-between align-items-center">
            <input type="file" id="file" accept="image/*" ref="file" @change="onChange" style="display: none;" />
            <div class="d-flex flex-wrap">
                <div class="m-2 avatar-container" @click="openFile()">
                    <b-avatar square href="#" :src="'/storage/images/blog/' + image" size="4.5rem" variant="light">
                    </b-avatar>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import compressor from '../../../shared/services/compressor';
import fileChecker from '../../../shared/services/fileChecker';
export default {
    name: "UploadBlogImage",
    props: ['blog'],
    data: () => ({
        image: null,
        isLoading: false,
    }),
    created() {
        this.image = this.blog.image;
    },
    methods: {
        async onChange(e) {
            this.isLoading = true;
            const file = e.target.files[0];

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
            fd.append('blog-image', img)
            fd.append('blog', this.blog.id)
            axios.post('file/upload', fd).then(res => {
                this.isLoading = false;
                this.image = res.data.name
                console.log("upload:", res.data)
                this.update(res.data.name);
            }).catch(err => console.log(err.response))
        },
        update(img){
            axios.put("admin/blog/"+this.blog.id, {
                title:this.blog.title,
                body:this.blog.body,
                image:img}).then(res=>{
                console.log("resssss: ",res.data)
            }).catch(err=>console.log(err));
        },
        openFile() {
            this.$refs.file.click()
        },
    },

}
</script>
<style lang="scss" scoped>
.b-avatar-img {
    border-radius: 5px !important;
}

.avatar-container {
    border-radius: 5px;
}


.avatar-container:hover {
    .close-icon {
        display: block !important;
    }
}
</style>