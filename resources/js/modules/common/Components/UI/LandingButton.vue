<template>
    <button class="button">
        <span class="button_icon" v-show="$slots.svg">
            <slot name="svg"/>
        </span>
        <slot name="text"/>
    </button>
</template>

<script>
export default {
    name: "landing-button",
};
</script>

<style scoped>
.button {
    border: 1px solid rgba(192, 228, 255, 0.6);
    background: var(--gray-480, rgba(13, 13, 13, 0.8));
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    padding: 8px 20px;
    min-height: 56px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    outline: none;
    color: var(--gray-1100, #F5FAFF);
    font-family: Unbounded, serif;
    font-size: 18px;
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
    border-radius: 40px;
    max-width: 860px;
    width: 100%;
    white-space: pre-wrap;
}

.button_icon {
    width: 24px;
    height: 24px;
    stroke: #2e90fa;
}

.button-disabled {
    opacity: 0.5;
}

@media (max-width: 485px) {
    .hero_button, .about-view_btn {
        width: 100%;
        font-size: 14px;
        margin: 0 auto;
        min-height: 40px;
    }

    .about-view_btn, .cabinet_btn {
        font-size: 12px;
        min-height: 45px;
    }

}

</style>
