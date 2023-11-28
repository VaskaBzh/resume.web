<template>
    <th class="column">
        <span class="column_value">{{ $t(title) }}</span>
        <span v-show="$slots" class="column__block">
            <slot />
        </span>
        <main-icon
            v-if="getTooltipConfig(title)"
            v-tooltip="{ content: getTooltipConfig(title) }"
            name="info"
            class="icon-sm column_icon"
        />
    </th>
</template>

<script>
import { TableMessages } from "@/modules/table/lang/TableMessages";
import { TitleContentEnum } from "@/modules/table/enums/TitleContentEnum";
import MainIcon from "@/modules/common/icons/MainIcon.vue";

export default {
    name: "TitleColumn",
    components: { MainIcon },
    i18n: {
        sharedMessages: TableMessages,
    },
    props: {
        title: String,
        titleIndex: {
            type: Number,
        },
        titleLength: {
            type: Number,
        },
    },
    methods: {
        getTooltipConfig(title) {
            if (TitleContentEnum[title]) {
                return this.$t(TitleContentEnum[title]);
            }
        },
    },
};
</script>

<style scoped lang="scss">
.column {
    height: 40px;
    white-space: nowrap;
    &_icon {
        margin: 0 6px -3px 0;
        cursor: pointer;
        fill: var(--icons-secondary);
    }
}
.column:first-child .column_value {
    padding-left: 12px;
}
.column_value {
    color: var(--text-table-title, #43474e);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    padding-top: 8px;
}
.column__block {
    margin-left: 6px;
    display: inline-flex;
}
</style>
