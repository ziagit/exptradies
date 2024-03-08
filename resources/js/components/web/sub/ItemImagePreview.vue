<template>
    <div>
        <b-img :src="'/images/pub/' + image.name" fluid alt="Item Image"></b-img>
    </div>
</template>

<script>
export default {
    props: ["image"],
};
</script>
