<template>
    <button class="button-blue">
        <slot></slot>
    </button>
</template>

<script>
export default {
    name: "button-blue",
};
</script>

<style scoped>
.button-blue {
    width: 100%;
    border-radius: 12px;
    background: var(--primary-500, #2E90FA);
    box-shadow: 0 10px 10px -6px rgba(0, 0, 0, 0.10);
    border: none;
    outline: none;
    min-height: 56px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--light-secondary-wb, #FFF);
    font-family: NunitoSans, serif;
    font-size: 18px;
    font-weight: 700;
    line-height: 32px;
    padding: 0 12px;
    transition: all 0.5s ease 0s;
}
</style>
