<template>
    <div class="row" :class="{ error: error }">
        <input
            :name="name"
            v-model="value"
            :type="type"
            class="row_input"
            :placeholder="placeholder"
            :autocomplete="autocomplete"
        />
    </div>
</template>

<script>
export default {
    name: "auth-input",
    props: {
        error: String,
        model: String,
        placeholder: String,
        name: String,
        type: String,
        autocomplete: String,
    },
    data() {
        return {
            value: "",
        };
    },
    watch: {
        value() {
            this.$emit("change", this.value);
        },
    },
};
</script>

<style scoped lang="scss">
.row {
    gap: 8px;
    min-height: 48px;
    display: flex;
    position: relative;
    &.error {
        input {
            color: #e5403f;
            border-color: #e5403f;
            &::placeholder {
                color: rgba(124, 124, 124, 0.7);
            }
        }
        svg,
        svg path {
            fill: #e5403f;
        }
    }
    svg,
    svg path {
        width: 32px;
        height: 32px;
        fill: rgba(124, 124, 124, 0.7);
        transition: all 0.5s ease 0s;
    }
    &_input {
        &::placeholder {
            color: rgba(124, 124, 124, 0.7);
            transition: all 0.5s ease 0s;
        }
        outline: none;
        width: 100%;
        color: #000;
        font-size: 24px;
        font-family: AmpleSoftPro, serif;
        line-height: 135%;
        border-radius: 8px;
        border: 1px solid transparent;
        min-height: 56px;
        transition: all 0.5s ease 0s;
        padding: 0 16px;
        background: linear-gradient(
            179deg,
            #e6eaf0 0%,
            #e6eaf1 20.89%,
            #e7ebf1 42.88%,
            #eaeef4 76.04%,
            #e8ecf2 100%
        );
        @media (max-width: 479.98px) {
            color: #000;
            font-size: 16px;
            font-family: Ubuntu, serif;
            line-height: 130%;
            min-height: 48px;
        }
        &:active,
        &:focus {
            border-color: #9fbdee;
            background: linear-gradient(
                179deg,
                #e6eaf0 0%,
                #e6eaf1 20.89%,
                #e7ebf1 42.88%,
                #eaeef4 76.04%,
                #e8ecf2 100%
            ) !important;
        }
    }
    &_content {
        display: flex;
        flex-direction: column;
        max-width: 536px;
        width: 100%;
        gap: 16px;
        @media (max-width: $mobile) {
            max-width: 408px;
        }
        @media (max-width: $mobileSmall) {
            max-width: 100%;
            gap: 8px;
        }
    }
}
</style>
