<template>
    <div class="select">
        <div
            class="select_name"
            :class="{ 'select_name-active': opened }"
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
            <div class="select_list" v-show="opened">
                <div
                    class="select_row"
                    v-for="(row, i) in rows"
                    :key="i"
                    @click="changeValue(row.name)"
                >
                    {{ row.name }}
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name: "referral-select",
    props: {
        rows: Array,
    },
    data() {
        return {
            baseName: "Субаккаунт",
            opened: false,
        };
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
    },
    methods: {
        changeValue(targetName) {
            this.baseName = targetName;

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
    beforeUnmount() {
        document.removeEventListener("click", this.onDocumentClick);
        document.removeEventListener("keydown", this.onEscapeKeydown);
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
    &_name {
        position: relative;
        padding: 0 16px;
        min-height: 48px;
        display: inline-flex;
        align-items: center;
        border-radius: 8px;
        background: #ededed;
        width: 100%;
        transition: all 0.3s ease 0s;
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
            background: #fafafa;
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
        background: #fafafa;
        width: 100%;
        left: 0;
        top: calc(100% + 8px);
        box-shadow: 2px 2px 4px -2px rgba(29, 41, 57, 0.05),
            0px 4px 12px -4px rgba(29, 41, 57, 0.05);
    }
    &_row {
        min-height: 48px;
        padding: 0 16px;
        display: inline-flex;
        align-items: center;
        width: 100%;
        &:not(:last-child) {
            border-bottom: 0.5px solid #e4e7ec;
        }
    }
}
</style>
