<template>
    <div class="headline">
        <span class="headline_text">
            <slot />
        </span>
    </div>
</template>

<script>
export default {
    name: "landing-headline",
};
</script>

<style scoped>
.headline {
    border-radius: 30px;
    border: 0.5px solid var(--secondary-gray, #98a2b3);
    padding: 4px 24px;
    min-height: 52px;
    width: fit-content;
    display: inline-flex;
    align-items: center;
}
.headline_text {
    color: var(--gray-3100, #D0D5DD);
    font-family: Unbounded, serif;
    font-size: 20px;
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
    white-space: nowrap;
}
</style>
