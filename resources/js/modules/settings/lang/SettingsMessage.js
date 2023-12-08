export const SettingsMessage = {
    en: {
        error: {
            'password-confirmation': 'Your passwords don`t match '
        },
        title: ["Personal Information", "Safety", "Account"],
        labels: {
            login: "Login",
            email: "Email",
            password: "Password",
            phone: "Phone",
        },
        inputs: {
            phone: "Add Number",
            password: "password",
            old_password: "Enter old password",
        },
        cards: {
            profit: {
                title: "Net Profit Calculation",
                text: "Specify the monthly electricity costs in dollars for calculating net profit",
                button: "Change",
            },
            referral: {
                title: "Activate Referral Code",
                placeholder: "Enter Referral Code",
                button: "Activate",
            },
        },
        popup: {
            title: "Set new",
            title_email: "Change",
            placeholders: {
                placeholder: "Enter",
                password_new: "Enter New",
                password_confirmation: "Confirm",
            },
            text: [
                "Indicate your existing email, we will send a confirmation code to it",
                "Sent the code by email",
                "An SMS with a confirmation code will be sent to the specified number.",
                "Sent a code to the number",
                "Link your account to Google Authenticator using a QR code or setup key",
                "To confirm enter the temporary code from the Google Authenticator app",
                "Resend code",
                "To confirm, enter the temporary confirmation code from the Google Authenticator app."
            ],
            button: ["Back", "Change", "Send code"],
        },
        button: "Change",
        button_verify: "Verify email",
        safety: {
            title: [
                "Two-Factor Authentication",
                "Login via SMS",
                "Change password",
            ],
            text: [
                "This is a security mechanism used to protect your profile by linking your login to a physical device.",
                "Receive an SMS with a code to confirm your account login on your mobile phone.",
                "To change your password, you need to remember the current one.",
            ],
            button: ["Connect", "Change", "Disconnect"],
        },
        fac_popup: {
            title: "2FA connection",
            button: ["Continue", "Back", "Connect"],
            label: ["Settings key", "Confirmation code"],
            disable: {
                title: "Disable 2FA",
                text: "To disable, enter a temporary code from the Google Authenticator app",
                placeholder: "6-digit confirmation code",
                button: "Disable"
            },
            warning: {
                title:'Important!/Save this setup key. You will need it if you lose your device with the Google Authenticator application.',
            }
        },
        password_popup: {
            title: "Change Password",
            description: "To change the password you need to remember the current one",
            'description-two': "Enter a new password for your account",
            placeholders: {
                current_password: "Current Password",
                new_password: "New Password",
                confirm_password: "Confirm New Password",
            },
            button: "Change",
        },
    },
    ru: {
        error: {
            'password-confirmation': 'Ваши пароли не совпадают'
        },
        title: ["Персональные данные", "Безопасность", "Аккаунт"],
        labels: {
            login: "Логин",
            email: "Почту",
            password: "Пароль",
            phone: "Телефон",
        },
        inputs: {
            phone: "Добавьте номер",
            password: "пароль",
            old_password: "Введите старый пароль",
        },
        cards: {
            profit: {
                title: "Расчет чистой прибыли",
                text: "Укажите расходы на электроэнергию за месяц в долларах для расчета чистой прибыли",
                button: "Изменить",
            },
            referral: {
                title: "Активировать реферальный код",
                placeholder: "Укажите реферальный код",
                button: "Активировать",
            },
        },
        popup: {
            title: "Сменить",
            title_email: "Сменить",
            placeholders: {
                placeholder: "Введите",
                password_new: "Введите новый",
                password_confirmation: "Подтвердите",
            },
            text: [
                "Укажите существующую почту, на нее мы отправим код подтверждения",
                "Отправили код на почту",
                "На указанный номер поступит SMS с кодом подтверждения",
                "Отправили код на номер",
                "Привяжите аккаунт к Google Authenticator с помощью QR-кода или ключа настройки",
                "Для подтверждения введите временный код из приложения Google Authenticator",
                "Отправить код повторно",
                "Для подтверждения введите временный код подтверждения из приложения Google Authenticator"
            ],
            button: ["Назад", "Изменить", "Отправить код"],
        },
        button: "Изменить",
        button_verify: "Подтвердите почту",
        safety: {
            title: [
                "Двухфакторная аутентификация",
                "Вход по SMS",
                "Изменить пароль",
            ],
            text: [
                "Это механизм безопасности, используемый для защиты вашего профиля путем привязки вашего входа к физическому устройству.",
                "Получай SMS с кодом для подтверждения входа в аккаунт на свой мобильный телефон.",
                "Чтобы изменить пароль, вам необходимо помнить текущий.",
            ],
            button: ["Подключить", "Изменить", "Отключить"],
        },
        fac_popup: {
            title: "Подключение 2FA",
            button: ["Продолжить", "Назад", "Подключить"],
            label: ["Ключ настройки", "Код подтверждения"],
            disable: {
                title: "Отключить 2FA",
                text: "Для отключения введите временный код из приложения Google Authenticator",
                placeholder: "6-знычный код подтверждения",
                button: "Отключить",
            },
            warning: {
                title:'Важно!/Сохраните данный ключ настройки. Он понадобится в том случае, если вы потеряете устройство с приложением Google Authenticator.',
            }
        },
        password_popup: {
            title: "Смена пароля",
            description: "Чтобы сменить пароль, нужно помнить текущий",
            'description-two': "Введите новый пароль для аккаунта",
            placeholders: {
                current_password: "Текущий пароль",
                new_password: "Новый пароль",
                confirm_password: "Повторите новый пароль",
            },
            button: "Сменить",
        },
    },
};
