<template>
    <td class="column">
        <span v-show="!!title" class="column_title">{{ title }}</span>
        <span
            v-show="value !== null"
            class="column_value"
            v-html="renderedValue"
        ></span>
        <span v-show="!!$slots.icon" class="column_icon">
            <slot name="icon" />
        </span>
    </td>
</template>

<script>
import { SubsCustomFunctions } from "@/modules/table/functionsMap/SubsCustomFunctions";
import { ColumnService } from "@/modules/table/services/ColumnService";
import { IncomeTableMessages } from "@/modules/income/lang/IncomeTableMessages";

export default {
    name: "RowColumn",
    props: {
        value: {
            type: String,
            default: null,
        },
        title: String,
        columnKey: String,
    },
    i18n: {
        sharedMessages: IncomeTableMessages,
    },
    data() {
        return {
            renderedValue: this.value,
            service: new ColumnService(),
        };
    },
    watch: {
        value() {
            this.initRenderFunctions();
        },
        "service.renderedValue"(newRenderedValue) {
            this.renderedValue = newRenderedValue;
        },
    },
    mounted() {
        this.initRenderFunctions();
    },
    methods: {
        initRenderFunctions() {
            const functionName = SubsCustomFunctions[this.columnKey];

            if (functionName) {
                this.service[functionName](this.value, this.$t);
            } else {
                this.renderedValue = this.value;
            }
        },
    },
};
</script>

<style scoped lang="scss">
.column {
    height: 48px;
    background: var(--background-island, #212327);
    border-top-width: 1px;
    border-bottom-width: 1px;
    border-style: solid;
    border-color: transparent;
    transition: all 0.5s ease 0s;
    white-space: nowrap;
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
        &:not(.column-income) {
            display: flex;
            flex-direction: column;
            .column_title {
                display: inline-flex;
            }
        }
    }
}
.active .column_value,
.inactive .column_value,
.unstable .column_value,
.ACTIVE .column_value,
.INACTIVE .column_value,
.UNSTABLE .column_value {
    height: 24px;
    border-radius: 8px;
    padding: 8px;
}
.active .column_value,
.ACTIVE .column_value {
    color: var(--status-succesfull, #1fb96c);
    background: var(--background-success, #21322e);
}
.unstable .column_value,
.UNSTABLE .column_value {
    color: var(--status-waiting, #ffb868);
    background: var(--background-waiting, #fff8f0);
}
.inactive .column_value,
.INACTIVE .column_value {
    color: var(--status-failed, #f1404a);
    background: var(--background-failed, #feeced);
}
.column_title {
    color: var(--text-table-title, #98a2b3);
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
