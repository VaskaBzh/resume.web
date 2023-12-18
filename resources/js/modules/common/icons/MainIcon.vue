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

.icon {
    fill: var(--icons-primary, #98a2b3);
    stroke: none;
}

.icon-stroke {
    stroke: var(--icons-primary, #98a2b3);
    fill: none;
}

.icon-warning {
    fill: var(--status-waiting, #ffb868);
    stroke: none;
}

.icon-warning.icon-stroke {
    stroke: var(--status-waiting, #ffb868);
    fill: none;
}

.icon-md {
    width: 24px;
    height: 24px;
    min-width: 24px;
}

.icon-sm {
    width: 16px;
    height: 16px;
}
</style>
