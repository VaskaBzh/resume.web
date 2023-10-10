export const InstructionMessage = {
    en: {
        button_titles: {
            statistic: "Get acquainted with 'Statistics'",
            connecting: "Get acquainted with 'Connection'",
            incomes: "Get acquainted with 'Incomes'",
            settings: "Get acquainted with 'Settings'",
            wallets: "Get acquainted with 'Wallets'",
            watchers: "Get acquainted with 'Watchers'",
            workers: "Get acquainted with 'Workers'",
        },
        step: "Step",
        titles: {
            common: [
                "Convenient navigation",
                "Header",
            ],
            statistic: [
                "Interactive chart",
                "Worker metrics",
                "Earnings forecast",
                "Accruals",
            ],
            income: [
                "Accruals",
                "Monthly income",
                "History of accruals and payouts",
            ],
            workers: [
                "Worker hashrate",
                "Worker table",
            ],
            connecting: [
                "Connecting a worker",
                "Worker connection",
            ],
            wallets: [
                "Auto payout",
                "Wallets",
            ],
            watchers: [
                "Observer mode",
                "Observer mode",
            ],
            settings: [
                "Email",
                "Security",
            ],
        },
        texts: {
            common: [
                "Side navigation menu for switching between pages and changing the active subaccount.",
                "To the left is the currency rate. On the right is the theme switcher (light/dark) and a button to change the language.",
            ],
            statistic: [
                "Here you see a chart of the average hashrate from all your devices.",
                "Main performance metrics of your devices and the number of active and inactive workers.",
                "Today's forecast: Expected accrual for today. Yesterday's income: Accrual for yesterday. Monthly forecast: Expected income for the month.",
                "Accrued: Shows how much you have accrued now and how much more you need to accrue for a bitcoin payout to your wallet. Monthly income chart: Shows daily accruals for the current month.",
            ],
            income: [
                "Total accrued over time: The sum of all accruals since creating the subaccount. Accrued: Shows how much you have accrued now and how much more you need to accrue for a bitcoin payout to your wallet. Yesterday's income: The sum accrued from mining yesterday.",
                "Monthly income: The total accruals for the past month. Monthly income chart: Shows daily accruals for the current month.",
                "History of your accruals and payouts.",
            ],
            workers: [
                "Current hashrate: Subaccount's average hashrate at the moment. Hashrate/24h: Subaccount's average hashrate for the day.",
                "The worker table displays the state of the ASICs and their power over different periods, as well as reject.",
            ],
            connecting: [
                "To connect, enter the pool URLs in your worker's settings.",
                "For the worker's name, use the template Paverl120TH.worker_name, where “worker_name” is your worker's name.",
            ],
            wallets: [
                "Auto payout occurs when the accrual amount exceeds the minimum payout threshold: 0.005, 0.05, 0.5. With auto payout, you receive all accruals to your wallet without a fee.",
                "You can add one wallet for auto payouts. The wallet can be changed (address and label). Editing the wallet requires confirmation via email or 2FA. When editing the wallet, auto payout will occur after 48 hours.",
            ],
            watchers: [
                "Here you can create an observer link. The observer link allows you to check the working status of workers and view the hashrate without access to data changes, and the user doesn't need to log into the mining account.",
                "Specify a name for the observer link in the popup window. Set access to pages for the observer and click the 'Add' button.",
            ],
            settings: [
                "Here you can change your email by clicking the 'Change' button.",
                "Specify a name for the observer link in the popup window. Set access to pages for the observer and click the 'Add' button.",
            ],
        }
    },
    ru: {
        button_titles: {
            statistic: "Знакомсто со «Статистикой»",
            connecting: "Знакомсто с «Подключением»",
            incomes: "Знакомсто с «Доходами»",
            settings: "Знакомсто с «Настройками",
            wallets: "Знакомсто с «Кошельками»",
            watchers: "Знакомсто с «Наблюдателями»",
            workers: "Знакомсто с «Воркерами»",
        },
        step: "Шаг",
        titles: {
            common: [
                "Удобная навигация",
                "Хедер",
            ],
            statistic: [
                "Интерактивный график",
                "Показатели воркеров",
                "Прогноз доходов",
                "Начисления",
            ],
            income: [
                "Начисления",
                "Дохода за месяц",
                "История начислений и выплат",
            ],
            workers: [
                "Хешрейт воркеров",
                "Таблица воркеров",
            ],
            connecting: [
                "Подключение воркера",
                "Подключение воркера",
            ],
            wallets: [
                "Автовыплата",
                "Кошельки",
            ],
            watchers: [
                "Режим наблюдателя",
                "Режим наблюдателя",
            ],
            settings: [
                "Email",
                "Безопасность",
            ],
        },
        texts: {
            common: [
                "Боковое меню навигаций для переключения между страницами и смены активного субаккаунта.",
                `Слева находится курс валют.

                Справа переключатель темы (светлая/темная) и кнопка для смены языка.`,
            ],
            statistic: [
                `Здесь вы видите график среднего хешрейта со всех ваших устройств.`,
                `Главные показатели производительности ваших устройств и количество активных и неактивных воркеров.`,
                `Прогноз на сегодня:
                Ожидаемое начисленние за сегодняшний день.

                Вчерашний доход:
                Начисление за вчерашний день.

                Прогноз на месяц:
                Ожидаемый доход за месяц.`,
                `Начислено:
                Показывает сколько у вас сейчас начислено и сколько осталось накопить начислений для выплаты биткоина на ваш кошелек.

                График дохода за месяц:
                Показывает ежедневные начисления за текущий месяц.`,
            ],
            income: [
                `Начислено за все время:
                Cумма всех начислений с момента создания субаккаунта.

                Начислено:
                Показывает сколько у вас сейчас начислено и сколько осталось накопить начислений для выплаты биткоина на ваш кошелек.

                Вчерашний доход:
                Сумма начисленная за майнинг вчера.`,
                `Доход за месяц:
                Сумма всех начислений за последний месяц.

                График дохода за месяц:
                Показывает ежедневные начисления за текущий месяц.`,
                `История ваших начислений и выплат.`,
            ],
            workers: [
                `Текущий хешрейт:
                Средний хешрейт субаккаунта в текущий момент.

                Хешрейт/24ч:
                Средний хешрейт субаккаунта за сутки. `,
                `Таблица воркеров показывает состояния асиков и их мощность за разный промежуток времени, а также реджект.`,
            ],
            connecting: [
                `Для подключения введите URL-адреса пула в настройках вашего воркера.`,
                `Для имени воркера используйте шаблон Paverl120TH.worker_name, где “worker_name” ваше название воркера.`,
            ],
            wallets: [
                `Автовыплата происходит когда сумма начислений превысит минимальный порог для выплаты:
                0.005
                0.05
                0.5

                При автовыплате вы получите все начисления на кошелек без взымания комиссии.`,
                `Вы можете добавить один кошелек для автовыплат. Кошелек можно изменять (адрес и метку).

                Редактирование кошелька требует подтверждения через почту или 2FA.

                При редактировании кошелька автовыплата сработает через 48 часов.`,
            ],
            watchers: [
                `Здесь вы можете создать ссылку наблюдателя.

                Ссылка наблюдателя позволяет проверить статус работы воркеров и просматривать хешрейт без доступа к изменению данных, при этом пользователю не нужно входить в майнинг-аккаунт.`,
                `Укажите название для ссылки наблюдателя в появившемся окне.

                Установите доступ к страницам у наблюдателя и нажмите кнопку «Добавить»`,
            ],
            settings: [
                `Здесь вы можете сменить ваш email нажав на кнопку «Сменить»`,
                `Укажите название для ссылки наблюдателя в появившемся окне.

                Установите доступ к страницам у наблюдателя и нажмите кнопку «Добавить»`,
            ],
        }
    },
}
