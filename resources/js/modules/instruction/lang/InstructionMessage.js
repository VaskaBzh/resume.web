export const InstructionMessage = {
    en: {
        button_titles: {
            statistic: "Get acquainted with 'Statistics'",
            connecting: "Get acquainted with 'Connection'",
            income: "Get acquainted with 'Incomes'",
            settings: "Get acquainted with 'Settings'",
            wallets: "Get acquainted with 'Wallet'",
            watchers: "Get acquainted with 'Watchers'",
            workers: "Get acquainted with 'Workers'",
        },
        step: "Step",
        titles: {
            common: ["Convenient navigation", "Header"],
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
            workers: ["Worker hashrate", "Worker table"],
            connecting: ["Connecting a worker", "Worker connection"],
            wallets: ["Auto payout", "Wallets"],
            watchers: ["Observer mode", "Observer mode"],
            // "Email",
            settings: ["Security"],
        },
        texts: {
            common: [
                `Sidebar navigation for switching between pages and changing the active sub-account.`,
                `To the left is the currency rate. //

                On the right, there's a theme switcher (light/dark) and a button to change the language.`,
            ],
            statistic: [
                `Here you see the average hashrate from all your devices.`,
                `Main performance indicators of your devices and the number of active and inactive workers.`,
                `Forecast for today: /
                Expected accrual for today. //

                Yesterday's income: /
                Accrual for the previous day. //

                Forecast for the month: /
                Expected income for the month.`,
                `Accrued: /
                Shows how much you have accrued and how much remains to accumulate accruals for the payout of bitcoin to your wallet. //

                Income chart for the month: /
                Shows daily accruals for the current month.`,
            ],
            income: [
                `Total accrued over time: /
                The sum of all accruals since the creation of the sub-account. //

                Accrued: /
                Shows how much you have accrued and how much remains to accumulate accruals for the payout of bitcoin to your wallet. //

                Yesterday's income: /
                Amount accrued from mining yesterday.`,
                `Income for the month: /
                Sum of all accruals for the past month. //

                Income chart for the month: /
                Shows daily accruals for the current month.`,
                `History of your accruals and payouts.`,
            ],
            workers: [
                `Current hashrate: /
                Average sub-account hashrate at the moment. //

                Hashrate/24h: /
                Average sub-account hashrate over a day.`,
                `The worker table shows the states of ASICs and their power over different periods, as well as rejects.`,
            ],
            connecting: [
                `To connect, enter the pool URLs in your worker settings.`,
                `For the worker name, use the template Paverl120TH.worker_name, where “worker_name” is your worker's name.`,
            ],
            wallets: [
                `Autopayout occurs when the amount of accruals exceeds the minimum payout threshold: /
                0.005 /
                0.05 /
                0.5 //

                With autopayout, you will receive all accruals to the wallet without any commission.`,
                `You can add one wallet for autopayout. The wallet can be changed (address and label). //

                Editing a wallet requires confirmation through email or 2FA. //

                Upon editing the wallet, autopayout will be processed after 48 hours.`,
            ],
            watchers: [
                `Here you can create a watcher link. //

                The watcher link allows you to check the working status of the workers and view the hashrate without access to data modification, and the user does not need to log into the mining account.`,
                `Specify the name for the watcher link in the pop-up window. //

                Set access to the pages for the watcher and press the "Add" button.`,
            ],
            settings: [
                // `Here you can change your email by clicking the "Change" button.`,
                `Add two-factor authentication to your account by clicking on the "Connect" button and follow the instructions. //

                To change your password, click the "Change" button and follow the instructions.`,
            ],
        },
    },
    ru: {
        button_titles: {
            statistic: "Знакомство со «Статистикой»",
            connecting: "Знакомство с «Подключением»",
            income: "Знакомство с «Доходами»",
            settings: "Знакомство с «Настройками",
            wallets: "Знакомство с «Кошельком»",
            watchers: "Знакомство с «Наблюдателями»",
            workers: "Знакомство с «Воркерами»",
        },
        step: "Шаг",
        titles: {
            common: ["Удобная навигация", "Хедер"],
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
            workers: ["Хешрейт воркеров", "Таблица воркеров"],
            connecting: ["Подключение воркера", "Подключение воркера"],
            wallets: ["Автовыплата", "Кошельки"],
            watchers: ["Режим наблюдателя", "Режим наблюдателя"],
            settings: ["Безопасность"],
            // "Email",
        },
        texts: {
            common: [
                "Боковое меню навигаций для переключения между страницами и смены активного субаккаунта.",
                `Слева находится курс валют. //

                Справа переключатель темы (светлая/темная) и кнопка для смены языка.`,
            ],
            statistic: [
                `Здесь вы видите график среднего хешрейта со всех ваших устройств.`,
                `Главные показатели производительности ваших устройств и количество активных и неактивных воркеров.`,
                `Прогноз на сегодня: /
                Ожидаемое начисленние за сегодняшний день. //

                Вчерашний доход: /
                Начисление за вчерашний день. //

                Прогноз на месяц: /
                Ожидаемый доход за месяц.`,
                `Начислено: /
                Показывает сколько у вас сейчас начислено и сколько осталось накопить начислений для выплаты биткоина на ваш кошелек. //

                График дохода за месяц: /
                Показывает ежедневные начисления за текущий месяц.`,
            ],
            income: [
                `Начислено за все время: /
                Cумма всех начислений с момента создания субаккаунта. //

                Начислено: /
                Показывает сколько у вас сейчас начислено и сколько осталось накопить начислений для выплаты биткоина на ваш кошелек. //

                Вчерашний доход: /
                Сумма начисленная за майнинг вчера.`,
                `Доход за месяц: /
                Сумма всех начислений за последний месяц. //

                График дохода за месяц: /
                Показывает ежедневные начисления за текущий месяц.`,
                `История ваших начислений и выплат.`,
            ],
            workers: [
                `Текущий хешрейт: /
                Средний хешрейт субаккаунта в текущий момент. //

                Хешрейт/24ч: /
                Средний хешрейт субаккаунта за сутки. `,
                `Таблица воркеров показывает состояния асиков и их мощность за разный промежуток времени, а также реджект.`,
            ],
            connecting: [
                `Для подключения введите URL-адреса пула в настройках вашего воркера.`,
                `Для имени воркера используйте шаблон Paverl120TH.worker_name, где “worker_name” ваше название воркера.`,
            ],
            wallets: [
                `Автовыплата происходит когда сумма начислений превысит минимальный порог для выплаты: /
                0.005 /
                0.05 /
                0.5 //

                При автовыплате вы получите все начисления на кошелек без взымания комиссии.`,
                `Вы можете добавить один кошелек для автовыплат. Кошелек можно изменять (адрес и метку). //

                Редактирование кошелька требует подтверждения через почту или 2FA. //

                При редактировании кошелька автовыплата сработает через 48 часов.`,
            ],
            watchers: [
                `Здесь вы можете создать ссылку наблюдателя. //

                Ссылка наблюдателя позволяет проверить статус работы воркеров и просматривать хешрейт без доступа к изменению данных, при этом пользователю не нужно входить в майнинг-аккаунт.`,
                `Укажите название для ссылки наблюдателя в появившемся окне. //

                Установите доступ к страницам у наблюдателя и нажмите кнопку «Добавить»`,
            ],
            settings: [
                // `Здесь вы можете сменить ваш email нажав на кнопку «Сменить»`,
                `Чтобы обезапосить аккаунт добавьте двух-факторную аутентификацию нажав на кнопку «Подключить» и следуйте инструкции. //

                Чтобы сменить пароль нажмите на кнопку «Сменить» и следуйте инструкции.`,
            ],
        },
    },
};
