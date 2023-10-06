<template>
    <div
        class="cabinet__block cabinet__block-light row"
        :data-popup="!!user.email_verified_at ? '#changes' : ''"
        @mousedown="change_val"
    >
        <div class="data_value">
            <div v-html="svg" class="svg-settings-input"></div>
            <span class="text text-black text-b">{{ this.value }}</span>
        </div>
        <span class="change-text">
            {{ buttonName }}
        </span>
    </div>
</template>

<script>
import { SettingsMessage } from "../../lang/SettingsMessage";
import { ProfileApi } from "@/api/api";
import store from "@/store";
import { mapGetters } from "vuex";

export default {
    name: "settings-row",
    props: ["val", "svg", "name", "keyForm"],
    i18n: {
        sharedMessages: SettingsMessage,
    },
    watch: {
        user(newUserData) {
            if (this.name === this.$t("settings.block.settings_block.labels.email")) {
                this.buttonName = !!newUserData.email_verified_at ? this.$t("button") : this.$t("button_verify");
            }
        },
        name(newRowName) {
            if (newRowName === this.$t("settings.block.settings_block.labels.email")) {
                this.buttonName = !!this.user.email_verified_at ? this.$t("button") : this.$t("button_verify");
            }
        }
    },
    data() {
        return {
            value: this.val,
            overTime: 0,
            buttonName: this.$t("button"),
        };
    },
    beforeUpdate() {
        this.value = this.val;
    },
    mounted() {
        if (this.name === this.$t("settings.block.settings_block.labels.email")) {
            this.buttonName = !!this.user.email_verified_at ? this.$t("button") : this.$t("button_verify");
        }
        if (this.val === "..." || this.val === null) {
            this.value = this.val;
        }
    },
    computed: {
        ...mapGetters(["user"]),
    },
    methods: {
        setTimer(intervalEndTime) {
            if (this.overTime === 0) {
                this.overTime = intervalEndTime;
                const interval = setInterval(() => {
                    if (this.overTime > 0) {
                        this.overTime = this.overTime - 1000;

                        let overTime = this.overTime;
                        this.buttonName = overTime / 1000 + " сек";
                    } else {
                        clearInterval(interval);

                        this.overTime = 0;

                        this.buttonName = this.$t("button");
                    }
                }, 1000)
            }
        },
        async checkbox_changes(data) {
            if (this.val !== null) {
                let form = {
                    item: data,
                    type: this.name,
                };

                try {
                    await ProfileApi.post(`/change/${this.user.id}`, form);
                } catch (e) {
                    console.error("Error with: " + e);
                }
            }
        },
        get_val(pas) {
            // this.end_change();
            let data = {
                name: this.name.toLowerCase(),
                verify: !!this.user.email_verified_at,
                val: this.value,
                key: this.keyForm,
            };

            if (pas) {
                data.password = pas;
            }
            if (this.overTime === 0) {
                this.$emit("openPopup", data);
            }

            if (!this.user.email_verified_at) {
                this.setTimer(60000);
            }
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
    min-height: 56px;
    align-items: center;
    justify-content: space-between;
    padding: 16px;
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
.svg-settings-input{
    display: flex;
    align-items: center;
}
.data_value {
    display: flex;
    gap: 16px;
    align-items: center;
}
@media(max-width: 900px){
    .change-text {
        font-size: 12px;
        line-height: 16px; /* 133.333% */
        text-align: end;
    }
    .cabinet__block {
      padding: 9px 12px;
    }
    .data_value {
        gap: 9px;
    }
}
@media(max-width: 500px){
    .cabinet__block {
        min-height: 48px;
    }
}
</style>
