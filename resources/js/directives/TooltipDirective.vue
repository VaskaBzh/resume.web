<script>
import tippy from "tippy.js";
import "tippy.js/dist/tippy.css";
import "tippy.js/themes/light-border.css";
import "tippy.js/animations/shift-away-extreme.css";

export default {
    mounted(el, binding) {
        tippy(el, {
            content: binding.value,
            animation: "shift-away-extreme",
            flip: true,
            flipOnUpdate: true,
            theme: "custom-theme",
        });
    },
    updated(el, binding) {
        if (el._tippy) {
            el._tippy.setContent(binding.value);
        }
    },
    unmounted(el) {
        if (el._tippy) {
            el._tippy.destroy();
        }
    },
};
</script>

<style>
.tippy-box[data-theme~="custom-theme"] {
    border-radius: 12px;
    border: 1px solid var(--tooltip-body-color);
    background-color: var(--tooltip-body-color);
    color: var(--tooltip-text-color);
    padding: 12px;
    box-shadow: 0px 2px 12px -1px rgba(16, 24, 40, 0.08);
}

.tippy-box[data-theme~="custom-theme"] .tippy-arrow {
    color: var(--tooltip-body-color);
}
</style>
