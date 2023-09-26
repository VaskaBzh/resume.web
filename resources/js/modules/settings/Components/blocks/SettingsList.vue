<template>
    <div class="list">
        <!--                <main-title class="headline list_title" tag="h4">{{-->
        <!--                    $t("settings.block.titles[0]")-->
        <!--                }}</main-title>-->
        <settings-row
            @openPopup="$emit('openPopup', $event)"
            :name="row.title"
            :val="row.value"
            :svg="row.svg"
            :keyForm="row.name"
            v-for="(row, i) in rows"
            :key="i"
            :verifyTimer="verifyTimer"
        />
<!--        <button @click="$emit('send2fac')">2fac</button>-->
    </div>
</template>

<script>
import SettingsRow from "@/modules/settings/Components/UI/SettingsRow.vue";

export default {
    name: "settings-form",
    props: {
        rows: Array,
        verifyTimer: Number,
    },
    components: {
        SettingsRow,
    },
};
</script>

<style scoped lang="scss">
.list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    width: 100%;
    @media (max-width: $tablet) {
        gap: 12px;
    }
}
</style>
