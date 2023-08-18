<template>
    <div class="list">
        <grade-row :row="mainRow" class="row-blue" />
        <grade-row
            v-for="(row, i) in gradeList"
            :row="row"
            :key="i"
            :class="{ 'row-last': i === gradeList.length - 1 }"
        />
    </div>
</template>

<script>
import GradeRow from "@/modules/referral/Components/UI/GradeRow.vue";

export default {
    name: "info-list",
    components: {
        GradeRow,
    },
    props: {
        gradeList: Array,
    },
    data() {
        return {
            mainRow: {
                percent: "Ваш %",
                hashrate: "Хешрейт (PH/s)",
            },
        };
    },
};
</script>

<style scoped lang="scss"></style>
