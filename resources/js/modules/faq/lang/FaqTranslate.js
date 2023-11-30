export const faqTranslate = {
    en: {
        comeback: 'Back to my account',
        "faq-links": ["FAQ", "Functional Description"],
        scroll_tabs: ['Sub-account selection','Statistic','Income','Workers','Subaccounts','Connecting','Wallets','Watchers mode','Account','Course BTC and USD','Change interface theme','Language change'],
        title_scroll_tabs: 'Sections',
        title: "Description of allbtc pool functionality",
        titles_texts: {
            titles: ['Choosing a subaccount','Menu item «Statistic»','Menu item «Income»','Menu item «Workers»','Menu item «Subaccounts»','Menu item «Connecting»',
                'Menu item «Wallets»','Menu item «Watchers»','Menu item «Accounts»','Course BTC and USD','Change interface theme','Language change'],
            subtitles: ['Hashrate graph','Performance metrics','Accrual for mining','Auto-payment and graph schedule','Step 1 - Pool URLs','Step 2 - Worker Name','Adding wallet','Wallet change']
        },
        texts: {
            text: ['This area allows you to switch between your subaccounts, which appear in a drop-down list when clicked.',
                'With the help of hashrate graph you can track changes in the power of your vorkers and watch their performance at a certain time by selecting the desired period on the graph. The graph allows you to visually analyze any situations related to unstable performance.',
                'Current hashrate',
                ' - is the average hashrate from all your devices within your current subaccount at the moment.',
                'Hashrate / 24h',
                ' - is the average hashrate from all your devices over 24 hours.',
                'Active ones',
                ' - are the working workers that send the results of computations to the network.',
                'Inactive',
                ' - are inactive workers that do not send computation results for more than 10 minutes.',
                'Today\'s forecast',
                ' - is the estimated profit for mining for today.',
                'Yesterday\'s income',
                ' - is the profit for mining for yesterday.',
                'The monthly forecast',
                ' - is the estimated profit for mining in the coming month.',
                'Accrued',
                ' - is a progress-bar that shows your current balance of BTC, accrued for mining (value on the left), and the amount at which the auto-payment will be made to your wallet (value on the right).',
                'The Monthly Income Graph',
                ' - is an interactive graph that shows your accruals by day for the last month.',
                'The page displays information about your daily accruals and payouts.',
                'The mining date',
                ' - is the day on which the reward for mining is calculated. Accruals are made daily 11:00 - 12:00 (GMT+4).',
                'Earnings',
                ' - are rewards for mining. It depends on the amount of hashrate on your subaccount.',
                'Hashrate',
                ' - is the average of the power of all your devices over 24 hours.',
                'The payout date',
                ' - is the day on which the reward is paid to your wallet. The payout occurs when the sum of accruals >= the minimum amount for payout.',
                'Wallet',
                ' - is the address of the wallet to which the mining payment is made.',
                'A payout',
                ' - is the amount of accruals for mining.',
                'TxID',
                ' - is a unique transaction identifier in the Bitcoin blockchain. You can use it to track the status of your transaction on the network.',
                'Status',
                ' - is the current state (paid/pending/checked/error) in which the accrual is.',
                'The page displays information and statistics related to your devices. The Worker table shows the status of each Worker: current hash rate, average hash rate for 24 hours and percentage of redirects for the last 24 hours. Also by clicking on a row in the table,you can see detailed information about the dynamics of change in the hash rate of a vorker over a certain period of time.',
                'Using this menu you can see the statistics of average hashrate, number of workers, how many coins have been paid to your wallet, as well as switch between subaccounts and create additional subaccounts.',
                'To connect your worker to the pool you need to enter 3 pool url addresses in your worker settings (see picture).',
                'Next, you need to specify the name of the worker. The name of the Worker consists of SUBACCOUNT_NAME.YOUR_WORKER_NAME. For example - Pavel120TH.YOUR_YOUR_WORKER_NAME The name of the subaccount in the name of the Worker must be specified correctly, so the Worker understands to which subaccount he belongs.',
                'Using this page you can add your wallet (BTC/Bitcoin network) to which you will receive rewards for mining.',
                'To change the wallet, click on the triplet and select "Change" in the menu that appears. You can change the wallet label (name) and address.',
                'With this menu you can create and customize watchers links. An watchers link allows you to view your mining information in read mode.',
                'Using this menu you can enable/disable two-factor authentication, change the password.',
                'Current currency rates with an update frequency of 5 seconds.',
                'Use this button to change the interface theme to light/dark. Improve your viewing experience based on your preference. Ensure accessibility and choose the right theme for optimal visual experience.',
                'Use this button to change the interface language. To change the language, click on the button and select the language you need from the list that appears.',
            ],
        },
        warning_wallets: {
            text: 'Warning!',
            sub_text: 'Specify a wallet in the BTC / Bitcoin network to avoid losing your funds.'

        },
        warning_wallets_change: {
            sub_text: ['In case of change of wallet address', 'autopayments will be suspended for 48 hours to verify the wallet.']
        },
    },
    ru: {
        comeback: 'Вернуться в личный кабинет',
        "faq-links": ["FAQ", "Описание функционала"],
        scroll_tabs: ['Выбор субаккаунта', 'Статистика', 'Доходы', 'Воркеры', 'Субаккаунты', 'Подключение', 'Кошельки', 'Режим наблюдателя', 'Аккаунт', 'Курс BTC и USD', 'Смена темы интерфейса', 'Смена языка'],
        title_scroll_tabs: 'Разделы',
        title: "Описание функционала allbtc pool",
        titles_texts: {
            titles: ['Выбор суббаккаунта', 'Пункт меню «Статистика»', 'Пункт меню «Доходы»', 'Пункт меню «Воркеры»', 'Пункт меню «Субаккаунты»', 'Пункт меню «Подключение» ',
                'Пункт меню «Кошелек»', 'Пункт меню «Наблюдатели»', 'Пункт меню «Аккаунт"', 'Курс BTC/USD и USD/RUB', 'Смена темы интерфейса', 'Смена языка интерфейса'],
            subtitles: ['График хешрейта', 'Показатели производительности', 'Начисление за майнинг', 'Автовыплата и график доходности', 'Шаг 1 — URL-адреса пула ', 'Шаг 2 — Имя воркера', 'Добавление кошелька', 'Изменение кошелька'],
        },
        texts: {
            text: ['Данная область позволяет переключаться между вашими субаккаунтами, которые появляются в выпадающем списке при клике.',
                'С помощью графика хешрейта вы можете отследить изменение мощности ваших воркеров и смотреть их производительность в определенное время, выбрав на графике нужный период. График позваляет наглядного разборать любые ситуации связанные с нестабильной работой.',
                'Текущий хешрейт',
                ' - это среднее значение хешрейта со всех ваших устройств в рамках текущего субаккаунта в данный момент.',
                'Хешрейт / 24ч',
                ' - это среднее значение хешрейта со всех ваших устройств за 24 часа.',
                'Активные',
                ' - это работающие воркеров, которые отправляют в сеть результаты вычислений.',
                'Неактивные',
                ' - это неработающие воркеры, которые не отправляют результаты вычислений более 10 минут.',
                'Прогноз на сегодня',
                ' - это ориентировочная прибыль за майнинг за сегодняшний день.',
                'Вчерашний доход',
                ' - это прибыль за майнинг за вчерашний день.',
                'Прогноз на месяц ',
                '- это ориентировочная прибыль за майнинг в ближайший месяц.',
                'Начислено',
                ' - это прогресс-бар, который показывает ваш текущий баланс BTC, начисленных за майнинг\n' +
                '                (значение слева), и сумму при которой произойдет автовыплата на ваш кошелек (значение справа).',
                'График дохода за месяц',
                ' - это интерактивный график, который\n' +
                '                отображает ваши начисления по дням за последний месяц.',
                'Страница отображает информацию о ваших ежедневных начислениях\n' +
                '                и выплатах.',
                'Дата добычи',
                ' - это день начисления вознаграждения за майнинг. Начисления производятся ежедневно 11:00\n' +
                '                    - 12:00 (GMT+4).',
                'Заработок',
                ' - это вознаграждение за майнинг. Зависит от кол-ва хешрейта на вашем субаккаунте.',
                'Хешрейт',
                ' - это среднее значение мощности всех ваших устройств за 24 часа.',
                'Дата выплаты',
                ' - это день, когда происходит выплата вознаграждения на ваш кошелек. Выплата происходит\n' +
                '                    в том случае, когда сумма начислений >= минимальной суммы для выплаты.',
                'Кошелек',
                ' - это адрес кошелька, на который произведена выплата за майнинг.',
                'Выплата',
                ' - это сумма начислений, которая достигла минимального порога для осуществления автовыплаты на кошелек.',
                'TxID',
                ' - это уникальный идентификатор транзакции в блокчейне Bitcoin. С его помощью вы можете\n' +
                '                    отследить статус вашей транзакции в сети.',
                'Статус',
                ' - это текущее состояние (выплачено/в ожидании/проверка/ошибка) в котором находится\n' +
                '                    начисление.',
                'Страница отображает информацию и статистику, связанную с\n' +
                '                вашими устройствами.\n' +
                '                Таблица воркеров показывает состояние каждого воркера: текущий хешрейт, средний хешрейт за 24 часа и\n' +
                '                процент\n' +
                '                реджекта за последние 24 часа. При клике на строку в таблице, можно увидеть детальную информацию о\n' +
                '                динамике\n' +
                '                изменения хешрейта воркера за определенный промежуток времени.',
                'С помощью данного меню вы можете посмотреть статистику среднего хешрейта, количество воркеров, сколько монет было всего выплачено на ваш кошелек, а также переключаться между субаккаунтами и создавать дополнительные субаккаунты.',
                'Для подключения воркера к пулу вам необходимо внести в\n' +
                '                настройках вашего воркера 3 url-адреса пула (см. картинку).',
                'Далее вам необходимо указать имя воркера. Имя воркера состоит\n' +
                '                из ИМЯ_СУБАККАУНТА.ИМЯ_ВОРКЕРА.\n' +
                '                Например - Pavel120TH.ВАШЕ_ИМЯ_ВОРКЕРА Имя субаккаунта в названии воркера необходимо\n' +
                '                указать правильно, так воркер понимает к какому субаккаунту он принадлежит.',
                'С помощью данной страницы вы можете добавить свой кошелек\n' +
                '                (сеть BTC/Bitcoin), на который будете получать вознаграждения за майнинг.',
                'Для изменения кошелька нажмите на троеточие и в появившемся\n' +
                '                меню выберите “Изменить”. Вы можете изменять метку кошелька (название) и адрес.',
                'С помощью данного меню вы можете создавать и настраивать\n' +
                '                ссылки наблюдателей. Ссылка наблюдателя позволяет просматривать информацию о вашем майнинге в режиме\n' +
                '                чтения.',
                'С помощью данного меню вы можете подключить/отключить\n' +
                '                двухфакторную аутентификацию, изменить пароль.',
                'Актуальный курсы валют с частотой обновления 5 секунд.',
                'С помощью данной кнопки вы можете изменить тему интерфейса на светлую/тёмную. Выберите подходящую тему, чтобы легче воспринимать информацию и быстрее сосредоточиться на главном.',
                'С помощью данной кнопки вы можете изменить язык интерфейса.\n' +
                '                Для смены языка нажмите на кнопку и выберите нужный вам язык из появившегося списка.',
            ],
        },
        warning_wallets: {
            text: 'Важно!',
            sub_text: 'Указать кошелек в сети BTC / Bitcoin, чтобы избежать потери ваших средств.'

        },
        warning_wallets_change: {
            sub_text: ['В случае изменения адреса кошелька ', ' автовыплаты будут приостановлены в течении 48 часов для проверки кошелька.']
        },
    }
};
