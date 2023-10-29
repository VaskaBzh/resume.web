export const WalletsMessages = {
    en: {
        no_wallets: {
            text: "For automatic payment of credited links, your wallet addresses",
            warning: `You have recently verified your email. You can add a wallet after 23:59:01

                    You will receive mining rewards and make payments as soon as you add your wallet.`,
            button: "Add",
        },
        add_popup: {
            title: "Add wallet",
            labels: {
                address: "Wallet address",
                name: "Wallet Label",
            },
            button: "Add",
            email_form: {
                text: "To confirm adding a wallet, enter the code sent to {email}",
                placeholder: "Confirmation code",
                re_send: "Resend code",
                buttons: {
                    back: "Back",
                    add: "Add",
                },
            },
        },
        change_popup: {
            title: "Change wallet",
            labels: {
                address: "Wallet address",
                name: "Wallet Label",
            },
            warning:
                "If your wallet address changes, auto-payouts will not work for 48 hours. You will receive rewards for mining, but will not be able to withdraw them \n" +
                "to your wallet within the specified time.",
            button: "Edit",
            email_form: {
                text: "To confirm adding a wallet, enter the code sent to {email}",
                placeholder: "Confirmation code",
                re_send: "Resend code",
                buttons: {
                    back: "Back",
                    change: "Change",
                },
            },
        },
    },
    ru: {
        no_wallets: {
            text: "Для автовыплаты начислений добавьте адрес вашего кошелька",
            warning: `Вы недавно подтвердили почту. Вы сможете добавить кошелек через 23:59:01 <br> <br>

                    Вы будете получать вознаграждения за майнинг и сможете совершить выплату как только добавите кошелек.`,
            button: "Добавить",
        },
        add_popup: {
            title: "Добавить кошелек",
            labels: {
                address: "Адрес кошелька",
                name: "Метка кошелька",
            },
            button: "Добавить",
            email_form: {
                text: "Для подтверждения добавления кошелька введите код отправленный на почту {email}",
                placeholder: "Код подтверждения",
                re_send: "Отправить код повторно",
                buttons: {
                    back: "Назад",
                    add: "Добавить",
                },
            },
        },
        change_popup: {
            title: "Изменение кошелька",
            labels: {
                address: "Адрес кошелька",
                name: "Метка кошелька",
            },
            warning:
                "В случае изменения адреса кошелька автовыплаты не будут работать в течении 48 часов. Вы будете получать вознаграждения за майнинг, но не сможете вывести их \n" +
                "на свой кошелек в течении указанного времени.",
            button: "Изменить",
            email_form: {
                text: "Для подтверждения добавления кошелька введите код отправленный на почту {email}",
                placeholder: "Код подтверждения",
                re_send: "Отправить код повторно",
                buttons: {
                    back: "Назад",
                    change: "Изменить",
                },
            },
        },
    },
};
