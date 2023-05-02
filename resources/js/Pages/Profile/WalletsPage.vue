<template>
    <div class="wallets" ref="page">
        <div class="wallets__container">
            <main-title tag="h2" titleName="Мои кошельки">
                <!--                <blue-button class="wallets__button wallets__button-history">-->
                <!--                    <Link :href="route('income')"> Доходы </Link>-->
                <!--                </blue-button>-->
                <span class="wallets__button" data-popup="#addWallet">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="21"
                        height="21"
                        viewBox="0 0 21 21"
                        fill="none"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M1.07129 10.0703C1.07129 9.51803 1.519 9.07031 2.07129 9.07031H18.0713C18.6236 9.07031 19.0713 9.51803 19.0713 10.0703C19.0713 10.6226 18.6236 11.0703 18.0713 11.0703H2.07129C1.519 11.0703 1.07129 10.6226 1.07129 10.0703Z"
                        />
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M10.0708 1.0708C10.6231 1.0708 11.0708 1.51852 11.0708 2.0708V18.0708C11.0708 18.6231 10.6231 19.0708 10.0708 19.0708C9.51852 19.0708 9.0708 18.6231 9.0708 18.0708V2.0708C9.0708 1.51852 9.51852 1.0708 10.0708 1.0708Z"
                        />
                    </svg>
                </span>
            </main-title>
            <div ref="wallets" class="wallets__wrap">
                <h3 class="wallets__title">
                    Список кошельков
                    <main-checkbox
                        class="wallets__filter"
                        @is_checked="this.checkboxer"
                    >
                        Скрыть с нулевым балансом
                    </main-checkbox>
                </h3>
                <no-info
                    ref="noInfo"
                    :wait="this.getWallet"
                    :empty="this.wallets"
                ></no-info>
                <div ref="list" class="wallets__list" v-show="this.wallets">
                    <div
                        class="wallets__block wallets__block-wallet"
                        v-for="(wallet, i) in this.wallets"
                        :key="i"
                        v-scroll="'top'"
                    >
                        <div class="wallets__block_name">
                            <!--                            <img-->
                            <!--                                :src="-->
                            <!--                                    'http://127.0.0.1:5173' +-->
                            <!--                                    `/resources/assets/img/${wallet.img}`-->
                            <!--                                "-->
                            <!--                            />-->
                            <span v-if="wallet.fullName === ''">{{
                                wallet.wallet
                            }}</span>
                            <span
                                v-else
                                v-tooltip="{ message: wallet.fullName }"
                                >{{ wallet.name }}</span
                            >
                            <div class="wallets__block_doths">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div class="wallets__block_doths_menu menu">
                                    <!--                                    <span class="menu_elem">-->
                                    <!--                                        <svg-->
                                    <!--                                            width="24"-->
                                    <!--                                            height="25"-->
                                    <!--                                            viewBox="0 0 24 25"-->
                                    <!--                                            fill="none"-->
                                    <!--                                            xmlns="http://www.w3.org/2000/svg"-->
                                    <!--                                        >-->
                                    <!--                                            <path-->
                                    <!--                                                d="M7.75778 11.2578C8.35113 11.2578 8.93115 11.0818 9.4245 10.7522C9.91784 10.4225 10.3024 9.95401 10.5294 9.40583C10.7565 8.85766 10.8159 8.25446 10.7001 7.67251C10.5844 7.09057 10.2987 6.55602 9.87911 6.13646C9.45955 5.71691 8.925 5.43118 8.34306 5.31543C7.76111 5.19967 7.15791 5.25908 6.60973 5.48615C6.06156 5.71321 5.59302 6.09773 5.26338 6.59107C4.93373 7.08442 4.75778 7.66444 4.75778 8.25778C4.75865 9.05317 5.075 9.81572 5.63742 10.3781C6.19984 10.9406 6.9624 11.2569 7.75778 11.2578ZM7.75778 7.25778C7.95557 7.25778 8.14891 7.31643 8.31335 7.42631C8.4778 7.5362 8.60598 7.69237 8.68166 7.8751C8.75735 8.05783 8.77715 8.25889 8.73857 8.45287C8.69998 8.64686 8.60474 8.82504 8.46489 8.96489C8.32504 9.10474 8.14686 9.19998 7.95287 9.23857C7.75889 9.27715 7.55783 9.25735 7.3751 9.18166C7.19237 9.10598 7.0362 8.9778 6.92632 8.81335C6.81643 8.6489 6.75778 8.45557 6.75778 8.25778C6.75796 7.99262 6.86338 7.73837 7.05087 7.55087C7.23837 7.36337 7.49262 7.25796 7.75778 7.25778ZM16.2422 13.7422C15.6488 13.7422 15.0688 13.9181 14.5755 14.2478C14.0821 14.5774 13.6976 15.0459 13.4705 15.5941C13.2435 16.1423 13.1841 16.7455 13.2998 17.3274C13.4156 17.9094 13.7013 18.4439 14.1208 18.8635C14.5404 19.283 15.075 19.5688 15.6569 19.6845C16.2388 19.8003 16.842 19.7409 17.3902 19.5138C17.9384 19.2867 18.4069 18.9022 18.7366 18.4089C19.0662 17.9155 19.2422 17.3355 19.2422 16.7422C19.2413 15.9468 18.9249 15.1842 18.3625 14.6218C17.8001 14.0594 17.0375 13.743 16.2422 13.7422ZM16.2422 17.7422C16.0444 17.7422 15.851 17.6835 15.6866 17.5736C15.5221 17.4638 15.394 17.3076 15.3183 17.1248C15.2426 16.9421 15.2228 16.7411 15.2614 16.5471C15.3 16.3531 15.3952 16.1749 15.5351 16.0351C15.6749 15.8952 15.8531 15.8 16.0471 15.7614C16.2411 15.7228 16.4421 15.7426 16.6248 15.8183C16.8076 15.894 16.9638 16.0221 17.0736 16.1866C17.1835 16.351 17.2422 16.5444 17.2422 16.7422C17.242 17.0073 17.1366 17.2616 16.9491 17.4491C16.7616 17.6366 16.5073 17.742 16.2422 17.7422ZM19.707 4.79297C19.6141 4.70009 19.5039 4.62641 19.3826 4.57614C19.2613 4.52587 19.1313 4.5 18.9999 4.5C18.8686 4.5 18.7386 4.52587 18.6173 4.57614C18.496 4.62641 18.3857 4.70009 18.2929 4.79297L4.29291 18.793C4.19911 18.8856 4.12455 18.9959 4.07353 19.1174C4.0225 19.239 3.99602 19.3695 3.99561 19.5013C3.9952 19.6331 4.02086 19.7638 4.07112 19.8856C4.12139 20.0075 4.19526 20.1182 4.28848 20.2115C4.38171 20.3047 4.49245 20.3786 4.61433 20.4288C4.73621 20.4791 4.86683 20.5047 4.99866 20.5043C5.1305 20.5039 5.26095 20.4774 5.38251 20.4264C5.50407 20.3753 5.61434 20.3008 5.70697 20.207L19.707 6.20697C19.7998 6.11414 19.8735 6.00393 19.9238 5.88262C19.974 5.76131 19.9999 5.63128 19.9999 5.49997C19.9999 5.36866 19.974 5.23864 19.9238 5.11733C19.8735 4.99602 19.7998 4.8858 19.707 4.79297Z"-->
                                    <!--                                                fill="#99ACD3"-->
                                    <!--                                            />-->
                                    <!--                                        </svg>-->
                                    <!--                                        <span class="menu_column">-->
                                    <!--                                            <span class="menu_title"-->
                                    <!--                                                >Процент вывода</span-->
                                    <!--                                            >-->
                                    <!--                                            <span class="menu_val"-->
                                    <!--                                                >{{ wallet.percent }} %</span-->
                                    <!--                                            >-->
                                    <!--                                        </span>-->
                                    <!--                                    </span>-->
                                    <!--                                    <span class="menu_elem">-->
                                    <!--                                        <svg-->
                                    <!--                                            width="24"-->
                                    <!--                                            height="24"-->
                                    <!--                                            viewBox="0 0 24 24"-->
                                    <!--                                            fill="none"-->
                                    <!--                                            xmlns="http://www.w3.org/2000/svg"-->
                                    <!--                                        >-->
                                    <!--                                            <path-->
                                    <!--                                                d="M12 6C11.7348 6 11.4804 6.10536 11.2929 6.29289C11.1054 6.48043 11 6.73478 11 7V17C11 17.2652 11.1054 17.5196 11.2929 17.7071C11.4804 17.8946 11.7348 18 12 18C12.2652 18 12.5196 17.8946 12.7071 17.7071C12.8946 17.5196 13 17.2652 13 17V7C13 6.73478 12.8946 6.48043 12.7071 6.29289C12.5196 6.10536 12.2652 6 12 6ZM7 12C6.73478 12 6.48043 12.1054 6.29289 12.2929C6.10536 12.4804 6 12.7348 6 13V17C6 17.2652 6.10536 17.5196 6.29289 17.7071C6.48043 17.8946 6.73478 18 7 18C7.26522 18 7.51957 17.8946 7.70711 17.7071C7.89464 17.5196 8 17.2652 8 17V13C8 12.7348 7.89464 12.4804 7.70711 12.2929C7.51957 12.1054 7.26522 12 7 12ZM17 10C16.7348 10 16.4804 10.1054 16.2929 10.2929C16.1054 10.4804 16 10.7348 16 11V17C16 17.2652 16.1054 17.5196 16.2929 17.7071C16.4804 17.8946 16.7348 18 17 18C17.2652 18 17.5196 17.8946 17.7071 17.7071C17.8946 17.5196 18 17.2652 18 17V11C18 10.7348 17.8946 10.4804 17.7071 10.2929C17.5196 10.1054 17.2652 10 17 10ZM19 2H5C4.20435 2 3.44129 2.31607 2.87868 2.87868C2.31607 3.44129 2 4.20435 2 5V19C2 19.7956 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 22 5 22H19C19.7956 22 20.5587 21.6839 21.1213 21.1213C21.6839 20.5587 22 19.7956 22 19V5C22 4.20435 21.6839 3.44129 21.1213 2.87868C20.5587 2.31607 19.7956 2 19 2ZM20 19C20 19.2652 19.8946 19.5196 19.7071 19.7071C19.5196 19.8946 19.2652 20 19 20H5C4.73478 20 4.48043 19.8946 4.29289 19.7071C4.10536 19.5196 4 19.2652 4 19V5C4 4.73478 4.10536 4.48043 4.29289 4.29289C4.48043 4.10536 4.73478 4 5 4H19C19.2652 4 19.5196 4.10536 19.7071 4.29289C19.8946 4.48043 20 4.73478 20 5V19Z"-->
                                    <!--                                                fill="#99ACD3"-->
                                    <!--                                            />-->
                                    <!--                                        </svg>-->
                                    <!--                                        <span class="menu_column">-->
                                    <!--                                            <span class="menu_title"-->
                                    <!--                                                >Минимальный вывод</span-->
                                    <!--                                            >-->
                                    <!--                                            <span class="menu_val"-->
                                    <!--                                                >{{-->
                                    <!--                                                    wallet.minWithdrawal-->
                                    <!--                                                }}-->
                                    <!--                                                BTC</span-->
                                    <!--                                            >-->
                                    <!--                                        </span>-->
                                    <!--                                    </span>-->
                                    <button
                                        @click="remove(wallet)"
                                        class="menu_elem menu_elem-remove"
                                    >
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <g clip-path="url(#clip0_1073_213)">
                                                <path
                                                    d="M4.51031 19.4951C4.62749 19.6058 4.76096 19.6806 4.9107 19.7197C5.06044 19.7588 5.21018 19.7588 5.35992 19.7197C5.50966 19.6806 5.63986 19.6058 5.75054 19.4951L12.0005 13.2451L18.2505 19.4951C18.3612 19.6058 18.4914 19.6806 18.6411 19.7197C18.7909 19.7588 18.9422 19.7604 19.0952 19.7246C19.2482 19.6888 19.3801 19.6123 19.4907 19.4951C19.6015 19.3844 19.6747 19.2542 19.7105 19.1045C19.7463 18.9548 19.7463 18.805 19.7105 18.6553C19.6747 18.5056 19.6015 18.3753 19.4907 18.2646L13.2408 12.0049L19.4907 5.75487C19.6015 5.64419 19.6764 5.51398 19.7154 5.36425C19.7545 5.2145 19.7545 5.06476 19.7154 4.91502C19.6764 4.76528 19.6015 4.63508 19.4907 4.5244C19.3736 4.40721 19.2402 4.33071 19.0904 4.29491C18.9406 4.2591 18.7909 4.2591 18.6411 4.29491C18.4914 4.33071 18.3612 4.40721 18.2505 4.5244L12.0005 10.7744L5.75054 4.5244C5.63986 4.40721 5.50803 4.33071 5.35504 4.29491C5.20204 4.2591 5.05067 4.2591 4.90093 4.29491C4.75119 4.33071 4.62098 4.40721 4.51031 4.5244C4.39963 4.63508 4.32639 4.76528 4.29058 4.91502C4.25477 5.06476 4.25477 5.2145 4.29058 5.36425C4.32639 5.51398 4.39963 5.64419 4.51031 5.75487L10.7603 12.0049L4.51031 18.2646C4.39963 18.3753 4.32476 18.5056 4.2857 18.6553C4.24664 18.805 4.24501 18.9548 4.28081 19.1045C4.31662 19.2542 4.39312 19.3844 4.51031 19.4951Z"
                                                    fill="#FF3B30"
                                                />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1073_213">
                                                    <rect
                                                        width="15.4896"
                                                        height="15.5006"
                                                        fill="white"
                                                        transform="translate(4.25513 4.24969)"
                                                    />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        Удалить
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="wallets__block_value">
                            <span>{{ wallet.value }}</span>
                            {{ wallet.shortName }}
                        </div>
                        <div class="wallets__block_convert">
                            ≈
                            <span>{{
                                (wallet.value * dollar).toFixed(2)
                            }}</span>
                            $ ≈
                            <span>{{
                                ((wallet.value * dollar) / ruble).toFixed(2)
                            }}</span>
                            ₽
                        </div>
                        <div
                            class="wallets__block_i"
                            v-tooltip="{
                                message: `Процент вывода: ${wallet.percent}%.\n\n Мин сумма вывода: ${wallet.minWithdrawal}BTC)`,
                            }"
                        >
                            <svg
                                width="3"
                                height="10"
                                viewBox="0 0 3 10"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M0.861318 3.95998C0.867851 3.44565 1.26175 3.18848 1.75002 3.18848C2.25129 3.18848 2.63539 3.44565 2.64844 3.95998L2.64844 9.12598C2.65494 9.37338 2.5752 9.57845 2.40922 9.74121C2.24315 9.90397 2.02665 9.98535 1.75972 9.98535C1.49932 9.98535 1.28285 9.90234 1.11032 9.73633C0.937785 9.57031 0.854784 9.3636 0.861318 9.11621L0.861318 3.95998Z"
                                    fill="#969797"
                                />
                                <path
                                    d="M1.01272 0.307582C1.22432 0.112315 1.47009 0.0146817 1.75002 0.0146817C2.03649 0.0146817 2.28389 0.113949 2.49222 0.312482C2.70053 0.511082 2.80469 0.750349 2.80469 1.03028C2.80469 1.31021 2.70053 1.54948 2.49222 1.74808C2.28389 1.94661 2.03649 2.04588 1.75002 2.04588C1.46355 2.04588 1.21615 1.94825 1.00782 1.75298C0.799486 1.55765 0.695319 1.31675 0.695319 1.03028C0.695319 0.743815 0.801119 0.502915 1.01272 0.307582Z"
                                    fill="#969797"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hint">
        <div class="hint_item" v-hide="this.mess !== ''">
            {{ this.mess }}
        </div>
    </div>
    <popup-view id="addWallet">
        <div
            v-for="(error, i) in this.err"
            :key="i"
            class="form_wrapper-message"
        >
            <div class="form_message" v-if="error">
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
                {{ error[0] }}
            </div>
        </div>
        <form
            @submit.prevent="this.addWallet"
            class="form form-popup popup__form"
        >
            <main-title tag="h3" title-name="Добавьте кошелек" />
            <input
                v-model="form.wallet"
                required
                autofocus
                type="text"
                class="input popup__input"
                placeholder="Введите кошелек"
            />
            <input
                v-model="form.name"
                autofocus
                type="text"
                class="input popup__input"
                placeholder="Введите имя"
            />
            <div class="form_row">
                <div class="form_column">
                    <label for="percent" class="main__label">Процент</label>
                    <input
                        name="percent"
                        @input="handleInputChange"
                        v-model="form.percent"
                        id="percent"
                        autofocus
                        type="text"
                        class="input popup__input"
                        placeholder="100%"
                    />
                </div>
                <div class="form_column">
                    <label for="min" class="main__label">Мин. вывод</label>
                    <input
                        name="minWithdrawal"
                        @input="handleInputChange"
                        v-model="form.minWithdrawal"
                        id="min"
                        autofocus
                        type="text"
                        class="input popup__input"
                        placeholder="0.005"
                    />
                </div>
            </div>
            <blue-button>
                <button type="submit" class="all-link">+ Добавить</button>
            </blue-button>
        </form>
    </popup-view>
</template>
<script>
import axios from "axios";
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import MainCheckbox from "@/Components/UI/MainCheckbox.vue";
import NoInfo from "@/Components/technical/NoInfo.vue";
import { mapGetters } from "vuex";
import Vue from "lodash";
import { Link } from "@inertiajs/vue3";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import PopupView from "@/Components/technical/PopupView.vue";

export default {
    components: {
        PopupView,
        MainCheckbox,
        BlueButton,
        MainTitle,
        Link,
        NoInfo,
    },
    layout: profileLayoutView,
    computed: {
        ...mapGetters([
            "getIncome",
            "allAccounts",
            "allHistoryForDays",
            "getActive",
            "getWallet",
        ]),
        wallets() {
            let arr = [];
            if (
                this.getWallet[this.getActive] &&
                Object.values(this.getWallet[this.getActive]).length > 0
            ) {
                if (this.isChecked) {
                    Object.values(this.getWallet[this.getActive]).forEach(
                        (wal, i) => {
                            let val = 0;
                            if (wal) {
                                if (wal.payment) {
                                    val = wal.payment;
                                }
                                if (val > 0) {
                                    let name = wal.wallet;
                                    if (wal.name) {
                                        name = wal.name;
                                    }
                                    let fullName = "";
                                    if (name.length > 6) {
                                        fullName = name;
                                        name = name.substr(0, 6) + "...";
                                    }
                                    let walletModel = {
                                        img: "bitcoin_img.png",
                                        name: name,
                                        wallet: wal.wallet,
                                        fullName: fullName,
                                        shortName: "BTC",
                                        value: val.toFixed(8),
                                        dollarValue: 0,
                                        rubleValue: 0,
                                        percent: wal.percent,
                                    };
                                    Vue.set(arr, i, walletModel);
                                }
                            }
                        }
                    );
                } else {
                    Object.values(this.getWallet[this.getActive]).forEach(
                        (wal, i) => {
                            let val = 0;
                            if (wal) {
                                if (wal.payment) {
                                    val = wal.payment;
                                }
                                let name = wal.wallet;
                                if (wal.name) {
                                    name = wal.name;
                                }
                                let fullName = "";
                                if (name.length > 6) {
                                    fullName = name;
                                    name = name.substr(0, 6) + "...";
                                }
                                let walletModel = {
                                    img: "bitcoin_img.png",
                                    name: name,
                                    wallet: wal.wallet,
                                    fullName: fullName,
                                    shortName: "BTC",
                                    value: val.toFixed(8),
                                    dollarValue: 0,
                                    rubleValue: 0,
                                    percent: wal.percent,
                                    minWithdrawal: wal.minWithdrawal,
                                };
                                Vue.set(arr, i, walletModel);
                            }
                        }
                    );
                }
            }
            return arr;
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
        axios
            .get("https://api.minerstat.com/v2/coins?list=BTC,BCH,BSV")
            .then((response) => (this.dollar = response.data[0].price));
        setTimeout(() => {
            axios
                .get("https://www.cbr-xml-daily.ru/latest.js")
                .then((response) => (this.ruble = response.data.rates.USD));
        }, 100);
    },
    data() {
        return {
            miningCash: 0,
            isChecked: false,
            viewportWidth: 0,
            ruble: 0,
            dollar: 0,
            err: {},
            mess: "",
            form: {
                name: "",
                wallet: "",
                percent: 100,
                minWithdrawal: 0.005,
            },
        };
    },
    methods: {
        remove(wallet) {
            wallet.group_id = this.getActive;
            axios
                .post("/wallet_delete", wallet)
                .then((res) => {
                    this.mess = res.data.message;
                    this.$store.dispatch("getWallets", wallet);
                })
                .catch((err) => (this.mess = err.response.data.message));
            setTimeout(() => (this.mess = ""), 3000);
        },
        removeLetters(input) {
            const letterRegExp = /[a-zA-Z]/g;
            let fin = input.replace(letterRegExp, "");
            if (fin[0] === "0" && fin[1] !== "." && fin[1] !== undefined) {
                fin = "0.";
            }
            return fin;
        },
        handleInputChange(event) {
            const { name, value } = event.target;
            this.form[name] = this.removeLetters(value);
        },
        addWallet() {
            if (this.wallets && this.getActive !== -1) {
                let per = 0;
                this.wallets.forEach((wal) => {
                    per = per + wal["percent"];
                });
                let obj = this.form;
                per = per + Number(obj.percent);
                obj.group_id = this.getActive;
                per > 100
                    ? (this.err.message = [
                          "Процент с ваших кошельков больше 100.",
                      ])
                    : obj.minWithdrawal === "0"
                    ? (this.err.message = ["Вывод должен быть больше 0.005."])
                    : axios
                          .post("/wallet_create", this.form)
                          .then((res) => {
                              let group = this.allAccounts[this.getActive];
                              group.group_id =
                                  this.allAccounts[this.getActive].id;
                              this.$store.dispatch("getWallets", group);
                              document.querySelector("[data-close]").click();
                          })
                          .catch((err) => {
                              if (err.response) {
                                  this.err = {};
                                  this.err = err.response.data.errors;
                              }
                          });
            } else {
                this.err = {};
                this.err = { 0: ["Попробуйте через 5 секунд"] };
            }
        },
        checkboxer(is_checked) {
            this.isChecked = is_checked;
            // setTimeout(() => {
            //     if (this.$refs.list) {
            //         if (this.viewportWidth > 768) {
            //             setTimeout(() => {
            //                 this.$refs.wallets.style.height =
            //                     48 + 46 + this.$refs.list.offsetHeight + "px";
            //             }, 1);
            //         } else {
            //             setTimeout(() => {
            //                 this.$refs.wallets.style.height =
            //                     40 + 132 + this.$refs.list.offsetHeight + "px";
            //             }, 1);
            //         }
            //     } else {
            //         if (this.viewportWidth > 768) {
            //             setTimeout(() => {
            //                 this.$refs.wallets.style.height =
            //                     48 + 46 + this.$refs.noInfo.offsetHeight + "px";
            //             }, 1);
            //         } else {
            //             setTimeout(() => {
            //                 this.$refs.wallets.style.height =
            //                     40 +
            //                     132 +
            //                     this.$refs.noInfo.offsetHeight +
            //                     "px";
            //             }, 1);
            //         }
            //     }
            // }, 100);
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    mounted() {
        document.title = "Кошельки";
        this.$refs.page.style.opacity = 1;
    },
    props: ["errors", "message", "user", "auth_user"],
};
</script>
<style lang="scss">
.wallets {
    width: 100%;
    transition: all 0.3s linear 0.2s;
    opacity: 0;
    @media (max-width: 1271.98px) {
        transition: all 0.3s ease 0s;
    }
    &__title {
        font-family: AmpleSoftPro, serif;
        font-style: normal;
        color: #000;
        margin: 0 0 16px;
        font-weight: 700;
        font-size: 24px;
        line-height: 30px;
        width: 100%;
        display: inline-flex;
        justify-content: space-between;
        @media (max-width: 479.89px) {
            font-size: 21px;
            line-height: 26px;
        }
        @media (max-width: 767.98px) {
            position: relative;
            margin-bottom: 90px !important;
            flex-direction: column;
            &:after {
                content: "";
                height: 1px;
                position: absolute;
                bottom: -20px;
                left: 0;
                width: 100%;
                background-color: #d7d8d9;
            }
        }
    }

    // .wallets__filter
    &__filter {
        line-height: 23px;
        font-size: 16px;
        color: #99acd3;
        @media (max-width: 767.98px) {
            position: absolute;
            left: 0;
            bottom: calc(-40px - 100%);
        }
        @media (max-width: 479.98px) {
            width: 100%;
        }
    }

    .title {
        margin: 0 0 24px;
        @media (min-width: 1271.98px) {
            padding-left: 70px;
        }
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: space-between;
    }

    &__list {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        transition: all 0.3s ease 0s;
        @media (max-width: 991.98px) {
            grid-template-columns: repeat(3, 1fr);
        }
        @media (max-width: 767.98px) {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            .wallets__block {
                border-radius: 12px;
                border: none;
            }
        }
        @media (max-width: 479.98px) {
            grid-template-columns: repeat(1, 1fr);
        }
    }

    // .wallets__block
    &__block {
        padding: 16px;
        background-color: #fff;
        border-radius: 13px;
        width: 100%;

        &-wallet {
            width: 100%;
            padding: 12px 0;
            transition: all 0.5s ease;
            @media (max-width: 767.98px) {
                padding: 14px 0;
            }

            &.top {
                &-before-enter {
                    opacity: 0;
                }

                &-enter {
                    opacity: 1;
                }
            }
        }

        &_name {
            width: 100%;
            display: inline-flex;
            align-items: center;
            padding: 0 16px 16px;
            border-bottom: 1px solid #e8ecf2;
            @media (max-width: 767.98px) {
                padding: 0 10px 10px;
            }

            img {
                margin-right: 16px;
                width: 24px;
                height: 24px;
                border-radius: 50%;
                @media (max-width: 767.98px) {
                    margin-right: 6px;
                }
            }

            span {
                font-weight: 500;
                font-size: 18px;
                line-height: 26px;
                color: #000000;
                @media (max-width: 991.98px) {
                    font-size: 16px;
                    line-height: 23px;
                }
            }
        }

        &_i {
            position: absolute;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            right: 12px;
            bottom: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #eff2f7;
            cursor: pointer;
            svg {
                width: 4px;
                height: 12px;
            }
        }

        &_doths {
            margin-left: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 23.5px;
            gap: 3px;
            cursor: pointer;
            position: relative;
            @media (max-width: 767.98px) {
                width: 20px;
                gap: 2.5px;
            }
            &_menu {
                cursor: default;
                position: absolute;
                visibility: hidden;
                right: -16px;
                min-width: 255px;
                background: #ffffff !important;
                top: calc(100% + 13px);
                overflow: hidden;
                opacity: 0;
                height: fit-content !important;
                display: flex;
                flex-direction: column;
                align-items: center;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                border-radius: 20px !important;
                width: fit-content;
                @media (max-width: 991.98px) {
                    right: 0;
                    left: auto;
                    top: 0;
                }
                .menu {
                    &_elem {
                        &-remove {
                            color: #ff3b30;
                        }
                        svg {
                            width: 24px;
                            height: 24px;
                        }
                        font-weight: 400;
                        font-size: 17px;
                        line-height: 143.1%;
                        color: #000034;
                        display: flex;
                        height: 48px;
                        gap: 12px;
                        padding: 12px;
                        align-items: center;
                        width: 100%;
                        background: transparent;
                        transition: all 0.3s ease 0s;
                        &:not(:first-child) {
                            border-top: 1px solid rgba(214, 214, 214, 0.3);
                        }
                        &:hover {
                            background: #f6f8fa;
                        }
                    }
                    &_column {
                        display: flex;
                        flex-direction: column;
                        span {
                            width: 100%;
                        }
                    }
                    &_title {
                        font-weight: 400;
                        font-size: 16px;
                        line-height: 143.1%;
                        color: rgba(0, 0, 0, 0.62);
                    }
                    &_val {
                        font-weight: 500;
                        font-size: 18px;
                        line-height: 143.1%;
                        color: #000034;
                    }
                }
            }

            &:hover {
                div {
                    background-color: #3f7bdd;
                }
                .wallets__block_doths_menu {
                    width: 100% !important;
                    opacity: 1;
                    visibility: visible;
                }
            }

            div {
                width: 4px;
                height: 4px;
                border-radius: 50%;
                background-color: rgba(0, 0, 0, 0.62);
                transition: all 0.3s ease;
            }
        }

        &_value {
            padding: 16px 16px 0;
            margin-bottom: 8px;
            font-weight: 400;
            font-size: 20px;
            line-height: 28px;
            color: #0000009e;
            width: 100%;
            @media (max-width: 767.98px) {
                padding: 10px 10px 0;
                font-weight: 500;
                font-size: 16px;
                line-height: 23px;
                color: #000034;
                margin-bottom: 0;
                span {
                    font-weight: 500;
                }
            }

            span {
                font-weight: 700;
                color: #000034;
            }
        }

        &_convert {
            padding: 0 16px;
            font-weight: 400;
            font-size: 16px;
            line-height: 23px;
            color: rgba(0, 0, 0, 0.62);
            @media (max-width: 767.98px) {
                color: #000034;
            }
        }

        .wallets__subtitle {
            font-weight: 400;
            font-size: 16px;
            line-height: 23px;
        }
    }

    // .wallets__button
    &__button {
        //color: #68809d !important;
        //background: #fff !important;
        //min-width: 179px;
        //box-shadow: none;
        //transform: translate(0, 0);
        //max-height: 51px;
        //gap: 10px;
        //@media (max-width: 991.98px) {
        //    min-width: 160px;
        //    height: 38px;
        //}
        //@media (max-width: 767.98px) {
        //    font-size: 18px !important;
        //    line-height: 22px !important;
        //    width: 100% !important;
        //    min-width: 120px;
        //    &:before {
        //        content: none;
        //    }
        //}
        //@media (max-width: 479.98px) {
        //    flex-direction: column;
        //    gap: 6px;
        //    min-height: 54px;
        //    min-width: 0;
        //    font-size: 12px !important;
        //    line-height: 14px !important;
        //    padding: 0;
        //}
        //
        //&:first-child {
        //    margin-left: 0;
        //}
        //
        //svg {
        //    stroke: #68809d;
        //    transition: all 0.3s ease;
        //    @media (max-width: 767.98px) {
        //        width: 20px;
        //        height: 20px;
        //        stroke: #68809d;
        //        margin-right: 6px;
        //    }
        //    @media (max-width: 479.98px) {
        //        margin: 0;
        //    }
        //}
        //
        //&::before {
        //    z-index: -1;
        //    content: "";
        //    position: absolute;
        //    background: transparent;
        //    border-radius: 10px;
        //    width: 100%;
        //    height: 100%;
        //    top: 0;
        //    left: 0;
        //    transition: all 0.3s ease 0s;
        //    @media (max-width: 767.98px) {
        //        background: #fff;
        //    }
        //}
        //
        //@media (any-hover: hover) {
        //    &:hover {
        //        background-color: #4182ec !important;
        //        color: #fff !important;
        //
        //        &:before {
        //            background: linear-gradient(
        //                84.14deg,
        //                rgba(63, 123, 221, 0.27) 8.75%,
        //                rgba(66, 130, 236, 0.27) 92.01%
        //            );
        //        }
        //
        //        svg {
        //            stroke: #fff;
        //        }
        //    }
        //}
        // .wallets__button-history
        //&-history {
        //    min-height: 51px;
        //    color: #fff;
        //    background-color: #4182ec;
        //    min-width: 210px;
        //    padding: 0;
        //
        //    &:before {
        //        background: linear-gradient(
        //            84.14deg,
        //            rgba(63, 123, 221, 0.27) 8.75%,
        //            rgba(66, 130, 236, 0.27) 92.01%
        //        );
        //    }
        //
        //    a {
        //        width: 100%;
        //        height: 100%;
        //        display: inline-flex;
        //        align-items: center;
        //        justify-content: center;
        //    }
        //
        //    @media (min-width: 767.98px) {
        //        font-size: 20px;
        //        line-height: 28px;
        //    }
        //    @media (max-width: 767.98px) {
        //        width: auto;
        //        min-height: 48px;
        //        min-width: 150px;
        //        &:before {
        //            content: none;
        //        }
        //    }
        //    @media (max-width: 479.98px) {
        //        min-height: 28px;
        //        height: auto;
        //        font-size: 14px;
        //        line-height: 20px;
        //        min-width: 90px;
        //    }
        //}&__button {
        width: 60px;
        height: 44px;
        border-radius: 13px;
        background-color: #4182ec;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        &::before {
            content: "";
            position: absolute;
            z-index: -1;
            background: linear-gradient(
                84.14deg,
                rgba(63, 123, 221, 0.27) 8.75%,
                rgba(66, 130, 236, 0.27) 92.01%
            );
            border-radius: 10px;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            transition: all 0.3s ease 0s;
        }
        @media (any-hover: hover) {
            &:hover {
                transform: translate(-4px, -4px);
                &::before {
                    top: 4px;
                    left: 4px;
                }
            }
        }
        &:active {
            @media (min-width: 479.89px) {
                transform: translate(0, 0);
                box-shadow: inset 0 4px 4px rgba(0, 0, 0, 0.25);
                &::before {
                    top: 0;
                    left: 0;
                }
            }
        }
        svg {
            width: 14px;
            height: 14px;
            fill: #fff;
        }
        @media (max-width: 479.89px) {
            background-color: transparent;
            width: 20px;
            height: 20px;

            svg {
                fill: #4182ec;
                width: 18px;
                height: 18px;
            }
        }
    }

    // .wallets__wrap
    &__wrap {
        margin-bottom: 40px;
        background: rgba(255, 255, 255, 0.29);
        border-radius: 21px;
        width: 100%;
        padding: 24px 16px;
        @media (max-width: 1270px) {
            padding: 20px;
        }
        @media (max-width: 767.98px) {
            margin: 0 -15px 20px;
            width: calc(100% + 30px);
        }
        @media (max-width: 479.98px) {
            margin: 0 -20px 20px;
            width: calc(100% + 40px);
        }

        &:last-child {
            margin-bottom: 0;
            transition: all 0.3s ease;
        }
    }

    // .wallets__row
    &__row {
        width: 100%;
        display: flex;
        gap: 16px;
        @media (max-width: 767.98px) {
            flex-direction: column;
            gap: 0;
            background-color: #fff;
            border: 0.5px solid rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            padding: 4px 10px;
        }
        @media (max-width: 767.98px) {
            .wallets__block {
                padding: 10px 0 10px;
                border-top: 1px solid #d7d8d9;
                border-radius: 0;

                &:last-child {
                    padding: 10px 0 0;
                }

                &:first-child {
                    border-top: none;
                    padding: 0 0 10px;
                }
            }
        }
        // .wallets__row-balance
        &-balance {
            gap: 0;
            justify-content: space-between;
            margin-bottom: 16px;
            h3 {
                margin-bottom: 0;
                @media (max-width: 767.98px) {
                    margin-bottom: 30px !important;
                }
            }
            @media (max-width: 767.98px) {
                background-color: transparent;
                padding: 0;
                border: none;
                .wallets__column {
                    gap: 0;
                    background-color: #fff;
                    border: 0.5px solid rgba(0, 0, 0, 0.08);
                    border-radius: 8px;
                    padding: 10px 10px;
                    margin-bottom: 10px;
                    flex-direction: row;
                    align-items: center;
                    justify-content: center;
                }
            }
            @media (max-width: 479.98px) {
                .wallets__column {
                    padding: 4px 10px;
                    flex-direction: column;
                    align-items: flex-start;
                }
            }
        }
    }

    // .wallets__column
    &__column {
        display: flex;
        flex-direction: column;
        @media (max-width: 767.98px) {
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
        @media (max-width: 479.98px) {
            gap: 0;
            flex-direction: column;
            align-items: flex-start;
        }
    }

    // .wallets__subtitle
    &__subtitle {
        font-weight: 500;
        font-size: 18px;
        line-height: 26px;
        color: rgba(0, 0, 0, 0.62);
        margin-bottom: 8px;
        @media (max-width: 767.98px) {
            margin-bottom: 0;
            font-size: 14px;
            line-height: 20px;
            font-weight: 400;
        }
    }

    // .wallets__value
    &__value {
        color: #000034;
        font-weight: 500;
        font-size: 24px;
        line-height: 34px;
        @media (max-width: 767.98px) {
            margin-left: 5px;
            font-size: 21px;
            line-height: 30px;
        }
        @media (max-width: 479.98px) {
            margin-left: 0;
        }

        span {
            font-weight: 700;
        }
    }

    // .wallets__buttons
    &__buttons {
        display: flex;
        gap: 16px;
        @media (max-width: 767.98px) {
            width: 100%;
            justify-content: space-between;
            gap: 11px;
        }
    }
}
</style>
