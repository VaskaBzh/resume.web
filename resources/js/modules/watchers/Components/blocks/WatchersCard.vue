<template>
    <div class="card">
        <main-title tag="h3" class="card_title title-mobile">{{
                $t("settings_card.title")
            }}
        </main-title>
        <div class="card__wrapper">
            <transition name="fade">
                <div
                    class="card__content card__content-empty"
                    v-if="!saveWatcher"
                >
                    <img
                        class="card_img"
                        src="../../imgs/img_watcher-card.png"
                        alt="chose-watcher"
                    />
                    <main-description class="card_description"
                    >{{ $t("default_text") }}
                    </main-description>
                </div>
                <div class="card__content" v-else>
                    <main-input
                        class="card_input"
                        inputName="name"
                        :inputLabel="$t('settings_card.labels[0]')"
                        :inputValue="saveWatcher.name"
                        :editable="isEditable"
                        :error="errorsExpired.name"
                        @getValue="setFormName($event)"
                    />
                    <div class="card__block">
                        <div class="card_label">
                            {{ $t("settings_card.text") }}
                        </div>
                        <div class="card__block card__block-selects">
                            <main-checkbox
                                v-for="(route, i) in allowedRoutes"
                                :key="i"
                                :is_checked="route.checked"
                                class="checkbox-sm"
                                :editable="isEditable ? route.editable : isEditable"
                                @is_checked="setAllowedRoutes($event, i)"
                            >
                                {{ route.name }}
                            </main-checkbox>
                        </div>
                    </div>
                    <main-copy
                        class="card_copy"
                        :cutValue="45"
                        :code="saveWatcher.link"
                        :label="$t('settings_card.labels[1]')"
                    />
                    <div class="card__buttons">
                        <main-button
                            class="card_button"
                            :data-popup="isEditable ? null : '#removeWatcher'"
                            :class="firstButtonClass"
                            @click="buttonProcess"
                        >
                            <template v-slot:text>{{
                                    firstButtonText
                                }}
                            </template>
                        </main-button
                        >
                        <main-button
                            class="button-blue card_button"
                            @click="changeWatcher"
                        >
                            <template v-slot:text>{{
                                    secondButtonText
                                }}
                            </template>
                        </main-button
                        >
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import MainInput from "@/modules/common/Components/inputs/MainInput.vue";
import MainCheckbox from "@/modules/common/Components/UI/MainCheckbox.vue";
import MainCopy from "@/modules/common/Components/UI/MainCopy.vue";
import MainButton from "@/modules/common/Components/UI/LandingButton.vue";
import {mapGetters} from "vuex";
import {WatchersMessage} from "@/modules/watchers/lang/WatchersMessages";

export default {
    name: "watchers-card",
    components: {
        MainTitle,
        MainDescription,
        MainInput,
        MainCheckbox,
        MainCopy,
        MainButton,
    },
    i18n: {
        sharedMessages: WatchersMessage,
    },
    props: {
        watcher: Object,
    },
    computed: {
        ...mapGetters(["errorsExpired"]),
        firstButtonClass() {
            return this.isEditable ? "button-reverse" : "button-red";
        },
        firstButtonText() {
            return this.isEditable
                ? this.$t("settings_card.buttons[3]")
                : this.$t("settings_card.buttons[0]");
        },
        secondButtonText() {
            return this.isEditable
                ? this.$t("settings_card.buttons[2]")
                : this.$t("settings_card.buttons[1]");
        },
    },
    watch: {
        watcher(newWatcher) {
            this.setWatcher(newWatcher);
            if (newWatcher?.tags) {
                this.getAllowedRoutes(newWatcher.tags);
                this.setId(newWatcher.id);
                this.setFormName(newWatcher.name);
            }
        },
        "$i18n.locale"() {
            this.allowedRoutes.map(
                (route, i) => (route.name = this.$t(`tabs[${i}]`))
            );
        },
    },
    data() {
        return {
            saveWatcher: this.watcher,
            isEditable: false,
            form: {
                name: this.watcher?.name,
                allowedRoutes: [],
                id: this.watcher?.id,
            },
            allowedRoutes: [
                {
                    name: this.$t("tabs[0]"),
                    checked: false,
                    editable: false,
                    routes: [
                        "v1.sub.show",
                        "v1.statistic.show",
                        "v1.allowed-routes",
                    ],
                },
                {
                    name: this.$t("tabs[2]"),
                    checked: false,
                    editable: true,
                    routes: [
                        "v1.worker.show",
                        "v1.worker.list",
                        "v1.worker_hashrate.list",
                    ],
                },
                {
                    name: this.$t("tabs[1]"),
                    checked: false,
                    editable: true,
                    routes: ["v1.income.list", "v1.payout.list"],
                },
            ],
        };
    },
    mounted() {
        if (this.watcher?.tags) this.getAllowedRoutes(this.watcher.tags);
    },
    methods: {
        dropFormAllowedRoutes() {
            this.form.allowedRoutes = [];
        },
        setFormAllowedRoutes() {
            this.dropFormAllowedRoutes();
            this.allowedRoutes.forEach((route) => {
                if (route.checked)
                    this.form.allowedRoutes = [
                        ...this.form.allowedRoutes,
                        ...route.routes,
                    ];
            });

            this.$emit("changeWatcher", this.form);
        },
        setAllowedRoutes(checkState, index) {
            this.allowedRoutes[index].checked = checkState;
        },
        setWatcher(newWatcher) {
            this.saveWatcher = newWatcher;
        },
        setId(id) {
            this.form = {
                ...this.form,
                id: id,
            };
        },
        buttonProcess() {
            if (!this.isEditable) this.$emit("removeWatcher", this.watcher.id);
            else this.isEditable = false;
        },
        changeWatcher() {
            if (this.isEditable) {
                this.setFormAllowedRoutes();
            }

            this.isEditable = !this.isEditable;
        },
        setFormName(name) {
            this.form = {
                ...this.form,
                name: name,
            };
        },
        getAllowedRoutes(allowedRoutes) {
            this.allowedRoutes.forEach((route) => {
                route.routes.forEach((r) => {
                    route.checked = !!allowedRoutes.includes(r);
                });
            });
        },
    },
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.card {
    border-radius: 24px;
    background: var(--background-island);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    min-height: 680px;
    padding: 32px;
    display: flex;
    flex-direction: column;
}

.title-mobile {
    display: inline-block;
}

@media (max-width: 500px) {
    .title-mobile {
        font-size: 19px;
    }
}

.card__wrapper {
    position: relative;
    flex: 1 1 auto;
    padding-top: 40px;
    width: 100%;
    display: flex;
    flex-direction: column;
}

.card_img {
    width: 240px;
    height: 240px;
}

.card_description {
    white-space: nowrap;
}

.card__content {
    display: flex;
    flex-direction: column;
    gap: 40px;
    flex: 1 1 auto;
}

.card__content-empty {
    align-items: center;
    justify-content: center;
    gap: 8px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.card_input {
    background: var(--background-island-inner-3);
}

.card_label {
    padding: 0 16px;
    color: var(--text-teritary);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
    margin-bottom: 8px;
}

.card__block-selects {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 24px;
    border-radius: 24px;
    background: var(--background-island-inner-3);
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.01);
}

.card__buttons {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-top: auto;
}

.card_button {
    min-height: 56px;
    width: 100%;
    transition: all 0.5s ease 0s;
}
</style>
