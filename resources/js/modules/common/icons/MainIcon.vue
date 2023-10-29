<template>
    <svg class="icon" aria-hidden="true">
        <use class="icon_path" :href="symbolId" />
    </svg>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    name: "MainIcon",
    props: {
        prefix: {
            type: String,
            default: "icon",
        },
        name: {
            type: String,
            required: true,
        },
    },
    computed: {
        symbolId() {
            return `#${this.prefix}-${this.name}`;
        },
    },
});
</script>

<style scoped>
.icon {
    width: 32px;
    height: 32px;
}

.icon .icon_path {
    fill: var(--icons-primary, #98a2b3);
}

.icon-stroke .icon_path {
    stroke: var(--icons-primary, #98a2b3);
    fill: none;
}

.icon-md {
    width: 24px;
    height: 24px;
}

.icon-sm {
    width: 16px;
    height: 16px;
}
</style>
