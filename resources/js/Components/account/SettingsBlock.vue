<template>
    <div class="wrap__block wrap__column" ref="wrap">
        <div class="wrap__head">
            <span class="name">{{ this.name }}</span>
            <span
                class="change"
                v-if="!this.text"
                ref="link"
                @click="change_val"
            >
                Изменить
            </span>
            <main-checkbox
                :is_checked="this.value"
                @is_checked="checkbox_changes"
                v-if="this.text"
            ></main-checkbox>
        </div>
        <p class="text" v-if="this.text">{{ this.text }}</p>
        <input
            v-model="this.value"
            ref="input"
            disabled
            v-if="!this.text"
            :type="this.name === 'Пароль' ? 'password' : 'text'"
            class="input input-no-bg"
        />
    </div>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import MainCheckbox from "@/Components/UI/MainCheckbox.vue";

export default {
    name: "settings-block",
    components: {
        MainCheckbox,
    },
    props: ["name", "text", "val"],
    data() {
        return {
            value: this.val,
            resetForm: useForm({
                old_password: "",
                password: "",
                password_confirmation: "",
            }),
        };
    },
    beforeUpdate() {
        if (this.value === "..." || this.value === null) {
            this.value = this.val;
        }
    },
    mounted() {
        if (this.val === "..." || this.val === null) {
            this.value = this.val;
        }
    },
    methods: {
        checkbox_changes(data) {
            if (this.val !== null) {
                let form = useForm({
                    item: data,
                    type: this.name,
                });
                form.post(route("change"), {});
            }
        },
        async end_change() {
            if (this.name === "Пароль") {
                this.resetForm.old_password = this.value;
                await this.resetForm.post("/password/reset");
            } else {
                let form = useForm({
                    item: this.value,
                    type: this.name,
                });
                await form.post(route("change"), {});
            }
            this.$refs.input.setAttribute("disabled", "");
            this.$refs.link.classList.remove("target");
        },
        start_change() {
            this.$refs.input.removeAttribute("disabled");
            this.$refs.link.classList.add("target");
        },
        get_val(bool) {
            bool ? this.start_change() : this.end_change();
        },
        password_form(bool) {
            this.$emit("newPassword", bool);
            if (bool) {
                this.$refs.input.removeAttribute("disabled");
                setTimeout(() => {
                    this.$refs.link.classList.add("target");
                    this.value = "";
                    this.$refs.wrap.classList.add("target");
                    this.$refs.wrap.insertAdjacentHTML(
                        "beforeend",
                        `
                            <div class="wrap__head" data-remove>
                              <span class="name">Новый пароль</span>
                            </div>
                            <input
                                data-remove
                                ref="input"
                                type="password"
                                class="input input-no-bg"
                            />
                        `
                    );
                    this.$refs.wrap.insertAdjacentHTML(
                        "beforeend",
                        `
                            <div class="wrap__head" data-remove>
                              <span class="name">Подтвердите пароль</span>
                            </div>
                            <input
                                data-remove
                                ref="input"
                                type="password"
                                class="input input-no-bg"
                            />
                        `
                    );
                    this.$refs.wrap.querySelectorAll(
                        ".input[data-remove] "
                    )[0].value = this.resetForm.password;
                    this.$refs.wrap.querySelectorAll(
                        ".input[data-remove] "
                    )[1].value = this.resetForm.password_confirmation;
                }, 300);
            } else {
                this.resetForm.password = this.$refs.wrap.querySelectorAll(
                    ".input[data-remove] "
                )[0].value;
                this.resetForm.password_confirmation =
                    this.$refs.wrap.querySelectorAll(
                        ".input[data-remove] "
                    )[1].value;
                this.end_change();
                this.value = this.val;
                this.$refs.wrap.classList.remove("target");
                this.$refs.input.setAttribute("disabled", "");
                this.$refs.link.classList.remove("target");
                this.$refs.wrap
                    .querySelectorAll("[data-remove]")
                    .forEach((el) => el.remove());
            }
        },
        change_val() {
            if (this.val !== "...") {
                this.$refs.input.attributes.disabled
                    ? this.name === "Пароль"
                        ? this.password_form(true)
                        : this.get_val(true)
                    : this.name === "Пароль"
                    ? this.password_form(false)
                    : this.get_val(false);
            }
        },
    },
};
</script>

<style lang="scss">
.wrap {
    &__block {
        gap: 12px;
        border-radius: 16px;
        min-height: 128px;
        transition: all 0.3s ease 0s, display 0.3s ease 0.3s;
        visibility: visible;
        opacity: 1;
        @media (max-width: 1271.98px) {
            min-height: 150px;
        }
        @media (max-width: 991.98px) {
            min-height: 128px;
        }
        @media (max-width: 478.98px) {
            min-height: 98px;
            padding: 12px;
        }
        &__head {
            transition: all 0.3s ease 0s;
            align-items: center;
            .name {
                color: rgba(0, 0, 0, 0.62);
            }
        }
        &.target {
            min-height: 416px;
            justify-content: space-between;
            @media (max-width: 991.98px) {
                min-height: 380px;
            }
            @media (max-width: 478.98px) {
                min-height: 300px;
            }
        }
        span,
        p {
            font-weight: 400;
            font-size: 18px;
            line-height: 143.1%;
            @media (max-width: 478.98px) {
                font-size: 16px;
            }
            @media (max-width: 320.98px) {
                font-size: 14px;
            }
        }
        .name {
            color: rgba(0, 0, 0, 0.62);
        }
        .change {
            color: #4182ec;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease 0s;
            &::after {
                content: "";
                background-image: url("data:image/svg+xml,%3Csvg width='756' height='756' viewBox='0 0 756 756' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M607.729 166.729L283.5 490.959L148.27 355.729C135.954 343.413 116.014 343.413 103.729 355.729C91.4445 368.046 91.413 387.985 103.729 400.27L261.229 557.771C273.546 570.087 293.485 570.087 305.77 557.771L652.271 211.27C664.587 198.954 664.587 179.014 652.271 166.729C639.954 154.444 620.014 154.413 607.729 166.729Z' fill='%234181EA'/%3E%3C/svg%3E%0A");
                background-position: center;
                background-size: cover;
                width: 24px;
                height: 24px;
                stroke: rgba(#5b5c5e, 0.33) !important;
                transition: all 0.3s ease 0s;
                visibility: hidden;
                opacity: 0;
                position: absolute;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
            }
            &.target {
                font-size: 0;
                &::after {
                    visibility: visible;
                    opacity: 1;
                }
            }
        }
        .text {
            color: rgba(97, 97, 97, 0.6);
            font-size: 14px;
            @media (max-width: 320.98px) {
                font-size: 12px;
            }
        }
    }
}
</style>
