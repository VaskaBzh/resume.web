<template>
    <nav class="nav__container">
        <Link :href="route('home')">
            <img
                class="nav__logo headder"
                src="../../assets/img/logo_high_quality.png"
                alt="logo"
            />
        </Link>

        <nav-links
            @clicked="burgerAction"
            @auth="changeSlide"
            :is_auth="is_auth"
            :viewportWidth="viewportWidth"
        />
        <div
            v-show="viewportWidth >= 991.98 && !is_auth"
            class="nav__button"
            data-popup="#auth"
            @mousedown="this.linkChanger"
        >
            Личный кабинет
        </div>
        <div
            v-show="
                viewportWidth <= 991.98 && !is_auth && viewportWidth >= 767.98
            "
            class="nav__button_mobile"
            data-popup="#auth"
            @click="this.linkChanger"
        >
            <img src="../../assets/img/user.svg" alt="" />
        </div>

        <account-menu
            v-show="viewportWidth >= 767.78 && is_auth"
        ></account-menu>

        <div v-show="viewportWidth < 767.98" class="nav__buttons_mobile">
            <div
                @click="burgerAction"
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

    <popup-view id="auth" :wait="this.wait">
        <div
            v-for="(error, i) in this.errors"
            :key="i"
            class="form_wrapper-message"
        >
            <div
                v-if="
                    error &&
                    error !==
                        'Ваша электронная почта еще не подтверждена. Подтвердите адрес.'
                "
                class="form_message form_message-error"
            >
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
            <div v-else-if="error" class="form_message form_message-error">
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
                <div>
                    {{ error.replace(" Подтвердите адрес.", "") }}
                    <span class="main__link" @click="reverify">
                        Подтвердите адрес.</span
                    >
                </div>
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
                    <button class="all-link" type="submit">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 9.64 2 7.4 3.42 5.52C3.67 5.19 4.14 5.13 4.47 5.38C4.8 5.63 4.87 6.1 4.62 6.43C3.4 8.04 2.75 9.97 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75C11.59 2.75 11.25 2.41 11.25 2C11.25 1.59 11.59 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75Z"
                            />
                            <path
                                d="M12 19.75C7.73 19.75 4.25 16.27 4.25 12C4.25 11.59 4.59 11.25 5 11.25C5.41 11.25 5.75 11.59 5.75 12C5.75 15.45 8.55 18.25 12 18.25C15.45 18.25 18.25 15.45 18.25 12C18.25 8.55 15.45 5.75 12 5.75C11.59 5.75 11.25 5.41 11.25 5C11.25 4.59 11.59 4.25 12 4.25C16.27 4.25 19.75 7.73 19.75 12C19.75 16.27 16.27 19.75 12 19.75Z"
                            />
                            <path
                                d="M12 16.75C11.59 16.75 11.25 16.41 11.25 16C11.25 15.59 11.59 15.25 12 15.25C13.79 15.25 15.25 13.79 15.25 12C15.25 10.21 13.79 8.75 12 8.75C11.59 8.75 11.25 8.41 11.25 8C11.25 7.59 11.59 7.25 12 7.25C14.62 7.25 16.75 9.38 16.75 12C16.75 14.62 14.62 16.75 12 16.75Z"
                            /></svg
                        >Войти
                    </button>
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

                <blue-button type="button" @click="this.email_validate">
                    <div class="all-link">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 9.64 2 7.4 3.42 5.52C3.67 5.19 4.14 5.13 4.47 5.38C4.8 5.63 4.87 6.1 4.62 6.43C3.4 8.04 2.75 9.97 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75C11.59 2.75 11.25 2.41 11.25 2C11.25 1.59 11.59 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75Z"
                            />
                            <path
                                d="M12 19.75C7.73 19.75 4.25 16.27 4.25 12C4.25 11.59 4.59 11.25 5 11.25C5.41 11.25 5.75 11.59 5.75 12C5.75 15.45 8.55 18.25 12 18.25C15.45 18.25 18.25 15.45 18.25 12C18.25 8.55 15.45 5.75 12 5.75C11.59 5.75 11.25 5.41 11.25 5C11.25 4.59 11.59 4.25 12 4.25C16.27 4.25 19.75 7.73 19.75 12C19.75 16.27 16.27 19.75 12 19.75Z"
                            />
                            <path
                                d="M12 16.75C11.59 16.75 11.25 16.41 11.25 16C11.25 15.59 11.59 15.25 12 15.25C13.79 15.25 15.25 13.79 15.25 12C15.25 10.21 13.79 8.75 12 8.75C11.59 8.75 11.25 8.41 11.25 8C11.25 7.59 11.59 7.25 12 7.25C14.62 7.25 16.75 9.38 16.75 12C16.75 14.62 14.62 16.75 12 16.75Z"
                            /></svg
                        >Дальше
                    </div>
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
                    placeholder="Введите название аккаунта"
                    ref="name"
                />

                <blue-button
                    type="button"
                    @click="this.name_validate(this.get_group)"
                >
                    <button class="all-link">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 9.64 2 7.4 3.42 5.52C3.67 5.19 4.14 5.13 4.47 5.38C4.8 5.63 4.87 6.1 4.62 6.43C3.4 8.04 2.75 9.97 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75C11.59 2.75 11.25 2.41 11.25 2C11.25 1.59 11.59 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75Z"
                            />
                            <path
                                d="M12 19.75C7.73 19.75 4.25 16.27 4.25 12C4.25 11.59 4.59 11.25 5 11.25C5.41 11.25 5.75 11.59 5.75 12C5.75 15.45 8.55 18.25 12 18.25C15.45 18.25 18.25 15.45 18.25 12C18.25 8.55 15.45 5.75 12 5.75C11.59 5.75 11.25 5.41 11.25 5C11.25 4.59 11.59 4.25 12 4.25C16.27 4.25 19.75 7.73 19.75 12C19.75 16.27 16.27 19.75 12 19.75Z"
                            />
                            <path
                                d="M12 16.75C11.59 16.75 11.25 16.41 11.25 16C11.25 15.59 11.59 15.25 12 15.25C13.79 15.25 15.25 13.79 15.25 12C15.25 10.21 13.79 8.75 12 8.75C11.59 8.75 11.25 8.41 11.25 8C11.25 7.59 11.59 7.25 12 7.25C14.62 7.25 16.75 9.38 16.75 12C16.75 14.62 14.62 16.75 12 16.75Z"
                            /></svg
                        >Дальше
                    </button>
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
                    <button class="all-link">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 9.64 2 7.4 3.42 5.52C3.67 5.19 4.14 5.13 4.47 5.38C4.8 5.63 4.87 6.1 4.62 6.43C3.4 8.04 2.75 9.97 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75C11.59 2.75 11.25 2.41 11.25 2C11.25 1.59 11.59 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75Z"
                            />
                            <path
                                d="M12 19.75C7.73 19.75 4.25 16.27 4.25 12C4.25 11.59 4.59 11.25 5 11.25C5.41 11.25 5.75 11.59 5.75 12C5.75 15.45 8.55 18.25 12 18.25C15.45 18.25 18.25 15.45 18.25 12C18.25 8.55 15.45 5.75 12 5.75C11.59 5.75 11.25 5.41 11.25 5C11.25 4.59 11.59 4.25 12 4.25C16.27 4.25 19.75 7.73 19.75 12C19.75 16.27 16.27 19.75 12 19.75Z"
                            />
                            <path
                                d="M12 16.75C11.59 16.75 11.25 16.41 11.25 16C11.25 15.59 11.59 15.25 12 15.25C13.79 15.25 15.25 13.79 15.25 12C15.25 10.21 13.79 8.75 12 8.75C11.59 8.75 11.25 8.41 11.25 8C11.25 7.59 11.59 7.25 12 7.25C14.62 7.25 16.75 9.38 16.75 12C16.75 14.62 14.62 16.75 12 16.75Z"
                            />
                        </svg>
                        Зарегистрироваться
                    </button>
                </blue-button>
            </swiper-slide>
        </swiper>
    </popup-view>
</template>

<script>
import { Link, router, useForm } from "@inertiajs/vue3";
import NavLinks from "@/Components/navs/NavLinks.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import AccountMenu from "@/Components/UI/AccountMenu.vue";
import PopupView from "@/Components/technical/PopupView.vue";
import AutoHeightSelect from "@/Components/UI/AutoHeightSelect.vue";
import { Navigation, Pagination } from "swiper";
import { Swiper, SwiperSlide } from "swiper/vue";
import axios from "axios";
import { defineComponent, reactive, ref } from "vue";
import "swiper/css";
import "swiper/css/pagination";
import MainList from "@/Components/UI/MainList.vue";
import { mapGetters } from "vuex";

export default defineComponent({
    components: {
        MainList,
        AutoHeightSelect,
        PopupView,
        BlueButton,
        MainTitle,
        Link,
        NavLinks,
        // eslint-disable-next-line vue/no-unused-components
        Swiper,
        // eslint-disable-next-line vue/no-unused-components
        SwiperSlide,
        AccountMenu,
    },
    data() {
        return {
            is_clicked: false,
            viewportWidth: 0,
            is_reg: false,
            swiper: {},
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
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    setup() {
        let wait = ref(false);
        let message = ref("");
        let noInfo = ref(false);
        const form = useForm({
            email: "",
            password: "",
            remember: false,
        });
        const new_account_input = reactive(
            useForm({
                email: "",
                name: "",
                password: "",
                ["password_confirmation"]: "",
            })
        );

        const submit = async () => {
            wait.value = true;
            form.post("/login", {
                onSuccess: (response) => {
                    wait.value = false;
                    setTimeout(() => {
                        document.querySelector("[data-close]").click();
                    }, 300);
                },
                onError: (errors) => {
                    // Обработка ошибок
                    console.log(errors);
                    wait.value = false;
                },
            });
        };
        const reverify = () => {
            wait.value = true;
            form.post("/reverify", {
                onFinish() {
                    wait.value = false;
                },
            });
        };
        const account_create = () => {
            wait.value = true;
            new_account_input.post("/register", {
                async onSuccess() {
                    wait.value = false;
                    setTimeout(() => {
                        document.querySelector("[data-close]").click();
                    }, 300);
                },
                onError(error) {
                    wait.value = false;
                },
            });
        };

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
            message,
            noInfo,
            reverify,
            wait,
        };
    },
    computed: {
        ...mapGetters(["getIncome", "allAccounts", "getActive"]),
        // errors() {
        //     let errs = this.$page.props.errors || {};
        //     errs = Object.values(errs).filter((el) => el !== "");
        //     return errs;
        // },
    },
    methods: {
        changeSlide(type) {
            this.is_reg = type;
        },
        closePopup() {
            document.querySelector("[data-close]").click();
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
        },
        slideNext() {
            this.swiper.allowSlideNext = true;
            this.$refs.next.click();
            this.swiper.allowSlideNext = false;
        },
        swiper_init(swiper) {
            this.swiper = swiper;
        },
        async email_validate() {
            let email = useForm({
                email: this.new_account_input.email,
            });
            // сохраняем контекст
            let self = this;
            this.wait = true;

            setTimeout(() => (this.wait = false), 1000);
            // eslint-disable-next-line no-undef
            await email.post(route("user_get"), {
                onSuccess() {
                    self.slideNext();
                },
            });
        },
        name_validate(get_group) {
            this.wait = true;
            const instance = axios.create({
                baseURL: "https://pool.api.btc.com/v1",
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                },
            });
            let validate = true;

            let obj = useForm({
                name: this.$refs.name.value,
            });
            obj.post(route("get_name"), {
                onSuccess() {
                    get_group(instance, validate);
                },
            });
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
                                let obj = useForm({
                                    name: "done",
                                });
                                obj.post(route("get_name"));
                                validate = false;
                            } else if (
                                i === resp.data.data.list.length - 1 &&
                                validate === true
                            ) {
                                this.slideNext();
                            }
                        } else if (
                            i === resp.data.data.list.length - 1 &&
                            validate === true
                        ) {
                            this.slideNext();
                        }
                    });
                    this.wait = false;
                })
                .catch(() => {
                    this.wait = false;
                });
        },
        password_validate(account_create) {
            account_create();
            // if (
            //     this.$refs["password-confirm"].value ===
            //         this.$refs.password.value &&
            //     this.$refs.password.value !== ""
            // ) {
            //     if (this.$refs.password.value.length > 6) {
            //         document.querySelector(".no-info").style.display = "flex";
            //
            //         account_create();
            //         // this.closePopup();
            //     } else {
            //         this.errors.password =
            //             "Пароль должен содержать больше 6 символов";
            //     }
            // } else {
            //     this.errors.password = "Необходимо подтвердить пароль";
            // }
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
//.header-fix {
//    @media (min-width: 1271px) {
//        nav.nav__container {
//            position: fixed;
//            transform: translateX(-50%) translateY(-120%);
//            z-index: 100;
//        }
//    }
//}

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
    padding: 2px 40px;
}

.nav__logo {
    max-width: 170px;
    @media (max-width: 767.98px) {
        &.headder {
            position: relative;
            z-index: 100;
        }
        max-width: 120px;
    }
}

nav.nav__container {
    z-index: 100;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 115px;
    width: 100%;
    box-sizing: border-box !important;
    padding: 21px 0;
    position: fixed;
    top: 0;
    left: 50%;
    transform: translateX(-50%) translateY(0);
    &:before {
        transition: all 0.3s ease 0s;
        left: 50%;
        content: "";
        transform: translateX(-50%);
        top: 0;
        width: 100vw;
        height: 84px;
        z-index: -1;
        position: fixed;
        background: #eef1f5;
        box-shadow: 0px 8px 24px rgba(129, 135, 189, 0.15);
    }
    @media (min-width: 1271px) {
        transition: all 0.3s ease 0s;
        width: 100vw;
        z-index: 100;
        //&.fixed {
        //    transform: translateX(-50%) translateY(0);
        //
        //    &:before {
        //        transform: translateX(-50%) translateY(0);
        //    }
        //}
    }
    @media (max-width: 1270px) {
        padding: 21px 0;
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
        background: transparent;
        border-radius: 5px;
        width: 24px;
        height: 24px;
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
            height: 2px;
            flex: 0 0 2px;
            background-color: #4182ec;
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
                    background-color: #4182ec;
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
        min-width: 60px;
        width: 60px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        white-space: nowrap;
        transition: all 0.3s ease 0s;
        &:hover {
            background: rgba(194, 213, 242);
        }
    }
    &_link {
        padding: 0 20px;
        width: 100%;
        height: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
}
.button {
    max-width: 160px;
}
</style>
