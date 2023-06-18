<template>
    <div class="cabinet__block cabinet__block-light">
        <div class="cabinet__head">
            <span class="title name">{{ this.name }}</span>
            <span
                class="change title title-blue"
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
        <p class="text text-sm" v-if="this.text">{{ this.text }}</p>
        <span class="text_val" v-if="!this.text">{{ this.value }}</span>
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
    props: ["name", "text", "val", "id", "button"],
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
        checkbox_changes(data) {
            if (this.val !== null) {
                let form = useForm({
                    item: data,
                    type: this.name,
                });
                form.post(route("change"), {});
            }
        },
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
        change_val() {
            if (this.val !== "..." && this.val !== "********") {
                this.name === "Пароль" ? this.get_val(true) : this.get_val();
            }
        },
    },
};
</script>

<style lang="scss" scoped>
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
    &_val {
        font-weight: 500;
        font-size: 24px;
        line-height: 34px;
        color: #000034;
    }
}
</style>
