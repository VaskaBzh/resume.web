<template>
    <div class="copy__block">
        <span class="text">
            {{ this.copyObject.title }}
        </span>
        <copy-row
            v-for="(copy, i) in this.copyObject.copyObject"
            :key="i"
            :copyObject="copy"
        ></copy-row>
    </div>
</template>

<script>
import CopyRow from "@/Components/UI/profile/CopyRow.vue";

export default {
    components: { CopyRow },
    name: "copy-block",
    props: {
        copyObject: Object,
    },
};
</script>

<style scoped lang="scss">
.copy {
    &__block {
        display: flex;
        flex-direction: column;
        gap: 22px;
        flex: 1 1 auto;
        //@media (max-width: 767.98px) {
        //.connecting__row {
        //    &:first-child {
        //        margin-bottom: -16px;
        //    }
        //}
        //&:last-child {
        //    gap: 6px;
        //    .connecting__row {
        //        flex-direction: row;
        //        margin-top: 6px;
        //        margin-bottom: 0 !important;
        //    }
        //}
        //}
    }
}
</style>
