<template>
    <div class="warning">
        <warning-icon class="warning_icon" />
        <p class="warning_text">
            В случае изменения адреса кошелька автовыплаты не будут работать в течении 24 часов. Вы будете получать вознаграждения за майнинг, но не сможете вывести их
            на свой кошелек в течении указанного времени.
        </p>
    </div>
</template>

<script>
import WarningIcon from "@/modules/common/icons/WarningIcon.vue";

export default {
    name: "wallets-warning",
    components: {
        WarningIcon,
    }
}
</script>

<style scoped>
.warning {
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-waiting, #37322D);
    padding: 16px;
    display: flex;
    gap: 12px;
    align-items: center;
}
.warning_icon {
    min-width: 24px;
    width: 24px;
    height: 24px;
}
.warning_text {
    color: var(--status-waiting, #FFB868);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
}
</style>
