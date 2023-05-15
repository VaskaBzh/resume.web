<template>
    <div class="wrap__block wrap__column">
        <div class="wrap__head">
            <span class="name">{{ this.name }}</span>
            <span
                class="change"
                v-if="!this.text"
                @click="change_val"
                :data-popup="`#changes`"
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
        <span class="text_val" v-if="!this.text">{{ this.value }}</span>
        <!--        <input-->
        <!--            v-model="this.value"-->
        <!--            ref="input"-->
        <!--            disabled-->
        <!--            v-if="!this.text"-->
        <!--            :type="this.name === 'Пароль' ? 'password' : 'text'"-->
        <!--            class="input input-no-bg"-->
        <!--        />-->
    </div>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import MainCheckbox from "@/Components/UI/MainCheckbox.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";

export default {
    name: "settings-block",
    components: {
        MainCheckbox,
        BlueButton,
    },
    props: ["name", "text", "val", "id", "button"],
    data() {
        return {
            value: this.val,
            // resetForm: useForm({
            //     old_password: "",
            //     password: "",
            //     password_confirmation: "",
            // }),
        };
    },
    beforeUpdate() {
        this.value = this.val;
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
        // async end_change() {
        //     if (this.name === "Пароль") {
        //         this.resetForm.old_password = this.value;
        //         await this.resetForm.post("/password/reset");
        //     } else {
        //         let form = useForm({
        //             item: this.value,
        //             type: this.name,
        //         });
        //         await form.post(route("change"), {});
        //     }
        // },
        // start_change() {
        // },
        get_val(pas) {
            // this.end_change();
            let data = {
                name: this.name.toLowerCase(),
                val: this.value,
            };

            if (pas) {
                data.password = pas;
            }

            this.$emit("openPopup", data);
        },
        // password_form(bool) {
        //     this.$emit("newPassword", bool);
        //     if (bool) {
        //         this.$refs.input.removeAttribute("disabled");
        //         setTimeout(() => {
        //             this.value = "";
        //         }, 300);
        //     } else {
        //         this.end_change();
        //         this.value = this.val;
        //     }
        // },
        change_val() {
            if (this.val !== "..." && this.val !== "********") {
                this.name === "Пароль" ? this.get_val(true) : this.get_val();
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
        span,
        p {
            font-weight: 400;
            font-size: 18px;
            line-height: 143.1%;
            @media (max-width: 478.98px) {
                font-size: 16px;
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
        }
        .text {
            color: rgba(97, 97, 97, 0.6);
            font-size: 14px;
            &_val {
                font-weight: 500;
                font-size: 24px;
                line-height: 34px;
                color: #000034;
            }
        }
    }
}
</style>
