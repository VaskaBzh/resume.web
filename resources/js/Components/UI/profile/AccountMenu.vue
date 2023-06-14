<template>
    <div @click="toggleMenu" class="button">
        <div class="button_name">
            {{ this.name }}
            <!--            {{-->
            <!--                this.name.length > 12-->
            <!--                    ? this.name.slice(0, 12 - this.name.length) + "..."-->
            <!--                    : this.name-->
            <!--            }}-->
            <svg
                v-show="this.viewportWidth < 767.98"
                width="13"
                height="12"
                viewBox="0 0 13 12"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M6.19307 9.06485C6.28038 9.06485 6.36195 9.04762 6.43778 9.01315C6.51361 8.97869 6.58369 8.92929 6.64803 8.86495L10.0851 5.31761C10.2045 5.19353 10.2643 5.04188 10.2643 4.86265C10.2643 4.74776 10.2367 4.64206 10.1816 4.54555C10.1264 4.44905 10.0517 4.37322 9.95753 4.31807C9.86332 4.26293 9.75647 4.23535 9.63698 4.23535C9.46695 4.23535 9.31759 4.29509 9.18891 4.41458L6.19307 7.52074L3.19719 4.41458C3.06853 4.29509 2.91917 4.23535 2.7491 4.23535C2.62962 4.23535 2.52277 4.26293 2.42856 4.31807C2.33435 4.37322 2.25969 4.44905 2.20458 4.54555C2.14943 4.64206 2.12185 4.74776 2.12185 4.86265C2.12185 5.04188 2.18388 5.19353 2.30792 5.31761L5.7381 8.86495C5.80244 8.92929 5.87252 8.97869 5.94835 9.01315C6.02418 9.04762 6.10575 9.06485 6.19307 9.06485Z"
                    fill="#000034"
                    fill-opacity="0.8"
                />
            </svg>
        </div>
        <div class="button__menu" :class="{ target: target }">
            <div class="button__row">
                <span class="button_title"> {{ $t("header.menu.title") }}</span>
                <main-list>
                    <template
                        v-slot:head
                        v-if="
                            this.allAccounts[this.getActive] &&
                            this.getIncome[this.getActive].accruals
                        "
                    >
                        {{
                            Number(
                                this.getIncome[this.getActive].accruals
                            ).toFixed(8)
                        }}
                        BTC</template
                    >
                    <template v-slot:head v-else> 0.00000000 BTC</template>
                    <template v-slot:body>
                        <div class="list_row">
                            <span> {{ $t("header.menu.wallets.all") }}</span>
                            <span> {{ this.earnSum }} BTC</span>
                        </div>
                        <div class="list_row">
                            <blue-button class="list_button"
                                ><Link :href="route('income')">
                                    {{ $t("header.menu.wallets.button") }}</Link
                                ></blue-button
                            >
                        </div>
                    </template>
                </main-list>
                <auto-height-select
                    :open="this.open"
                    :options="this.accounts"
                    @getAcc="change_index"
                ></auto-height-select>
            </div>
            <div class="button__row">
                <span class="button_title">
                    {{ $t("header.menu.acc_admin.title") }}</span
                >
                <Link class="settings" :href="route('settings')"
                    ><svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <g clip-path="url(#clip0_1021_16805)">
                            <path
                                d="M11.0137 22.4346H12.9863C13.3639 22.4346 13.6878 22.3288 13.958 22.1172C14.2282 21.9056 14.4056 21.6175 14.4903 21.253L14.9102 19.4268L15.2227 19.3194L16.8145 20.2959C17.1269 20.4977 17.4557 20.5759 17.8008 20.5303C18.1458 20.4847 18.4518 20.3284 18.7188 20.0616L20.086 18.7041C20.3528 18.4371 20.5091 18.1312 20.5547 17.7862C20.6003 17.4411 20.5221 17.1123 20.3203 16.7998L19.3242 15.2178L19.4414 14.9248L21.2676 14.4952C21.6256 14.4105 21.9121 14.2314 22.127 13.958C22.3418 13.6846 22.4492 13.3623 22.4492 12.9912V11.0576C22.4492 10.6865 22.3418 10.3643 22.127 10.0908C21.9121 9.81738 21.6256 9.63835 21.2676 9.55371L19.461 9.11425L19.334 8.80175L20.3301 7.21972C20.5319 6.90722 20.61 6.58008 20.5645 6.23828C20.5189 5.89648 20.3626 5.58887 20.0957 5.31543L18.7285 3.94824C18.4681 3.68782 18.1653 3.53483 17.8203 3.48925C17.4753 3.44368 17.1465 3.51855 16.834 3.71386L15.2422 4.69043L14.9102 4.56347L14.4903 2.7373C14.4056 2.37923 14.2282 2.09277 13.958 1.87793C13.6878 1.66309 13.3639 1.55566 12.9863 1.55566H11.0137C10.6361 1.55566 10.3122 1.66309 10.042 1.87793C9.77181 2.09277 9.5944 2.37923 9.50976 2.7373L9.08008 4.56347L8.74805 4.69043L7.16601 3.71386C6.847 3.51855 6.5166 3.44368 6.1748 3.48925C5.83301 3.53483 5.52865 3.68782 5.26172 3.94824L3.9043 5.31543C3.63086 5.58887 3.47298 5.89648 3.43066 6.23828C3.38835 6.58008 3.4681 6.90722 3.66992 7.21972L4.65625 8.80175L4.53906 9.11425L2.73242 9.55371C2.36784 9.63835 2.07975 9.81738 1.86816 10.0908C1.65658 10.3643 1.55078 10.6865 1.55078 11.0576V12.9912C1.55078 13.3623 1.6582 13.6846 1.87305 13.958C2.08789 14.2314 2.37435 14.4105 2.73242 14.4952L4.55859 14.9248L4.66601 15.2178L3.67969 16.7998C3.47786 17.1123 3.39811 17.4411 3.44043 17.7862C3.48274 18.1312 3.64062 18.4371 3.91406 18.7041L5.27148 20.0616C5.53841 20.3284 5.8444 20.4847 6.18945 20.5303C6.5345 20.5759 6.86654 20.4977 7.18555 20.2959L8.76758 19.3194L9.08008 19.4268L9.50976 21.253C9.5944 21.6175 9.77181 21.9056 10.042 22.1172C10.3122 22.3288 10.6361 22.4346 11.0137 22.4346ZM11.1699 20.9112C11.0072 20.9112 10.9128 20.8363 10.8867 20.6866L10.3008 18.2647C10.0013 18.1931 9.71647 18.1003 9.44629 17.9864C9.1761 17.8724 8.93684 17.7504 8.72851 17.6202L6.59961 18.9287C6.48242 19.0133 6.36198 18.9971 6.23828 18.8799L5.08594 17.7276C4.98177 17.6299 4.96875 17.5094 5.04687 17.3662L6.35547 15.2569C6.24479 15.0485 6.13086 14.8109 6.01367 14.544C5.89648 14.277 5.79883 13.9938 5.7207 13.6944L3.29883 13.1182C3.14909 13.0921 3.07422 12.9977 3.07422 12.835V11.2041C3.07422 11.0479 3.14909 10.9534 3.29883 10.9209L5.71094 10.335C5.78906 10.016 5.8916 9.71972 6.01855 9.44628C6.1455 9.17285 6.2513 8.94499 6.33594 8.76269L5.03711 6.65332C4.95248 6.51009 4.96224 6.38314 5.0664 6.27246L6.22851 5.13964C6.3457 5.03548 6.4694 5.0192 6.59961 5.09082L8.70898 6.37011C8.91731 6.25293 9.16308 6.13574 9.44629 6.01855C9.72949 5.90137 10.0176 5.80371 10.3106 5.72558L10.8867 3.30371C10.9128 3.15397 11.0072 3.0791 11.1699 3.0791H12.8301C12.9928 3.0791 13.0839 3.15397 13.1035 3.30371L13.6992 5.74511C14.0052 5.82324 14.29 5.91927 14.5537 6.0332C14.8173 6.14714 15.0566 6.2627 15.2715 6.37988L17.3906 5.09082C17.5273 5.0192 17.6543 5.03548 17.7715 5.13964L18.9238 6.27246C19.0345 6.38314 19.0443 6.51009 18.9531 6.65332L17.6543 8.76269C17.7454 8.94499 17.8528 9.17285 17.9766 9.44628C18.1002 9.71972 18.2011 10.016 18.2793 10.335L20.7012 10.9209C20.8509 10.9534 20.9258 11.0479 20.9258 11.2041V12.835C20.9258 12.9977 20.8509 13.0921 20.7012 13.1182L18.2696 13.6944C18.1914 13.9938 18.0954 14.277 17.9815 14.544C17.8675 14.8109 17.752 15.0485 17.6348 15.2569L18.9434 17.3662C19.028 17.5094 19.0149 17.6299 18.9043 17.7276L17.7617 18.8799C17.638 18.9971 17.5143 19.0133 17.3906 18.9287L15.2617 17.6202C15.0533 17.7504 14.8157 17.8724 14.5488 17.9864C14.2819 18.1003 13.9987 18.1931 13.6992 18.2647L13.1035 20.6866C13.0839 20.8363 12.9928 20.9112 12.8301 20.9112H11.1699ZM12 15.7256C12.6836 15.7256 13.3069 15.5579 13.8701 15.2227C14.4333 14.8874 14.8825 14.4366 15.2178 13.8702C15.553 13.3037 15.7207 12.6787 15.7207 11.9952C15.7207 11.3181 15.553 10.6979 15.2178 10.1348C14.8825 9.57162 14.4333 9.1224 13.8701 8.78711C13.3069 8.45183 12.6836 8.28418 12 8.28418C11.3164 8.28418 10.693 8.45183 10.1299 8.78711C9.56673 9.1224 9.11589 9.57162 8.77734 10.1348C8.4388 10.6979 8.26953 11.3181 8.26953 11.9952C8.26953 12.6787 8.4388 13.3021 8.77734 13.8653C9.11589 14.4284 9.56673 14.8792 10.1299 15.2178C10.693 15.5563 11.3164 15.7256 12 15.7256ZM12 14.2119C11.5963 14.2119 11.2269 14.1126 10.8916 13.9141C10.5563 13.7155 10.2894 13.4485 10.0908 13.1133C9.89225 12.778 9.79297 12.4053 9.79297 11.9952C9.79297 11.5915 9.89225 11.2236 10.0908 10.8916C10.2894 10.5596 10.5563 10.2943 10.8916 10.0957C11.2269 9.89714 11.5963 9.79785 12 9.79785C12.3971 9.79785 12.7617 9.89714 13.0938 10.0957C13.4258 10.2943 13.6911 10.5596 13.8897 10.8916C14.0882 11.2236 14.1875 11.5915 14.1875 11.9952C14.1875 12.3988 14.0882 12.7682 13.8897 13.1036C13.6911 13.4388 13.4258 13.7074 13.0938 13.9092C12.7617 14.111 12.3971 14.2119 12 14.2119Z"
                                fill="#417FE5"
                            />
                        </g>
                        <defs>
                            <clipPath id="clip0_1021_16805">
                                <rect
                                    width="20.8984"
                                    height="20.8887"
                                    fill="white"
                                    transform="translate(1.55078 1.55566)"
                                />
                            </clipPath>
                        </defs>
                    </svg>

                    {{ $t("header.menu.acc_admin.settings") }}</Link
                >
                <form @submit.prevent="logout">
                    <button type="submit">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g clip-path="url(#clip0_1036_18270)">
                                <path
                                    d="M4.51031 19.4951C4.62749 19.6058 4.76096 19.6806 4.9107 19.7197C5.06044 19.7588 5.21018 19.7588 5.35992 19.7197C5.50966 19.6806 5.63986 19.6058 5.75054 19.4951L12.0005 13.2451L18.2505 19.4951C18.3612 19.6058 18.4914 19.6806 18.6411 19.7197C18.7909 19.7588 18.9422 19.7604 19.0952 19.7246C19.2482 19.6888 19.3801 19.6123 19.4907 19.4951C19.6015 19.3844 19.6747 19.2542 19.7105 19.1045C19.7463 18.9548 19.7463 18.805 19.7105 18.6553C19.6747 18.5056 19.6015 18.3753 19.4907 18.2646L13.2408 12.0049L19.4907 5.75488C19.6015 5.6442 19.6764 5.514 19.7154 5.36426C19.7545 5.21452 19.7545 5.06478 19.7154 4.91504C19.6764 4.7653 19.6015 4.63509 19.4907 4.52441C19.3736 4.40723 19.2402 4.33073 19.0904 4.29492C18.9406 4.25911 18.7909 4.25911 18.6411 4.29492C18.4914 4.33073 18.3612 4.40723 18.2505 4.52441L12.0005 10.7744L5.75054 4.52441C5.63986 4.40723 5.50803 4.33073 5.35504 4.29492C5.20204 4.25911 5.05067 4.25911 4.90093 4.29492C4.75119 4.33073 4.62098 4.40723 4.51031 4.52441C4.39963 4.63509 4.32639 4.7653 4.29058 4.91504C4.25477 5.06478 4.25477 5.21452 4.29058 5.36426C4.32639 5.514 4.39963 5.6442 4.51031 5.75488L10.7603 12.0049L4.51031 18.2646C4.39963 18.3753 4.32476 18.5056 4.2857 18.6553C4.24664 18.805 4.24501 18.9548 4.28081 19.1045C4.31662 19.2542 4.39312 19.3844 4.51031 19.4951Z"
                                    fill="#FF3B30"
                                />
                            </g>
                            <defs>
                                <clipPath id="clip0_1036_18270">
                                    <rect
                                        width="15.4896"
                                        height="15.5006"
                                        fill="white"
                                        transform="translate(4.25513 4.24976)"
                                    />
                                </clipPath>
                            </defs>
                        </svg>

                        {{ $t("header.menu.acc_admin.logout") }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import BlueButton from "@/Components/UI/BlueButton.vue";
import AutoHeightSelect from "@/Components/UI/AutoHeightSelect.vue";
import { mapGetters } from "vuex";
import MainList from "@/Components/UI/MainList.vue";
import { Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

export default {
    name: "account-menu",
    components: {
        MainList,
        BlueButton,
        AutoHeightSelect,
        Link,
    },
    props: {
        is_auth: {
            type: Boolean,
            default: false,
        },
        viewportWidth: {
            type: Number,
            require: true,
        },
    },
    data() {
        return {
            target: false,
            open: false,
        };
    },
    mounted() {
        document.addEventListener("click", this.hideMenu.bind(this), true);
        document.addEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.hideMenu();
            }
        });
    },
    setup() {
        const logout = async () => {
            await Inertia.post("/logout");
        };

        return {
            logout,
        };
    },
    computed: {
        ...mapGetters(["getIncome", "allAccounts", "getActive"]),
        accounts() {
            let arr = [];
            if (this.allAccounts && Object.values(this.allAccounts)[0]) {
                arr.length = 0;
                Object.values(this.allAccounts).forEach((acc) => {
                    arr.push({ title: acc.name, value: acc.id });
                });
            }
            return arr;
        },
        name() {
            let name = "...";
            if (this.allAccounts[this.getActive]) {
                name = this.allAccounts[this.getActive].name;
            }
            return name;
        },
        earnSum() {
            let sum = 0;
            if (Object.values(this.getIncome).length > 0) {
                Object.values(this.getIncome).forEach((el) => {
                    sum += Number(el.accruals);
                });
            }
            return sum.toFixed(8);
        },
    },
    methods: {
        change_index(data) {
            this.$store.commit("updateActive", data);
        },
        hideMenu() {
            this.target = false;
        },
        toggleMenu() {
            this.target = !this.target;
            if (this.target === true) {
                setTimeout(() => (this.open = true), 300);
                this.$emit("clicked", true);
            }
        },
    },
};
</script>

<style scoped lang="scss">
.button {
    position: relative;
    width: 100%;
    min-width: 160px;
    @media (max-width: 767.98px) {
        padding: 0 12px;
        margin-right: -10px;
    }
    &_name {
        width: 100%;
        cursor: pointer;
        transition: all 0.3s ease 0s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 400;
        font-size: 17px;
        line-height: 140%;
        color: #3f7bdd;
        min-width: 160px;
        @media (max-width: 767.98px) {
            min-width: 130px;
            color: #000034;
            font-weight: 400;
            font-size: 18px;
            line-height: 143.1%;
            gap: 4px;
        }
        @media (min-width: 767.98px) {
            border: 1px solid #3f7bdd;
            padding: 0 24px;
            min-height: 40px;
            border-radius: 8px;
            &:hover {
                //color: #ffffff;
                //background-color: #417fe5;
                background: #c6d8f5;
                border: 1px solid #c6d8f5;
            }
        }
    }
    .list_button {
        a {
            text-decoration: none;
        }
    }
    .mini {
        height: fit-content;
    }
    .target {
        &.button {
            &__menu {
                color: #000034;
                visibility: visible;
                max-height: 500px;
                opacity: 1;
                transition: all 0.5s ease 0s, opacity 0.2s ease 0s;
            }
        }
    }
    &__row {
        display: flex;
        flex-direction: column;
        .mini {
            margin-top: 0 !important;
        }
    }
    &_title {
        font-weight: 500;
        font-size: 16px;
        line-height: 143.1%;
        color: #969797;
    }
    &__menu {
        position: absolute;
        top: calc(100% + 8px);
        visibility: hidden;
        opacity: 0;
        max-height: 0;
        padding: 12px 12px 18px;
        right: 0;
        min-width: 251px;
        transition: all 0.2s ease 0s, max-height 0.2s ease 0.2s;
        height: fit-content;
        display: flex;
        flex-direction: column;
        gap: 16px;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 8px 24px rgba(129, 135, 189, 0.15);
        border-radius: 20px;
        @media (max-width: 767.98px) {
            display: none;
        }
        button,
        a {
            font-weight: 400;
            display: inline-flex;
            gap: 10px;
            align-items: center;
            transition: all 0.3s ease 0s;
            text-decoration: underline;
            text-decoration-color: transparent;
            width: 100%;
            background: transparent;
            border-radius: 8px;
            padding: 0 24px;
            height: 36px;
            font-size: 17px;
            line-height: 143.1%;
            color: #000034;
            &:hover {
                background: rgba(234, 238, 244, 0.4);
            }
        }
        button {
            color: #ff3b30;
        }
    }
}
</style>
