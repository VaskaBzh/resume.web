<template>
    <div class="tittle">
        <slot/>
    </div>
</template>

<script>
export default {
    name: "calculator-title"
}
</script>

<style scoped lang="scss">
.title {
    font-family: SFPro, serif;
    font-weight: 500;
    &-white {
        color: #ffffff;
    }
    &-h1 {
        font-size: 44px;
        line-height: 120%;
    }
    &-h2 {
        font-size: 28px;
    }
}
</style>
