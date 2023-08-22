<template>
    <div
        class="cabinet__block cabinet__block-light"
        :data-popup="`#changes`"
        @mousedown="change_val"
    >
        <div class="svg" v-html="svg"></div>
        <!--            <span-->
        <!--                class="change title title-blue"-->
        <!--                v-if="!this.text"-->
        <!--                @click="change_val"-->
        <!--                :data-popup="`#changes`"-->
        <!--            >-->
        <!--                Изменить-->
        <!--            </span>-->
        <span class="text text-black text-b">{{ this.value }}</span>
        <svg
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            class="edit"
        >
            <path
                d="M4.5 19.5H5.6L16.675 8.425L15.575 7.325L4.5 18.4V19.5ZM19.85 7.35L16.65 4.15L17.7 3.1C17.9833 2.81667 18.3333 2.675 18.75 2.675C19.1667 2.675 19.5167 2.81667 19.8 3.1L20.9 4.2C21.1833 4.48334 21.325 4.83334 21.325 5.25C21.325 5.66667 21.1833 6.01667 20.9 6.3L19.85 7.35ZM18.8 8.4L6.2 21H3V17.8L15.6 5.2L18.8 8.4ZM16.125 7.875L15.575 7.325L16.675 8.425L16.125 7.875Z"
            />
        </svg>
    </div>
</template>

<script>
import { useForm, usePage } from "@inertiajs/vue3";

export default {
    name: "settings-row",
    props: ["val", "svg", "name", "keyForm"],
    data() {
        return {
            value: this.val,
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
        async checkbox_changes(data) {
            const { props } = usePage();

            if (this.val !== null) {
                let form = useForm({
                    item: data,
                    type: this.name,
                });
                await form.post(route("change"), {});
            }
        },
        get_val(pas) {
            // this.end_change();
            let data = {
                name: this.name.toLowerCase(),
                val: this.value === "Добавьте телефон" ? "" : this.value,
                key: this.keyForm,
            };

            if (pas) {
                data.password = pas;
            }

            this.$emit("openPopup", data);
        },
        change_val() {
            if (this.val !== "..." && this.val !== "********") {
                this.name === "Пароль" ? this.get_val(true) : this.get_val();
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.cabinet__block {
    display: flex;
    gap: 16px;
    align-items: center;
    padding: 12px 16px;
    border-radius: 12px;
}
.edit {
    width: 24px;
    height: 24px;
    fill: #c5c5c5;
    margin-left: auto;
    cursor: pointer;
}
</style>
