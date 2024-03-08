<template>
    <b-list-group>
        <div v-for="(not, index) in notifications" :key="index">
            <b-list-group-item button class="  item" @click="open(not)">
                <span :class="{ read: not.pivot.read_at == null }"> {{ not.title }}
                </span>
                <b-badge v-if="not.pivot.read_at == null" variant="primary">new</b-badge>
            </b-list-group-item>
        </div>
    </b-list-group>
</template>
<script>
export default {
    props: ['notifications'],
    methods: {
        open(not) {
            this.$parent.details(not);
        },
    },
};
</script>
<style lang="scss" scoped>
.read {
    font-weight: 600;
}
</style>
