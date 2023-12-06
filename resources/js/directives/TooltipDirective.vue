<script>
import tippy from "tippy.js";
import "tippy.js/dist/tippy.css";
import "tippy.js/themes/light-border.css";
import "tippy.js/animations/shift-away-extreme.css";
import {mapGetters} from "vuex";
import viewportWidth from "@/store/modules/ViewportWidth";

export default {
    mounted(el, binding) {
        const maxWidth = '100%';

        tippy(el, {
            content: binding.value.content || "",
            animation: "shift-away-extreme",
            flip: true,
            flipOnUpdate: true,
            theme: "custom-theme",
            maxWidth: maxWidth,
            allowHTML: true,
            margin: '0 auto',
        });
    },
    updated(el, binding) {
        if (el._tippy) {
            el._tippy.setContent(binding.value.content || "");
        }
    },

    unmounted(el) {
        if (el._tippy) {
            el._tippy.destroy();
        }
    },
};
</script>

<style lang="scss">
.tippy-box[data-theme~="custom-theme"] {
    border-radius: 12px;
    border: 1px solid var(--tooltip-body-color);
    background-color: var(--tooltip-body-color);
    color: var(--text-secondary, #475467);
    font-family: NunitoSans, serif;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
    line-height: 16px;
    padding: 12px;
    box-shadow: 0px 2px 12px -1px rgba(16, 24, 40, 0.08);
}

.tippy-box[data-theme~="custom-theme"] .tippy-arrow {
    color: var(--tooltip-body-color);
}
.tooltip {
    &__list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        font-family: NunitoSans, serif;
        font-size: 12px;
        font-weight: 600;
        line-height: 16px;
    }
    &_row {
        display: flex;
        gap: 6px;
        align-items: center;
        @media (min-width: $mobileSmall) {
            white-space: nowrap;
        }
    }
    &_status {
        border-radius: 8px;
        background: var(--background-island-inner-1, rgba(83, 177, 253, 0.07));
        color: var(--icons-focus, #2e90fa);
        text-align: center;
        display: inline-flex;
        min-width: 100px;
        align-items: center;
        justify-content: center;
        min-height: 24px;
        &-complete {
            background: var(--background-success, #e9f8f1);
            color: var(--status-succesfull, #1fb96c);
        }
        &-checking {
            background: var(
                --background-island-inner-1,
                rgba(83, 177, 253, 0.07)
            );
            color: var(--icons-focus, #2e90fa);
        }
        &-pending {
            background: var(--background-waiting, #fff8f0);
            color: var(--status-waiting, #ffb868);
        }
        &-reject {
            background: var(--background-failed, #feeced);
            color: var(--status-failed, #f1404a);
        }
        &-no_wallet {
            background: var(--background-island-inner-3, #f6f6f6);
            color: var(--status-death, #667085);
        }
    }
}
</style>
