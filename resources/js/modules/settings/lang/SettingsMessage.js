export const SettingsMessage = {
    en: {
        title: ["Personal Information", "Safety"],
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
            text:[
                "Indicate your existing email, we will send a confirmation code to it",
                "Sent the code by email",
                "An SMS with a confirmation code will be sent to the new number",
                "Sent a code to the number",
                "Link your account to Google Authenticator using a QR code or setup key",
                "To confirm, enter the temporary code from the Google Authenticator app",
            ],
            button: ["Back", "Change"],
         },
        button: "Change",
        safety: {
            title: ["Two-Factor Authentication", "Login via SMS", "Change password"],
            text: ["This is a security mechanism used to protect your profile by linking your login to a physical device.", "Receive an SMS with a code to confirm your account login on your mobile phone.", "To change your password, you need to remember the current one."],
            button:["Connect","Change"]
        }
    },
    ru: {
        title:[ "Персональные данные", "Безопасность"],
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
            text:[
                "Укажите существующую почту, на нее мы отправим код подтверждения",
                "Отправили код на почту",
                "На новый номер поступит SMS с кодом подтверждения",
                "Отправили код на номер",
                "Привяжите аккаунт к Google Authenticator с помощью QR-кода или ключа настройки",
                "Для подтверждения введите временный код из приложения Google Authenticator"
            ],
            button: ["Назад", "Сменить"],
        },
        button: "Сменить",
        safety: {
            title: ["Two-Factor Authentication", "Вход по SMS", "Сменить пароль"],
            text: ["Это механизм безопасности, используемый для защиты вашего профиля путем привязки вашего входа к физическому устройству.", "Получай SMS с кодом для подтверждения входа в аккаунт на свой мобильный телефон.", "Для смены пароля вам нужно помнить текущий."],
            button:["Подключить","Сменить"]
        }
    },
};
