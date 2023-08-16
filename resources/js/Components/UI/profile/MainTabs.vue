<template>
    <div class="cabinet__buttons">
        <button
            class="cabinet_button"
            :key="button.title + i"
            v-for="(button, i) in buttons"
            :class="{ active: button.value === active }"
            @click="$emit('getValue', button.value)"
        >
            {{ button.title }}
        </button>
    </div>
</template>

<script>
export default {
    name: "main-tabs",
    props: {
        buttons: Array,
        active: Number,
    },
};
</script>

<style scoped lang="scss"></style>
