<template>
    <div
        class="cabinet__block cabinet__block-light row"
        data-popup="#changes"
        @mousedown="change_val"
    >
        <div class="data_value">
            <div v-html="svg"></div>
            <span class="text text-black text-b">{{ this.value }}</span>
        </div>
        <span class="change-text">
            {{ $t("button") }}
        </span>
    </div>
</template>

<script>
import { SettingsMessage } from "../../lang/SettingsMessage";
import api from "@/api/api";
import { useRoute } from "vue-router";
import store from "@/store";
import { mapGetters } from "vuex";

export default {
    name: "settings-row",
    props: ["val", "svg", "name", "keyForm"],
    i18n: {
        sharedMessages: SettingsMessage,
    },
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
    computed: {
        ...mapGetters(["user"]),
    },
    methods: {
        async checkbox_changes(data) {
            if (this.val !== null) {
                let form = {
                    item: data,
                    type: this.name,
                };

                try {
                    await api.post(`/change/${this.user.id}`, form, {
                        headers: {
                            Authorization: `Bearer ${store.getters.token}`,
                        },
                    });
                } catch (e) {
                    console.error("Error with: " + e);
                }
            }
        },
        get_val(pas) {
            // this.end_change();
            let data = {
                name: this.name.toLowerCase(),
                val: this.value,
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
    gap: 8px;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    width: 100%;
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.01);
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-island-inner-3);
}
.row {
    cursor: pointer;
}
.edit {
    width: 24px;
    height: 24px;
    fill: #c5c5c5;
    margin-left: auto;
    cursor: pointer;
}
.change-text {
    color: var(--primary-400, #53b1fd);
    font-family: NunitoSans, serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 150%; /* 24px */
}
.data_value {
    display: flex;
    gap: 16px;
    align-items: center;
}
</style>
