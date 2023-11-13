<template>
    <td class="column">
        <span class="column_title" v-show="!!title">{{ title }}</span>
        <span class="column_value" v-show="value !== null" v-html="renderedValue"></span>
        <span class="column_icon" v-show="!!$slots.icon">
            <slot name="icon" />
        </span>
    </td>
</template>

<script>
import { SubsCustomFunctions } from "@/modules/table/functionsMap/SubsCustomFunctions";
import { ColumnService } from "@/modules/table/services/ColumnService";
import loginForm from "../../../auth/Components/blocks/LoginForm.vue";

export default {
    name: "row-column",
    props: {
        value: {
            type: String,
            default: null,
        },
        title: String,
        columnKey: String,
        unit: String,
    },
    watch: {
        value() {
            this.initRenderFunctions();
        },
        "service.renderedValue"(newRenderedValue) {
            this.renderedValue = newRenderedValue;
        }
    },
    data() {
        return {
            renderedValue: this.value,
            service: new ColumnService(),
        };
    },
    methods: {
        initRenderFunctions() {
            const functionName = SubsCustomFunctions[this.columnKey];
            if (functionName) {
                this.service[functionName](this.value, this.unit);
            } else {
                this.renderedValue = this.value;
            }
        }
    },
    mounted() {
        this.initRenderFunctions();
    }
}
</script>

<style scoped>
.column {
    height: 48px;
    background: var(--background-island, #212327);
    border-top-width: 1px;
    border-bottom-width: 1px;
    border-style: solid;
    border-color: transparent;
    transition: all 0.5s ease 0s;
}
.column:first-child {
    border-radius: 8px 0 0 8px;
    border-left-width: 1px;
}
.column:first-child .column_value {
    padding-left: 12px;
}
.column:last-child {
    border-radius: 0 8px 8px 0;
    border-right-width: 1px;
}
@media (max-width: $mobile) {
    .column {
        display: flex;
        flex-direction: column;
    }
    .column_title {
        display: inline-flex;
    }
}
.active .column_value,
.inactive .column_value,
.unstable .column_value,
.ACTIVE .column_value,
.INACTIVE .column_value,
.UNSTABLE .column_value,
.error .column_value,
.complete .column_value,
.completed .column_value,
.pending .column_value,
.rejected .column_value {
    height: 24px;
    border-radius: 8px;
    padding: 8px;
}
.active .column_value,
.ACTIVE .column_value,
.complete .column_value,
.completed .column_value {
    color: var(--status-succesfull, #1FB96C);
    background: var(--background-success, #21322E);
}
.unstable .column_value,
.UNSTABLE .column_value,
.pending .column_value {
    color: var(--status-waiting, #FFB868);
    background: var(--background-waiting, #FFF8F0);
}
.inactive .column_value,
.INACTIVE .column_value,
.rejected .column_value {
    color: var(--status-failed, #F1404A);
    background: var(--background-failed, #FEECED);
}
.column_title {
    color: var(--text-table-title, #98A2B3);
    font-family: NunitoSans, serif;
    font-size: 12px;
    font-weight: 600;
    line-height: 16px;
    display: none;
}
.column_value {
    color: var(--text-teritary);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
}
@media (min-width: 767.98px) {
    .column_icon,
    .column_value {
        min-height: 100%;
        width: 100%;
        display: inline-flex;
        align-items: center;
    }
}
.column_icon {
    margin-left: 8px;
    display: inline-flex;
}
</style>
