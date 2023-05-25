<template>
    <div class="copy__block">
        <div class="copy__row">
            {{ this.copyObject.title }}
        </div>
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
        gap: 20px;
        @media (max-width: 767.98px) {
            max-width: 100%;
            //&:not(:first-child) {
            .connecting__row {
                &:first-child {
                    margin-bottom: -16px;
                }
            }
            //}
            &:last-child {
                gap: 6px;
                .connecting__row {
                    flex-direction: row;
                    margin-top: 6px;
                    margin-bottom: 0 !important;
                }
            }
        }
    }
    &__row {
        display: inline-flex;
        align-items: center;
        font-weight: 400;
        font-size: 18px;
        line-height: 18px;
        color: rgba(0, 0, 0, 0.62);
        @media (max-width: 767.98px) {
            font-size: 16px;
            line-height: 23px;
            color: #818c99;
        }
        span {
            margin: 0 3px;
            font-weight: 700;
        }
    }
}
</style>
