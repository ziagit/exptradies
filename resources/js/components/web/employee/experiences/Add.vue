<template>
    <div>
    <b-spinner v-if="isLoading"></b-spinner>
    <b-form-file
        v-else
      v-model="image"
      placeholder="Upload a new file"
      @change="onChange"
      accept="image/*"
    ></b-form-file>
    </div>
</template>
<script>
import axios from 'axios';
import compressor from '../../../shared/services/compressor';
import fileChecker from '../../../shared/services/fileChecker';
export default{
    data:()=>({
        image: null,
        isLoading: false,
    }),
    methods:{
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
            fd.append('galery-image', img)
            axios.post('file/upload', fd).then(res => {
                this.save(res.data)
            }).catch(err => console.log(err.response))
        },

        save(data) {
            axios.post('employee/galery',{image:data.name}).then(res=>{
                this.isLoading = false;
                this.$emit('uploaded')
            })
            isLoading=false
        },
    }
}
</script>