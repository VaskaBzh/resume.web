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
import { ReferralsMessage } from "../../lang/ReferralsMessage";

export default {
    name: "info-list",
    components: {
        GradeRow,
    },
    props: {
        gradeList: Array,
    },
    i18n: {
        sharedMessages: ReferralsMessage,
    },
    computed: {
        mainRow() {
            return {
                percent: this.$t("grade.labels[0]"),
                hashrate: this.$t("grade.labels[1]"),
            };
        },
    },
};
</script>

<style scoped lang="scss"></style>
