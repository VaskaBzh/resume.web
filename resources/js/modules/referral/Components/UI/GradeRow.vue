<template>
    <div class="row">
        <span class="row_text"> {{ row.percent }}</span>
        <span class="row_text row_text-full">{{ row.hashrate }}</span>
    </div>
</template>

<script>
export default {
    name: "grade-row",
    props: {
        row: Object,
    },
};
</script>

<style scoped lang="scss">
.row {
    width: 100%;
    display: inline-flex;
    justify-content: space-between;
    padding: 5px 0;
    &:not(.row-last) {
        border-bottom: 0.5px solid rgba(126, 126, 126, 0.3);
    }
    &-blue {
        .row {
            &_text {
                color: var(--blue-90, #5389e1);
                font-size: 14px;
                font-weight: 500;
            }
        }
    }
    &_text {
        color: var(--light-theme-gray-3, #818c99);
        font-family: AmpleSoftPro, serif;
        font-size: 18px;
        font-weight: 400;
        display: inline-flex;
        align-items: center;
        line-height: 100%;
        text-align: left;
        min-height: 28px;
        &-full {
            min-width: 102px;
        }
    }
}
</style>
