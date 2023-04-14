<template>
    <nav class="nav__container">
        <Link :href="route('home')">
            <img
                class="nav__logo headder"
                src="../../assets/img/logo_high_quality.png"
                alt="logo"
            />
        </Link>

        <nav-links :is_auth="is_auth" />
        <div
            @click="burgerAction"
            v-if="viewportWidth < 767.98"
            class="nav__burger"
            :class="{ active: is_clicked }"
        >
            <div class="nav__burger_con">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div
            v-if="viewportWidth >= 991.98 && !is_auth"
            class="nav__button"
            data-popup="#auth"
            @mousedown="this.linkChanger"
        >
            Личный кабинет
        </div>

        <div
            class="nav__button nav__button-account"
            v-if="viewportWidth >= 991.98 && is_auth"
            ref="list"
            @mouseenter="this.open"
            @mouseout="this.close"
        >
            <Link :href="route('accounts')" class="nav__button_link">
                {{ this.name }}
            </Link>
            <div class="nav__button_menu">
                <main-list>
                    <template
                        v-slot:head
                        v-if="
                            this.allAccounts[this.getActive] &&
                            this.getIncome[this.getActive].accruals
                        "
                    >
                        {{ this.getIncome[this.getActive].accruals.toFixed(8) }}
                        BTC</template
                    >
                    <template v-slot:head v-else> 0.00000000 BTC</template>
                    <template v-slot:body>
                        <div class="list_row">
                            <span>Всего</span>
                            <span> {{ this.earnSum }} BTC</span>
                        </div>
                        <div class="list_row">
                            <blue-button class="list_button"
                                ><Link :href="route('income')"
                                    >Доходы</Link
                                ></blue-button
                            >
                        </div>
                    </template>
                </main-list>
                <!--                <auto-height-select-->
                <!--                    class="mini"-->
                <!--                    :options="this.wallets"-->
                <!--                ></auto-height-select>-->
                <Link :href="route('settings')"
                    ><svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                            stroke="#99ACD3"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M12.9046 3.06005C12.6988 3 12.4659 3 12 3C11.5341 3 11.3012 3 11.0954 3.06005C10.7942 3.14794 10.5281 3.32808 10.3346 3.57511C10.2024 3.74388 10.1159 3.96016 9.94291 4.39272C9.69419 5.01452 9.00393 5.33471 8.36857 5.123L7.79779 4.93281C7.3929 4.79785 7.19045 4.73036 6.99196 4.7188C6.70039 4.70181 6.4102 4.77032 6.15701 4.9159C5.98465 5.01501 5.83376 5.16591 5.53197 5.4677C5.21122 5.78845 5.05084 5.94882 4.94896 6.13189C4.79927 6.40084 4.73595 6.70934 4.76759 7.01551C4.78912 7.2239 4.87335 7.43449 5.04182 7.85566C5.30565 8.51523 5.05184 9.26878 4.44272 9.63433L4.16521 9.80087C3.74031 10.0558 3.52786 10.1833 3.37354 10.3588C3.23698 10.5141 3.13401 10.696 3.07109 10.893C3 11.1156 3 11.3658 3 11.8663C3 12.4589 3 12.7551 3.09462 13.0088C3.17823 13.2329 3.31422 13.4337 3.49124 13.5946C3.69158 13.7766 3.96395 13.8856 4.50866 14.1035C5.06534 14.3261 5.35196 14.9441 5.16236 15.5129L4.94721 16.1584C4.79819 16.6054 4.72367 16.829 4.7169 17.0486C4.70875 17.3127 4.77049 17.5742 4.89587 17.8067C5.00015 18.0002 5.16678 18.1668 5.5 18.5C5.83323 18.8332 5.99985 18.9998 6.19325 19.1041C6.4258 19.2295 6.68733 19.2913 6.9514 19.2831C7.17102 19.2763 7.39456 19.2018 7.84164 19.0528L8.36862 18.8771C9.00393 18.6654 9.6942 18.9855 9.94291 19.6073C10.1159 20.0398 10.2024 20.2561 10.3346 20.4249C10.5281 20.6719 10.7942 20.8521 11.0954 20.94C11.3012 21 11.5341 21 12 21C12.4659 21 12.6988 21 12.9046 20.94C13.2058 20.8521 13.4719 20.6719 13.6654 20.4249C13.7976 20.2561 13.8841 20.0398 14.0571 19.6073C14.3058 18.9855 14.9961 18.6654 15.6313 18.8773L16.1579 19.0529C16.605 19.2019 16.8286 19.2764 17.0482 19.2832C17.3123 19.2913 17.5738 19.2296 17.8063 19.1042C17.9997 18.9999 18.1664 18.8333 18.4996 18.5001C18.8328 18.1669 18.9994 18.0002 19.1037 17.8068C19.2291 17.5743 19.2908 17.3127 19.2827 17.0487C19.2759 16.8291 19.2014 16.6055 19.0524 16.1584L18.8374 15.5134C18.6477 14.9444 18.9344 14.3262 19.4913 14.1035C20.036 13.8856 20.3084 13.7766 20.5088 13.5946C20.6858 13.4337 20.8218 13.2329 20.9054 13.0088C21 12.7551 21 12.4589 21 11.8663C21 11.3658 21 11.1156 20.9289 10.893C20.866 10.696 20.763 10.5141 20.6265 10.3588C20.4721 10.1833 20.2597 10.0558 19.8348 9.80087L19.5569 9.63416C18.9478 9.26867 18.6939 8.51514 18.9578 7.85558C19.1262 7.43443 19.2105 7.22383 19.232 7.01543C19.2636 6.70926 19.2003 6.40077 19.0506 6.13181C18.9487 5.94875 18.7884 5.78837 18.4676 5.46762C18.1658 5.16584 18.0149 5.01494 17.8426 4.91583C17.5894 4.77024 17.2992 4.70174 17.0076 4.71872C16.8091 4.73029 16.6067 4.79777 16.2018 4.93273L15.6314 5.12287C14.9961 5.33464 14.3058 5.0145 14.0571 4.39272C13.8841 3.96016 13.7976 3.74388 13.6654 3.57511C13.4719 3.32808 13.2058 3.14794 12.9046 3.06005Z"
                            stroke="#99ACD3"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    Настройки</Link
                >
                <Link :href="route('home')" @click.prevent="logout"
                    ><svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M16 16L20 12M20 12L16 8M20 12H10M12 4H7.2C6.0799 4 5.51984 4 5.09202 4.21799C4.71569 4.40973 4.40973 4.71569 4.21799 5.09202C4 5.51984 4 6.0799 4 7.2V16.8C4 17.9201 4 18.4802 4.21799 18.908C4.40973 19.2843 4.71569 19.5903 5.09202 19.782C5.51984 20 6.0799 20 7.2 20H12"
                            stroke="#99ACD3"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    Выход</Link
                >
            </div>
        </div>

        <div
            v-else-if="viewportWidth < 991.98 && !is_auth"
            class="nav__buttons_mobile"
        >
            <div
                class="nav__button_mobile"
                data-popup="#auth"
                @click="this.linkChanger"
            >
                <img src="../../assets/img/user.svg" alt="" />
            </div>
            <div
                @click="burgerAction"
                v-if="viewportWidth < 767.98"
                class="nav__burger"
                :class="{ active: is_clicked }"
            >
                <div class="nav__burger_con">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>

    <popup-view id="auth">
        <div
            v-for="(error, i) in this.allErrors"
            :key="i"
            class="form_wrapper-message"
        >
            <div v-if="error" class="form_message form_message-error">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="25"
                    height="24"
                    viewBox="0 0 25 24"
                    fill="none"
                >
                    <path
                        d="M12.5 16C12.3022 16 12.1088 16.0587 11.9444 16.1686C11.7799 16.2784 11.6518 16.4346 11.5761 16.6173C11.5004 16.8001 11.4806 17.0011 11.5192 17.1951C11.5578 17.3891 11.653 17.5673 11.7929 17.7071C11.9327 17.847 12.1109 17.9422 12.3049 17.9808C12.4989 18.0194 12.6999 17.9996 12.8827 17.9239C13.0654 17.8482 13.2216 17.72 13.3314 17.5556C13.4413 17.3911 13.5 17.1978 13.5 17C13.5 16.7348 13.3946 16.4805 13.2071 16.2929C13.0195 16.1054 12.7652 16 12.5 16ZM23.17 17.47L15.12 3.47003C14.8598 3.00354 14.4798 2.61498 14.0192 2.3445C13.5586 2.07401 13.0341 1.9314 12.5 1.9314C11.9658 1.9314 11.4414 2.07401 10.9808 2.3445C10.5202 2.61498 10.1402 3.00354 9.87997 3.47003L1.87997 17.47C1.61076 17.924 1.46611 18.441 1.46061 18.9688C1.45511 19.4966 1.58897 20.0166 1.84865 20.4761C2.10834 20.9356 2.48467 21.3185 2.93965 21.5861C3.39463 21.8536 3.91215 21.9964 4.43997 22H20.56C21.092 22.0053 21.6159 21.8689 22.0779 21.6049C22.5399 21.341 22.9233 20.9589 23.1889 20.4978C23.4546 20.0368 23.5928 19.5134 23.5895 18.9814C23.5861 18.4493 23.4414 17.9277 23.17 17.47ZM21.44 19.47C21.3523 19.626 21.2244 19.7556 21.0697 19.8453C20.9149 19.935 20.7389 19.9815 20.56 19.98H4.43997C4.26108 19.9815 4.08507 19.935 3.93029 19.8453C3.7755 19.7556 3.64762 19.626 3.55997 19.47C3.4722 19.318 3.42599 19.1456 3.42599 18.97C3.42599 18.7945 3.4722 18.622 3.55997 18.47L11.56 4.47003C11.6439 4.30623 11.7714 4.16876 11.9284 4.07277C12.0854 3.97678 12.2659 3.92599 12.45 3.92599C12.634 3.92599 12.8145 3.97678 12.9715 4.07277C13.1286 4.16876 13.2561 4.30623 13.34 4.47003L21.39 18.47C21.4892 18.6199 21.5462 18.7937 21.555 18.9732C21.5638 19.1527 21.5241 19.3312 21.44 19.49V19.47ZM12.5 8.00003C12.2348 8.00003 11.9804 8.10538 11.7929 8.29292C11.6053 8.48046 11.5 8.73481 11.5 9.00003V13C11.5 13.2652 11.6053 13.5196 11.7929 13.7071C11.9804 13.8947 12.2348 14 12.5 14C12.7652 14 13.0195 13.8947 13.2071 13.7071C13.3946 13.5196 13.5 13.2652 13.5 13V9.00003C13.5 8.73481 13.3946 8.48046 13.2071 8.29292C13.0195 8.10538 12.7652 8.00003 12.5 8.00003Z"
                    />
                </svg>
                {{ error }}
            </div>
        </div>
        <div v-if="message" class="form_wrapper-message">
            <div class="form_message form_message-error">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="25"
                    height="24"
                    viewBox="0 0 25 24"
                    fill="none"
                >
                    <path
                        d="M12.5 16C12.3022 16 12.1088 16.0587 11.9444 16.1686C11.7799 16.2784 11.6518 16.4346 11.5761 16.6173C11.5004 16.8001 11.4806 17.0011 11.5192 17.1951C11.5578 17.3891 11.653 17.5673 11.7929 17.7071C11.9327 17.847 12.1109 17.9422 12.3049 17.9808C12.4989 18.0194 12.6999 17.9996 12.8827 17.9239C13.0654 17.8482 13.2216 17.72 13.3314 17.5556C13.4413 17.3911 13.5 17.1978 13.5 17C13.5 16.7348 13.3946 16.4805 13.2071 16.2929C13.0195 16.1054 12.7652 16 12.5 16ZM23.17 17.47L15.12 3.47003C14.8598 3.00354 14.4798 2.61498 14.0192 2.3445C13.5586 2.07401 13.0341 1.9314 12.5 1.9314C11.9658 1.9314 11.4414 2.07401 10.9808 2.3445C10.5202 2.61498 10.1402 3.00354 9.87997 3.47003L1.87997 17.47C1.61076 17.924 1.46611 18.441 1.46061 18.9688C1.45511 19.4966 1.58897 20.0166 1.84865 20.4761C2.10834 20.9356 2.48467 21.3185 2.93965 21.5861C3.39463 21.8536 3.91215 21.9964 4.43997 22H20.56C21.092 22.0053 21.6159 21.8689 22.0779 21.6049C22.5399 21.341 22.9233 20.9589 23.1889 20.4978C23.4546 20.0368 23.5928 19.5134 23.5895 18.9814C23.5861 18.4493 23.4414 17.9277 23.17 17.47ZM21.44 19.47C21.3523 19.626 21.2244 19.7556 21.0697 19.8453C20.9149 19.935 20.7389 19.9815 20.56 19.98H4.43997C4.26108 19.9815 4.08507 19.935 3.93029 19.8453C3.7755 19.7556 3.64762 19.626 3.55997 19.47C3.4722 19.318 3.42599 19.1456 3.42599 18.97C3.42599 18.7945 3.4722 18.622 3.55997 18.47L11.56 4.47003C11.6439 4.30623 11.7714 4.16876 11.9284 4.07277C12.0854 3.97678 12.2659 3.92599 12.45 3.92599C12.634 3.92599 12.8145 3.97678 12.9715 4.07277C13.1286 4.16876 13.2561 4.30623 13.34 4.47003L21.39 18.47C21.4892 18.6199 21.5462 18.7937 21.555 18.9732C21.5638 19.1527 21.5241 19.3312 21.44 19.49V19.47ZM12.5 8.00003C12.2348 8.00003 11.9804 8.10538 11.7929 8.29292C11.6053 8.48046 11.5 8.73481 11.5 9.00003V13C11.5 13.2652 11.6053 13.5196 11.7929 13.7071C11.9804 13.8947 12.2348 14 12.5 14C12.7652 14 13.0195 13.8947 13.2071 13.7071C13.3946 13.5196 13.5 13.2652 13.5 13V9.00003C13.5 8.73481 13.3946 8.48046 13.2071 8.29292C13.0195 8.10538 12.7652 8.00003 12.5 8.00003Z"
                    />
                </svg>
                {{ message }}
            </div>
        </div>
        <div class="invisible next" ref="next"></div>
        <swiper
            class="popup__slider"
            :modules="modules"
            :slides-per-view="1"
            :space-between="15"
            :pagination="pagination"
            :navigation="{
                nextEl: '.next',
                prevEl: '.prev',
            }"
            autoHeight
            @slideChange="swipe"
            v-if="this.is_reg === false"
        >
            <swiper-slide
                tag="form"
                @submit.prevent="submit"
                class="form form-popup popup__form popup_slide"
                data-id="login"
            >
                <main-title tag="h3" title-name="Войти в аккаунт Allbtc" />
                <input
                    v-model="form.email"
                    required
                    autofocus
                    type="text"
                    name="login"
                    class="input popup__input"
                    placeholder="Введите ваш Email"
                />
                <div class="form_row">
                    <input
                        v-model="form.password"
                        required
                        type="password"
                        name="password"
                        class="input popup__input"
                        placeholder="Введите пароль"
                        ref="password-login"
                    />
                    <svg
                        @click="this.seePassword('password-login')"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M11.9999 16.3299C9.60992 16.3299 7.66992 14.3899 7.66992 11.9999C7.66992 9.60992 9.60992 7.66992 11.9999 7.66992C14.3899 7.66992 16.3299 9.60992 16.3299 11.9999C16.3299 14.3899 14.3899 16.3299 11.9999 16.3299ZM11.9999 9.16992C10.4399 9.16992 9.16992 10.4399 9.16992 11.9999C9.16992 13.5599 10.4399 14.8299 11.9999 14.8299C13.5599 14.8299 14.8299 13.5599 14.8299 11.9999C14.8299 10.4399 13.5599 9.16992 11.9999 9.16992Z"
                        />
                        <path
                            d="M12.0001 21.02C8.24008 21.02 4.69008 18.82 2.25008 15C1.19008 13.35 1.19008 10.66 2.25008 8.99998C4.70008 5.17998 8.25008 2.97998 12.0001 2.97998C15.7501 2.97998 19.3001 5.17998 21.7401 8.99998C22.8001 10.65 22.8001 13.34 21.7401 15C19.3001 18.82 15.7501 21.02 12.0001 21.02ZM12.0001 4.47998C8.77008 4.47998 5.68008 6.41998 3.52008 9.80998C2.77008 10.98 2.77008 13.02 3.52008 14.19C5.68008 17.58 8.77008 19.52 12.0001 19.52C15.2301 19.52 18.3201 17.58 20.4801 14.19C21.2301 13.02 21.2301 10.98 20.4801 9.80998C18.3201 6.41998 15.2301 4.47998 12.0001 4.47998Z"
                        />
                    </svg>
                    <div
                        class="slash"
                        @click="this.seePassword('password-login')"
                        data-password="password-login"
                    ></div>
                </div>
                <blue-button>
                    <button class="all-link" type="submit">Войти</button>
                </blue-button>
                <div class="popup__text">
                    Нет аккаунта?
                    <span class="main__link" @click="this.formChanger">
                        Зарегистрироваться
                    </span>
                </div>
            </swiper-slide>
        </swiper>
        <swiper
            tag="from"
            class="popup__slider form form-popup popup__form"
            :modules="modules"
            :slides-per-view="1"
            :space-between="15"
            :pagination="pagination"
            :navigation="{
                nextEl: '.next',
                prevEl: '.prev',
            }"
            :allowSlideNext="false"
            :allowTouchMove="false"
            autoHeight
            @slideChange="swipe"
            @swiper="this.swiper_init"
            v-else-if="this.is_reg === true"
        >
            <swiper-slide class="popup_slide form form-popup" data-id="email">
                <main-title tag="h3" title-name="Создать аккаунт Allbtc" />
                <input
                    v-model="new_account_input.email"
                    autofocus
                    name="Reg_email"
                    type="email"
                    class="input popup__input"
                    placeholder="Введите ваш Email"
                    ref="email"
                />

                <blue-button
                    type="button"
                    @click="this.email_validate(get_email)"
                >
                    <div class="all-link">Дальше</div>
                </blue-button>
                <div class="popup__text">
                    Уже есть аккаунт?
                    <span class="main__link" @click="this.formChanger">
                        Войти
                    </span>
                </div>
            </swiper-slide>
            <!--            <swiper-slide class="popup_slide form form-popup" data-id="email">-->
            <!--                <main-title-->
            <!--                    tag="h3"-->
            <!--                    title-name="Создать аккаунт Allbtc"-->
            <!--                ></main-title>-->
            <!--                <div class="popup__text">-->
            <!--                    Мы отправили проверочный код на ваш электронный адрес-->
            <!--                </div>-->
            <!--                <input-->
            <!--                    type="text"-->
            <!--                    class="input popup__input"-->
            <!--                    placeholder="Введите код"-->
            <!--                    ref="code"-->
            <!--                />-->
            <!--                <div class="popup__text">-->
            <!--                    Код не пришёл?-->
            <!--                    <span class="main__link" @click="sendCode"-->
            <!--                        >Отправить повторно</span-->
            <!--                    >-->
            <!--                </div>-->
            <!--                <div class="popup__buttons form__buttons">-->
            <!--                    <blue-button class="back prev">-->
            <!--                        <button class="all-link">Назад</button>-->
            <!--                    </blue-button>-->
            <!--                    <blue-button @click="this.codeValidate">-->
            <!--                        <button class="all-link">Дальше</button>-->
            <!--                    </blue-button>-->
            <!--                </div>-->
            <!--            </swiper-slide>-->
            <swiper-slide class="popup_slide form form-popup" data-id="email">
                <main-title tag="h3" title-name="Создать аккаунт Allbtc" />
                <input
                    v-model="new_account_input.name"
                    required
                    autofocus
                    name="Reg_name"
                    type="text"
                    class="input popup__input"
                    placeholder="Введите название аккаунита"
                    ref="name"
                />

                <blue-button type="button" @click="this.name_validate">
                    <button class="all-link">Дальше</button>
                </blue-button>
            </swiper-slide>
            <swiper-slide class="popup_slide form form-popup" data-id="email">
                <main-title tag="h3" title-name="Создать аккаунт Allbtc" />
                <div class="form_row">
                    <input
                        v-model="new_account_input.password"
                        required
                        autofocus
                        autocomplete="off"
                        type="password"
                        class="input popup__input"
                        placeholder="Введите пароль"
                        ref="password"
                    />
                    <svg
                        @click="this.seePassword('password')"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M11.9999 16.3299C9.60992 16.3299 7.66992 14.3899 7.66992 11.9999C7.66992 9.60992 9.60992 7.66992 11.9999 7.66992C14.3899 7.66992 16.3299 9.60992 16.3299 11.9999C16.3299 14.3899 14.3899 16.3299 11.9999 16.3299ZM11.9999 9.16992C10.4399 9.16992 9.16992 10.4399 9.16992 11.9999C9.16992 13.5599 10.4399 14.8299 11.9999 14.8299C13.5599 14.8299 14.8299 13.5599 14.8299 11.9999C14.8299 10.4399 13.5599 9.16992 11.9999 9.16992Z"
                        />
                        <path
                            d="M12.0001 21.02C8.24008 21.02 4.69008 18.82 2.25008 15C1.19008 13.35 1.19008 10.66 2.25008 8.99998C4.70008 5.17998 8.25008 2.97998 12.0001 2.97998C15.7501 2.97998 19.3001 5.17998 21.7401 8.99998C22.8001 10.65 22.8001 13.34 21.7401 15C19.3001 18.82 15.7501 21.02 12.0001 21.02ZM12.0001 4.47998C8.77008 4.47998 5.68008 6.41998 3.52008 9.80998C2.77008 10.98 2.77008 13.02 3.52008 14.19C5.68008 17.58 8.77008 19.52 12.0001 19.52C15.2301 19.52 18.3201 17.58 20.4801 14.19C21.2301 13.02 21.2301 10.98 20.4801 9.80998C18.3201 6.41998 15.2301 4.47998 12.0001 4.47998Z"
                        />
                    </svg>
                    <div
                        class="slash"
                        @click="this.seePassword('password')"
                        data-password="password"
                    ></div>
                </div>
                <div class="form_row">
                    <input
                        v-model="new_account_input['password_confirmation']"
                        required
                        autofocus
                        autocomplete="off"
                        type="password"
                        class="input popup__input"
                        placeholder="Подтвердите пароль"
                        ref="password-confirm"
                    />
                    <svg
                        @click="this.seePassword('password-confirm')"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M11.9999 16.3299C9.60992 16.3299 7.66992 14.3899 7.66992 11.9999C7.66992 9.60992 9.60992 7.66992 11.9999 7.66992C14.3899 7.66992 16.3299 9.60992 16.3299 11.9999C16.3299 14.3899 14.3899 16.3299 11.9999 16.3299ZM11.9999 9.16992C10.4399 9.16992 9.16992 10.4399 9.16992 11.9999C9.16992 13.5599 10.4399 14.8299 11.9999 14.8299C13.5599 14.8299 14.8299 13.5599 14.8299 11.9999C14.8299 10.4399 13.5599 9.16992 11.9999 9.16992Z"
                        />
                        <path
                            d="M12.0001 21.02C8.24008 21.02 4.69008 18.82 2.25008 15C1.19008 13.35 1.19008 10.66 2.25008 8.99998C4.70008 5.17998 8.25008 2.97998 12.0001 2.97998C15.7501 2.97998 19.3001 5.17998 21.7401 8.99998C22.8001 10.65 22.8001 13.34 21.7401 15C19.3001 18.82 15.7501 21.02 12.0001 21.02ZM12.0001 4.47998C8.77008 4.47998 5.68008 6.41998 3.52008 9.80998C2.77008 10.98 2.77008 13.02 3.52008 14.19C5.68008 17.58 8.77008 19.52 12.0001 19.52C15.2301 19.52 18.3201 17.58 20.4801 14.19C21.2301 13.02 21.2301 10.98 20.4801 9.80998C18.3201 6.41998 15.2301 4.47998 12.0001 4.47998Z"
                        />
                    </svg>
                    <div
                        class="slash"
                        @click="this.seePassword('password-confirm')"
                        data-password="password-confirm"
                    ></div>
                </div>

                <blue-button
                    type="button"
                    @click="this.password_validate(account_create)"
                >
                    <button class="all-link">Зарегистрироваться</button>
                </blue-button>
            </swiper-slide>
        </swiper>
    </popup-view>
</template>

<script>
import { Link, useForm, router } from "@inertiajs/vue3";
import NavLinks from "@/Components/navs/NavLinks.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import PopupView from "@/Components/technical/PopupView.vue";
// import AutoHeightSelect from "@/Components/UI/AutoHeightSelect.vue";
import { Pagination, Navigation } from "swiper";
import { Swiper, SwiperSlide } from "swiper/vue";
import axios from "axios";
import { ref, defineComponent } from "vue";

import "swiper/css";
import "swiper/css/pagination";
import MainList from "@/Components/UI/MainList.vue";
import { mapGetters } from "vuex";

export default defineComponent({
    components: {
        MainList,
        // AutoHeightSelect,
        PopupView,
        BlueButton,
        MainTitle,
        Link,
        NavLinks,
        // eslint-disable-next-line vue/no-unused-components
        Swiper,
        // eslint-disable-next-line vue/no-unused-components
        SwiperSlide,
    },
    data() {
        return {
            is_clicked: false,
            viewportWidth: 0,
            is_reg: false,
            swiper: {},
            // wallets: [
            //     { title: "BTC", value: "btc", img: "bitcoin_img.png" },
            //     { title: "BCH", value: "bch", img: "bitcoin-cash_img.png" },
            //     { title: "Dash", value: "dash", img: "dash_img.png" },
            //     { title: "Etc", value: "etc", img: "etc_img.png" },
            //     { title: "Litecoin", value: "ltc", img: "litecoin_img.png" },
            // ],
            frontErrs: {
                name: "",
                code: "",
                password: "",
            },
        };
    },
    props: {
        is_auth: {
            type: Boolean,
            default: false,
        },
        user: {
            type: Object,
        },
        errors: {
            type: Object,
        },
        message: {
            type: String,
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    setup() {
        let message = ref("");
        const form = useForm({
            email: "",
            password: "",
            remember: false,
        });
        const new_account_input = useForm({
            email: "",
            name: "",
            password: "",
            ["password_confirmation"]: "",
        });
        const submit = async () => {
            axios
                .post("/login", {
                    email: form.email,
                    password: form.password,
                })
                .then((response) => {
                    router.visit("/profile/accounts");
                })
                .catch((error) => {
                    // this.frontErrs.message = this.message;
                    message.value = error.response.data.message;
                });
        };
        const logout = async () => {
            axios
                .post("/logout", {
                    email: form.email,
                    password: form.password,
                    remember: false,
                })
                .catch((error) => {
                    console.log(error.response);
                });
        };
        const instance = axios.create({
            baseURL: "https://pool.api.btc.com/v1",
            headers: { "Content-Type": "application/json; charset=utf-8" },
        });
        const addAcc = (id) => {
            let data = {
                puid: "781195",
                group_name: new_account_input.name,
            };
            instance
                .post(
                    "groups/create?access_key=sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N&puid=781195",
                    data
                )
                .then(async (resp) => {
                    data.group_id = String(resp.data.data.gid);
                    data.user_id = id;
                    // eslint-disable-next-line no-undef
                    await axios.put(route("sub_create"), data);
                    router.visit("/profile/accounts");
                })
                .catch((err) => {
                    console.log(err);
                });
        };

        const get_email = async () => {
            let email = useForm({
                email: new_account_input.email,
            });
            let val = false;
            message.value = "";
            // eslint-disable-next-line no-undef
            await instance.post(route("user_get"), email).then((res) => {
                res.data !== "" ? (val = true) : (val = false);
            });
            return val;
        };
        const account_create = () => {
            axios
                .post("/register", {
                    email: new_account_input.email,
                    name: new_account_input.name,
                    password: new_account_input.password,
                    password_confirmation:
                        new_account_input.password_confirmation,
                })
                .then(async (response) => {
                    await addAcc(response.data.id);
                })
                .catch((error) => {
                    console.log(error);
                });
        };
        // const account_create = async () => {
        //     const csrfToken = document
        //         .querySelector('meta[name="csrf-token"]')
        //         .getAttribute("content");
        //     // Регистрация аккаунта
        //     await fetch(route("register"), {
        //         method: "POST",
        //         headers: {
        //             "Content-Type": "application/json",
        //             "X-CSRF-TOKEN": csrfToken,
        //         },
        //         body: JSON.stringify({
        //             email: new_account_input.email,
        //             name: new_account_input.name,
        //             password: new_account_input.password,
        //             password_confirmation:
        //                 new_account_input.password_confirmation,
        //         }),
        //     }).then((res) => {
        //         if (res.ok) {
        //             message.value = "Подтвердите почту";
        //             addAcc();
        //         } else {
        //             message.value = "Ошибка регистрации";
        //         }
        //     });
        // };

        let swipe = () => {
            document.querySelectorAll("#auth .popup_slide").forEach((el) => {
                setTimeout(() => {
                    if (el.classList.contains("swiper-slide-active")) {
                        location.replace(`#${el.dataset.id}`);
                    }
                }, 10);
            });
        };

        return {
            pagination: {
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + "</span>";
                },
            },
            paginationUnClicalble: {
                clickable: false,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + "</span>";
                },
            },
            runCallbacksOnInit: {},
            modules: [Pagination, Navigation],
            form,
            new_account_input,
            submit,
            account_create,
            swipe,
            get_email,
            logout,
            message,
        };
    },
    computed: {
        ...mapGetters(["getIncome", "allAccounts", "getActive"]),
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
        allErrors() {
            let obj = {};
            if (this.errors) {
                obj = this.errors;
            }
            const target = Object.assign(obj, this.frontErrs);

            return target;
        },
    },
    methods: {
        open() {
            this.$refs.list.classList.add("target");
        },
        close() {
            setTimeout(() => {
                this.$refs.list.classList.remove("target");
            }, 500);
        },
        seePassword(type) {
            if (this.$refs[`${type}`].getAttribute("type") === "password") {
                document.querySelector(
                    `[data-password="${type}"]`
                ).style.width = "24px";
                this.$refs[`${type}`].setAttribute("type", "text");
            } else {
                document.querySelector(
                    `[data-password="${type}"]`
                ).style.width = "0";
                this.$refs[`${type}`].setAttribute("type", "password");
            }
        },
        formChanger() {
            this.is_reg === true ? (this.is_reg = false) : (this.is_reg = true);
            this.allErrors_destroyer();
        },
        slideNext() {
            this.swiper.allowSlideNext = true;
            this.$refs.next.click();
            this.swiper.allowSlideNext = false;
        },
        swiper_init(swiper) {
            this.swiper = swiper;
        },
        allErrors_destroyer() {
            this.allErrors["email"] = "";
            this.allErrors["regError"] = "";
            this.allErrors["name"] = "";
            this.frontErrs = {
                name: "",
                code: "",
                password: "",
            };
        },
        async email_validate(get_email) {
            // eslint-disable-next-line no-undef
            let reg =
                /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            let tester = (val) => {
                // eslint-disable-next-line no-undef
                return reg.test(val);
            };
            let emailTest;
            await get_email().then((res) => {
                emailTest = res;
            });
            this.allErrors_destroyer();
            if (this.$refs.email.value === "") {
                this.allErrors.email = "Необходимо заполнить «Email»";
            } else if (!tester(this.$refs.email.value)) {
                this.allErrors.email = "Некорректное поле «Email»";
            } else if (emailTest) {
                this.allErrors.email = "Такой «Email» уже зарегистрирован";
            } else {
                this.allErrors_destroyer();
                this.slideNext();
            }
        },
        name_validate() {
            this.allErrors_destroyer();
            const instance = axios.create({
                baseURL: "https://pool.api.btc.com/v1",
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                },
            });
            let validate = true;

            if (this.$refs.name.value === "") {
                this.allErrors.name = "Необходимо заполнить «Аккаунт»";
            } else {
                this.get_group(instance, validate);
            }
        },
        async get_group(instance, validate) {
            instance
                .get(
                    "/worker/groups?access_key=sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N&puid=781195&page=1&page_size=52"
                )
                .then((resp) => {
                    resp.data.data.list.forEach((group, i) => {
                        if (i > 1) {
                            if (group.name === this.$refs.name.value) {
                                this.allErrors.name =
                                    "Аккаунт с таким именем уже существует";
                                validate = false;
                            } else if (
                                i === resp.data.data.list.length - 1 &&
                                validate === true
                            ) {
                                this.allErrors_destroyer();
                                this.slideNext();
                            }
                        } else if (
                            i === resp.data.data.list.length - 1 &&
                            validate === true
                        ) {
                            this.allErrors_destroyer();
                            this.slideNext();
                        }
                    });
                });
        },
        password_validate(account_create) {
            if (
                this.$refs["password-confirm"].value ===
                    this.$refs.password.value &&
                this.$refs.password.value !== "" &&
                this.$refs.password.value.length > 6
            ) {
                this.allErrors_destroyer();
                account_create();
                this.formChanger();
            } else {
                this.allErrors_destroyer();
                this.allErrors.password = "Необходимо подтвердить пароль";
            }
        },
        linkChanger() {
            this.is_reg = false;
            document.querySelectorAll("#auth .popup_slide").forEach((el) => {
                setTimeout(() => {
                    if (el.classList.contains("swiper-slide-active")) {
                        location.replace(`#${el.dataset.id}`);
                    }
                }, 10);
            });
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        burgerAction() {
            if (this.is_clicked === true && this.viewportWidth < 767.98) {
                this.is_clicked = false;
                document.querySelector("body").style.overflow = "auto";
                document
                    .querySelector(".nav__links_con")
                    .classList.remove("open");
            } else if (
                this.is_clicked === false &&
                this.viewportWidth < 767.98
            ) {
                this.is_clicked = true;
                document.querySelector("body").style.overflow = "hidden";
                document.querySelector(".nav__links_con").classList.add("open");
            }
        },
        handleScroller(bool) {
            if (
                bool === false &&
                document.querySelector("body").classList.contains("header-fix")
            ) {
                document
                    .querySelector(".nav__container")
                    .classList.remove("fixed");
            } else if (
                bool === true &&
                document.querySelector("body").classList.contains("header-fix")
            ) {
                document
                    .querySelector(".nav__container")
                    .classList.add("fixed");
            }
        },
        handleScroll(attr) {
            if (attr === "update") {
                document.querySelector("body").classList.remove("header-fix");
            }
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        document
                            .querySelector(".nav__container")
                            .classList.remove("fixed");
                        document
                            .querySelector("body")
                            .classList.remove("header-fix");
                    } else if (!entry.isIntersecting) {
                        document
                            .querySelector("body")
                            .classList.add("header-fix");
                    }
                });
            });
            animationObserver.observe(
                document.querySelector(".observer_block")
            );
            window.addEventListener("wheel", (e) => {
                if (e.deltaY < 0) {
                    setTimeout(() => {
                        this.handleScroller(true);
                    }, 10);
                } else {
                    this.handleScroller(false);
                }
            });
        },
    },
});
</script>

<style lang="scss" scoped>
.header-fix {
    @media (min-width: 1271px) {
        nav.nav__container {
            position: fixed;
            transform: translateX(-50%) translateY(-120%);
            z-index: 100;
        }
    }
}

#app {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    overflow: hidden;
    background: linear-gradient(
        179.87deg,
        #e6eaf0 1.02%,
        #e6eaf1 4.79%,
        #e7ebf1 8.76%,
        #eaeef4 14.75%,
        #e8ecf2 19.07%
    );
    width: 100vw;
}

.swiper {
    padding-bottom: 0 !important;
    .swiper {
        &-slide {
            margin: auto 0;
        }
    }
}

.all-link {
    width: 100%;
    height: 100%;
    padding: 14px 40px;
    display: block;
}

.nav__logo {
    max-width: 170px;
    @media (max-width: 767.98px) {
        &.headder {
            position: relative;
            z-index: 100;
        }
        max-width: 138px;
    }
}

nav.nav__container {
    position: relative;
    z-index: 100;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 115px;
    width: 100%;
    box-sizing: border-box !important;
    padding: 40px 0 15px;
    @media (min-width: 1271px) {
        transition: all 0.3s ease 0s;
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%) translateY(0);
        width: 100vw;
        z-index: 100;
        &:before {
            transition: all 0.3s ease 0s;
            left: 50%;
            content: "";
            transform: translateX(-50%) translateY(-120%);
            top: 0;
            width: 100vw;
            height: 101px;
            z-index: -1;
            position: fixed;
            filter: drop-shadow(0px 1px 1px rgba(0, 0, 0, 0.1));
            background: linear-gradient(
                179.87deg,
                #e6eaf0 1.02%,
                #e6eaf1 4.79%,
                #e7ebf1 8.76%,
                #eaeef4 14.75%,
                #e8ecf2 19.07%
            );
        }
        &.fixed {
            transform: translateX(-50%) translateY(0);

            &:before {
                transform: translateX(-50%) translateY(0);
            }
        }
    }
    @media (max-width: 1270px) {
        padding: 40px 0 15px;
        gap: 50px;
    }
    @media (max-width: 991.98px) {
        padding-top: 20px;
    }
    @media (max-width: 767.98px) {
        padding: 20px 15px 15px;
        position: fixed;
        gap: 15px;
        &::before {
            content: "";
            position: absolute;
            z-index: 100;
            width: 100%;
            height: 100%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            filter: drop-shadow(0px 1px 1px rgba(0, 0, 0, 0.1));
            background: linear-gradient(
                179.87deg,
                #e6eaf0 1.02%,
                #e6eaf1 4.79%,
                #e7ebf1 8.76%,
                #eaeef4 14.75%,
                #e8ecf2 19.07%
            );
        }
    }
}

.nav__buttons_mobile {
    display: flex;
    align-items: center;
    gap: 10px;
    position: relative;
    z-index: 100;

    & .nav__burger {
        background: #4182ec;
        border-radius: 5px;
        width: 60px;
        height: 45px;
        gap: 4px;
        transition: all 0.3s ease 0s;

        &:active {
            background: #305ea8;
            box-shadow: inset 0 4px 4px rgba(0, 0, 0, 0.25);
        }

        &_con {
            margin: 0 auto;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 4px;
            width: 18px;
            overflow: hidden;
        }

        & span {
            display: block;
            width: 18px;
            height: 1.5px;
            flex: 0 0 1.5px;
            background-color: #fff;
            border-radius: 5px;
            position: relative;
            right: 0;
            transition: all 0.3s ease 0.3s;

            &:nth-child(2) {
                transition: all 0.3s ease 0s;

                &::before {
                    transition: all 0.3s ease 0s;
                    content: "";
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    background-color: #fff;
                }
            }
        }

        &.active {
            & span {
                &:nth-child(1) {
                    transition: all 0.3s ease 0s;
                    right: 100%;
                }

                &:nth-child(2) {
                    transition: all 0.3s ease 0.3s;
                    transform: rotate(45deg);

                    &::before {
                        transition: all 0.3s ease 0.3s;
                        transform: rotate(-90deg);
                    }
                }

                &:nth-child(3) {
                    transition: all 0.3s ease 0s;
                    right: -100%;
                }
            }
        }
    }
}

.nav__button {
    font-style: normal;
    font-weight: 400;
    font-size: 17px;
    line-height: 143.1%;
    color: #3f7bdd;
    background: rgba(194, 213, 242, 0.61);
    border-radius: 5px;
    padding: 11px 36px;
    white-space: nowrap;
    transition: all 0.3s ease 0s;
    cursor: pointer;
    @media (any-hover: hover) {
        &:hover {
            background: rgba(194, 213, 242);
        }
    }

    &_mobile {
        background: rgba(194, 213, 242, 0.61);
        border-radius: 5px;
        width: 60px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        white-space: nowrap;
        transition: all 0.3s ease 0s;
        @media (any-hover: hover) {
            &:hover {
                background: rgba(194, 213, 242);
            }
        }
    }
    &_menu {
        position: absolute;
        top: calc(100% + 8px);
        visibility: hidden;
        opacity: 0;
        max-height: 0;
        padding: 16px;
        right: 0;
        min-width: 230px;
        border-radius: 21px;
        background: #ffffff;
        transition: all 0.6s ease 0s, opacity 0.7s ease 0s;
        height: fit-content;
        display: flex;
        flex-direction: column;
        gap: 16px;
        overflow: hidden;
        &:hover {
            transform: translate(4px, 4px);
            color: #000034;
            visibility: visible;
            max-height: 500px;
            opacity: 1;
        }
        a {
            font-weight: 400;
            display: inline-flex;
            gap: 10px;
            align-items: center;
            transition: all 0.3s ease 0s;
            text-decoration: underline;
            text-decoration-color: transparent;
            &:hover {
                text-decoration-color: #000034;
            }
        }
    }
    &_link {
        padding: 0 20px;
        width: 100%;
        height: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    &-account {
        border-radius: 13px;
        padding: 0;
        height: 44px;
        min-width: 162px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 700;
        line-height: 20px;
        color: #000034;
        transition: all 0.3s ease 0s;
        position: relative;
        background: rgba(194, 213, 242, 0.61);
        &.target {
            .nav__button_menu {
                transform: translate(4px, 4px);
                color: #000034;
                visibility: visible;
                max-height: 500px;
                opacity: 1;
            }
        }
        .list_button {
            a {
                text-decoration: none;
            }
        }
        .mini {
            height: fit-content;
            margin-top: -8px;
        }
        &:before {
            content: "";
            position: absolute;
            border-radius: 16px;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                84.14deg,
                rgba(63, 123, 221, 0.27) 8.75%,
                rgba(66, 130, 236, 0.27) 92.01%
            );
            left: 0;
            top: 0;
            transition: all 0.3s ease 0s;
        }
        @media (any-hover: hover) {
            &:hover {
                color: #ffffff;
                background-color: #3f7bdd;
                transform: translate(-4px, -4px);
                //.nav__button_menu {
                //    transform: translate(4px, 4px);
                //    color: #000034;
                //    visibility: visible;
                //    max-height: 500px;
                //    opacity: 1;
                //}
                &:before {
                    transform: translate(4px, 4px);
                }
            }
        }
    }
}
</style>
