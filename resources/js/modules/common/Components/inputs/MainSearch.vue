<template>
    <div class="search" @click="focusInput">
        <transition name="fade_in">
            <search-icon
                class="search_icon"
                v-show="searchValue.length === 0"
            />
        </transition>
        <input
            ref="input"
            type="text"
            class="search_input"
            v-model="searchValue"
            :placeholder="placeholder"
        />
        <transition name="fade_in">
            <div
                class="search_drop"
                 @click="dropSearchValue"
                v-show="searchValue.length > 0"
            >
                {{ $t("search.drop") }}
            </div>
        </transition>
    </div>
</template>

<script>
import SearchIcon from "@/modules/common/icons/SearchIcon.vue";
import { CommonMessages } from "@/modules/common/lang/CommonMessages";

export default {
    name: "main-search",
    components: {
        SearchIcon
    },
    i18n: {
        sharedMessages: CommonMessages,
    },
    props: {
        placeholder: String,
    },
    data() {
        return {
            searchValue: "",
            timeOut: null,
        };
    },
    watch: {
        searchValue(newValue) {
            clearTimeout(this.timeOut);
            this.timeOut = setTimeout(() => this.$emit("searched", newValue), 1000);
        },
    },
    methods: {
        dropSearchValue() {
            this.searchValue = "";
        },
        focusInput() {
            this.$refs.input.focus();
        }
    }
};
</script>

<style scoped lang="scss">
.fade_in-enter-active,
.fade_in-leave-active {
    transition: all 0.5s ease;
}
.fade_in-enter-from,
.fade_in-leave-to {
    opacity: 0;
}
.search {
    max-width: 250px;
    width: 100%;
    min-height: 40px;
    display: inline-flex;
    align-items: center;
    padding: 0 12px;
    gap: 8px;
    cursor: pointer;
    border-radius: 12px;
    background: var(--background-island, #FFF);
    box-shadow: 0 2px 12px -5px rgba(16, 24, 40, 0.02);
    @media (max-width: $mobile) {
        max-width: 100%;
    }
    &_icon {
        width: 24px;
        height: 24px;
    }
    &_input {
        outline: none;
        border: none;
        background: transparent;
        color: var(--text-secondary, #475467);
        font-family: NunitoSans , serif;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        &::placeholder {
            color: var(--select-text-no-value, var(--gray-3100, #D0D5DD));
        }
    }
    &_drop {
        color: var(--buttons-ghost-text-default, #53B1FD);
        text-align: center;
        font-family: NunitoSans, serif;
        font-size: 12px;
        font-weight: 600;
        line-height: 16px;
    }
}
</style>
