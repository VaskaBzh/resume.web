<template>
    <div
        ref="group"
        class="group"
        :class="{
            'group-closed': !isOpen,
        }"
    >
        <span
            v-if="group.group_name"
            class="group_name"
            @click="toggleDropdown"
        >
            {{ $t(group.group_name) }}
            <dropdown-icon class="group_icon" />
        </span>
        <div class="group__content">
            <div class="group__list">
                <transition-group name="tabs">
                    <nav-tab
                        v-for="(tab, i) in tabs"
                        :key="i"
                        :tab="tab"
                        @click="$emit('closeBurger')"
                    />
                </transition-group>
            </div>
        </div>
    </div>
</template>

<script>
import NavTab from "@/modules/navs/Components/UI/NavTab.vue";
import DropdownIcon from "../../../common/icons/DropdownIcon.vue";

export default {
    name: "NavGroup",
    components: {
        DropdownIcon,
        NavTab,
    },
    props: {
        group: Object,
    },
    data() {
        return {
            isOpen: true,
        };
    },
    computed: {
        tabs() {
            return this.isOpen ? this.group.links : [];
        },
    },
    methods: {
        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
    },
};
</script>

<style scoped lang="scss">
.tabs-enter-active,
.tabs-leave-active {
    transition: all 0.5s ease;
}
.tabs-enter-from,
.tabs-leave-to {
    opacity: 0;
    transform: translateX(-25px);
}
.group {
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 8px;
    transition: all 0.5s ease;
    overflow: hidden;

    &__content {
        width: inherit;
        display: grid;
        grid-template-rows: 1fr;
        transition: all 0.5s ease 0s;
        overflow: hidden;
    }

    &__list {
        @include columnMixin($gap: 8px);
        width: inherit;
        min-height: 0;
    }

    &_name {
        min-height: 32px;
        display: inline-flex;
        gap: 8px;
        justify-content: space-between;
        align-items: center;
        color: var(--text-primary-80);
        font-family: NunitoSans, serif;
        font-size: 18px;
        font-weight: 700;
        line-height: 32px;
        cursor: pointer;
        width: 100%;
    }

    &_icon {
        transition: all 0.5s ease 0s;
        stroke: var(--svg-fill);
    }

    &-closed {
        .group {
            &_icon {
                transform: rotate(180deg);
            }
            &__content {
                grid-template-rows: 0fr;
            }
        }
    }
}
</style>
