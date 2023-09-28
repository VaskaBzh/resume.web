<template>
<div class="security-view">
    <div class="security-view__container">
        <head-line class="security-view_btn">Безопасность</head-line>
    </div>
</div>
</template>



<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";

export default {
    name: "SecurityView",
    components: {HeadLine}
}
</script>



<style scoped lang="scss">
.security-view {
    width: 100vw;
    height: 100vh;
    display: flex;
    flex-flow: column nowrap;
    align-items: center;
    justify-content: center;

    &__container {
        margin: 0 auto;
    }
}
</style>
