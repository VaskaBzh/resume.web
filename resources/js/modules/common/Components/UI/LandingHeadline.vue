<template>
    <div class="headline">
        <span class="headline_text">
            <slot/>
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
    min-height: clamp(48px, 1vw, 52px);
    width: fit-content;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: clamp(50px, 10vw, 100px);
}

.headline_text {
    color: var(--gray-3100, #d0d5dd);
    font-family: Unbounded, serif;
    font-size: clamp(14px, 3vw, 20px);
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
    white-space: nowrap;
}
</style>
