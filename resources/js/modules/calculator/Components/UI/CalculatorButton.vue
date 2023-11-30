<template>
    <button class="button">
        <slot/>
    </button>
</template>

<script>
export default {
    name: "calculator-button"
}
</script>

<style scoped lang="scss">
.button {
    padding: 11px 101px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    font-size: 22px;
    color: #F5FAFF;
    font-weight: 500;
    line-height: 28px;
    text-align: center;
    width: fit-content;
    border-radius: 16px;
    border: 1px solid;
    border-image: linear-gradient(to left, #FFFFFF, #4A96FF) 10%;
}
</style>
