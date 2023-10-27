<template>
    <div class="select">
        <div
            ref="select"
            class="select_name"
            :class="{
                'select_name-active': opened,
                'select_name-selected': validateBaseName,
            }"
            @click="toggleSelect"
        >
            {{ baseName }}
            <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M18 10L12 16L6 10"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </div>
        <transition name="list">
            <div v-show="opened" class="select_list">
                <div
                    v-for="(row, i) in rows"
                    :key="i"
                    class="select_row"
                    @click="changeValue(row.name, row.group_id)"
                >
                    {{ row.name }}
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import { ReferralsMessage } from "../../lang/ReferralsMessage";

export default {
    name: "ReferralSelect",
    props: {
        rows: Array,
        activeSubId: String,
    },
    i18n: {
        sharedMessages: ReferralsMessage,
    },
    data() {
        return {
            baseName: this.$t("incomes.base_value"),
            opened: false,
        };
    },
    computed: {
        validateBaseName() {
            return (
                this.baseName ===
                Object.values(this.rows).find(
                    (el) => el.group_id === this.activeSubId ?? 0
                )?.name
            );
        },
    },
    watch: {
        opened(value) {
            if (value) {
                document.addEventListener("click", this.onDocumentClick);
                document.addEventListener("keydown", this.onEscapeKeydown);
            } else {
                document.removeEventListener("click", this.onDocumentClick);
                document.removeEventListener("keydown", this.onEscapeKeydown);
            }
        },
        activeSubId() {
            this.setBaseName();
        },
        rows() {
            this.setBaseName();
        },
    },
    mounted() {
        this.setBaseName();
    },
    beforeUnmount() {
        document.removeEventListener("click", this.onDocumentClick);
        document.removeEventListener("keydown", this.onEscapeKeydown);
    },
    methods: {
        setBaseName() {
            if (this.activeSubId && Object.entries(this.rows)?.length > 0) {
                this.baseName = Object.values(this.rows).find(
                    (el) => el.group_id === this.activeSubId
                ).name;
            }
        },
        changeValue(targetName, id) {
            if (this.baseName !== targetName) {
                this.baseName = targetName;

                this.$emit("changeSub", id);
            }

            this.closeSelect();
        },
        toggleSelect() {
            this.opened = !this.opened;
        },
        closeSelect() {
            this.opened = false;
        },
        onDocumentClick(e) {
            if (!this.$el.contains(e.target)) {
                this.closeSelect();
            }
        },
        onEscapeKeydown(e) {
            if (e.keyCode === 27) {
                this.closeSelect();
            }
        },
    },
};
</script>

<style scoped lang="scss">
.list-leave-active,
.list-enter-active {
    transition: all 0.3s ease 0s;
}
.list-leave-to,
.list-enter {
    opacity: 0;
    visibility: hidden;
}
.select {
    color: #d6d6d6;
    font-size: 18px;
    font-weight: 400;
    line-height: 135%;
    position: relative;
    height: 48px;
    width: 100%;
    cursor: pointer;
    transition: all .3s;
    &_name {
        position: relative;
        min-height: 48px;
        display: inline-flex;
        align-items: center;
        padding: var(--py-4, 16px) var(--px-4, 16px);
        border-radius: var(--surface-border-radius-radius-s-md, 12px);
        background: var(--background-island-inner-3);
        box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.01);
        width: 100%;
        transition: all 0.3s ease 0s;
        &-selected {
            background: var(--background-island-inner-3);
            color: #d6d6d6;
        }
        svg {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 16px;
            width: 24px;
            height: 24px;
            stroke: #818c99;
            transform-origin: center;
            transition: all 0.3s ease 0s;
        }
        &-active {
            box-shadow: 2px 2px 4px -2px rgba(29, 41, 57, 0.05),
                0px 4px 12px -4px rgba(29, 41, 57, 0.05);
            svg {
                transform: translateY(-50%) rotate(180deg);
            }
        }
    }
    &_list {
        position: absolute;
        display: flex;
        flex-direction: column;
        border-radius: 12px;
        overflow: hidden;
        background: var(--background-island-inner-3, #fff);
        z-index: 2;
        width: 100%;
        left: 0;
        top: calc(100% + 11px);
        box-shadow: 2px 2px 4px -2px rgba(29, 41, 57, 0.05),
            0px 4px 12px -4px rgba(29, 41, 57, 0.05);
        transition: all 0.5s ease 0s;
    }
    &_row {
        min-height: 48px;
        padding: 0 16px;
        display: inline-flex;
        align-items: center;
        width: 100%;
        transition: all 0.5s ease 0s;
        &:hover,
        &:focus {
            background: var(
                --background-island-inner-1,
                rgba(83, 177, 253, 0.07)
            );
            transition: all 0.5s ease 0s;
        }
        &:not(:last-child) {
            border-bottom: 0.5px solid var(--background-graphic-line);
        }
    }
}
</style>
