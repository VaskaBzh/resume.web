export const faqTranslate = {
    en: {
        comeback: 'Back to personal cabinet',
        "faq-links": ["FAQ", "Functional Description"],
        scroll_tabs: ['Sub-account selection','Statistic','Income','Workers','Subaccounts','Connecting','Wallets','Watchers mode','Account','Course BTC and USD','Change interface theme','Language change'],
        title_scroll_tabs: 'Sections',
        title: "Description of allbtc pool functionality",
        titles_texts: {
            titles: ['Choosing a subaccount','Menu item «Statistic»','Menu item «Income»','Menu item «Workers»','Menu item «Subaccounts»','Menu item «Connecting»',
                'Menu item «Wallets»','Menu item «Watchers mode»','Menu item «Accounts»','Course BTC and USD','Change interface theme','Language change'],
            subtitles: ['Hashrate graph','Performance metrics','Accrual for mining','Auto-payment and graph schedule','Step 1 - Pool URLs','Step 2 - Worker Name','Adding wallet','Wallet change']
        },
        texts: {
            text: ['This area allows you to switch between your subaccounts, which appear in a drop-down list when clicked.',
                'With the help of hashrate graph you can track changes in the power of your vorkers and watch their performance at a certain time by selecting the desired period on the graph. The graph allows you to visually analyze any situations related to unstable performance.',
                'Current hashrate is the average hashrate from all your devices within your current subaccount at the moment.',
                'Hashrate / 24h is the average hashrate from all your devices over 24 hours.',
                'Active ones are the working workers that send the results of computations to the network.',
                'Inactive are inactive workers that do not send computation results for more than 10 minutes.',
                'Today\'s forecast is the estimated profit for mining for today.',
                'Yesterday\'s income is the profit for mining for yesterday.',
                'The monthly forecast is the estimated profit for mining in the coming month.',
                'Accrued is a progress-bar that shows your current balance of BTC, accrued for mining (value on the left), and the amount at which the auto-payment will be made to your wallet (value on the right).',
                'The Monthly Income Graph is an interactive graph that shows your accruals by day for the last month.',
                'The page displays information about your daily accruals and payouts.',
                'The mining date is the day on which the reward for mining is calculated. Accruals are made daily 11:00 - 12:00 (GMT+4).',
                'Earnings are rewards for mining. It depends on the amount of hashrate on your subaccount.',
                'Hashrate is the average of the power of all your devices over 24 hours.',
                'The payout date is the day on which the reward is paid to your wallet. The payout occurs when the sum of accruals >= the minimum amount for payout.',
                'Wallet is the address of the wallet to which the mining payment is made.',
                'A payout is the amount of accruals for mining.',
                'TxID is a unique transaction identifier in the Bitcoin blockchain. You can use it to track the status of your transaction on the network.',
                'The page displays information and statistics related to your devices. The Worker table shows the status of each Worker: current hash rate, average hash rate for 24 hours and percentage of redirects for the last 24 hours. Also by clicking on a row in the table,you can see detailed information about the dynamics of change in the hash rate of a vorker over a certain period of time.',
                'Status is the current state (paid/pending/checked/error) in which the accrual is.',
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
            sub_text: 'In case of change of wallet address, autopayments will be suspended for 48 hours to verify the wallet'
        },
        text: "Allbtc pool is a private mining pool optimized for BTC mining, with transparent analytics and timely payments.",
        button: "try demo version",
        who_we_are: {
            button: "who we are",
            card_private: {
                title: ["private pool for data-centers"],
                num: [">3", "2.8", "30", "50%"],
                text: [
                    "years in the crypto industry",
                    "EH/ s pool’s hashrate",
                    "Total BTC mined",
                    "to",
                    "more profit per kW",
                ],
                button: ["Learn more", "get personal offer"],
            },
            card_community: {
                title: ["community for miners"],
                num: ["No.1", "24/7", "1", "4%"],
                text: [
                    "customer service",
                    "fast technical support",
                    "screen for all statistics",
                    "max commission",
                ],
                button: ["Learn more"],
                tooltip:
                    "With high capacity, you can get personal commission redused",
            },
        },
        profitability_calculator: {
            button: ["profitability calculator", "calculator pro"],
            title: [
                "calculate",
                "your income",
                "with the help of",
                "profitability",
                "calculator",
            ],
            text: "Allows you to evaluate and predict possible approximate income for a certain period. Actual earnings may vary slightly. ",
            form_calculator: {
                title: "Profitability Calculator",
                placeholder: ["Total hashrate", "Commission"],
                tooltip: [
                    "Average hashrate of all devices",
                    "The commission depends on the average hashrate: the higher the hashrate, the lower the commission",
                ],
                item: ["Current difficulty", "BTC rate"],
                segment: ["1 day", "1 month", "3 months"],
                text: "For a more accurate profitability forecast please use Calculator Pro",
            },
        },
        why_allbtc: {
            button: "why allbtc pool",
            title: ["Product,", "created", "for miners", "by miners"],
            list: {
                title: [
                    "Focus on Bitcoin",
                    "Transparent monitoring",
                    "technology and safety",
                ],
                text: [
                    "Our team, being experts and practicing miners, specializes in Bitcoin, knows all the intricacies of cryptocurrency mining and introduces new ideas and mechanisms into the development of the pool. All implemented tools help you earn more.",
                    "Up-to-date information in your personal account about the pool hashrate, worker productivity, accruals, payments and other statistics that allow you to evaluate how the pool’s performance and predict future income.",
                    "The advanced technology, Stratum 3.0, allows us to reduce the time of synchronization of mining equipment with the pool. Advanced security system, both physical and virtual.",
                ],
            },
        },
        personal_account: {
            button: ["personal account", "try personal account"],
            title: ["user-friendly", "personal", "account"],
            tooltip: [
                "Nothing superfluous, only",
                "the most current data",
                "Average hashrate of",
                "all your devices",
                "Convenient navigation panel",
                "Be aware of your",
                "income",
                "Progress until accruals",
                "are paid",
                "Current exchange rates, theme",
                "switching and language change",
            ],
            text: "Convenient personal account with all the necessary statistics and intuitive navigation. Only the necessary functions for the user.",
        },
        safety: {
            button: "security",
            encryption: {
                title: "miners data encryption",
                text: "Encrypting data transmitted between users and the pool server helps prevent eavesdropping or interception by attackers. Using secure channels such as SSL/ TLS, allbtc pool ensures that data remains private and secure during transmission and protected from unauthorized access.",
            },
            updates: {
                title: "Regular software updates",
                text: "Regular updates improve the security system: detect vulnerabilities, close them, and, as a result, increase reliability. Also, regular updates of the pool software ensure compatibility with the latest changes caused by the dynamics of the crypto industry.",
            },
            DDoS: {
                title: "DDoS attacks protection",
                text: "When a mining pool is targets by to DDoS attacks, it can lead to disruptions in mining operations, resulting in reduced payouts to the pool's clients. DDoS protection ensures that allbtc pool is always up and running and provides continuous reliable service to its users.",
            },
        },
        mobile_app: {
            button: "mobile application",
            title: "User-friendly app with \n" + "updated data",
            text: "Our team, being experts and practicing miners, specializes in Bitcoin, knows all the intricacies of cryptocurrency mining and introduces new ideas and mechanisms into the development of the pool. All implemented tools help you earn more.",
            note: "coming soon in appstore",
            slides: [
                "Transparent monitoring and effective management",
                "Timely accruals and automatic payouts to any wallet",
                "control of all workers",
                "Reliable account management system",
            ],
        },
        payments: {
            button: "payouts",
            main_title: ["fPPS+", "(gmt+3) 09 am – 11 am", "0% commission"],
            title: ["reward method", "autopayouts", "free funds transfer"],
            text: [
                "A modernized reward system that eliminates the risk of reduced miner income due to fluctuations in transaction fees by combining the block reward and transaction fee payments into one value. It also guarantees a fair distribution of rewards among pool participants.",
                "Automatic payments are made without any action on the part of the miner. Since payments are possible when predetermined conditions are met (reaching a given minimum threshold), funds are received without delay. Moreover, the possibility of an error (incorrectly entered wallet address or transaction amount) caused by a human factor is eliminated.",
                "Automatic withdrawal of funds is completely free, no commission is charged. Moreover, withdrawals to any wallets are also made without commission.",
            ],
        },
        main: {
            button: "main things",
            title: ["Values mission goals"],
            text: [
                "We support honesty, transparency and continuous development in everything we do. We encourage creativity, embrace change and constantly look for new ways to improve our offerings and processes.",
                "Make Bitcoin mining as efficient and convenient as possible, ensuring high security for customer data and their digital assets.",
                "We strive to create the most secure environment for managing your digital assets and unite miners into a large community of like-minded people.",
            ],
        },
        history: {
            button: "history of our pool",
            text: [
                "We’ve created sites for the placement of data centers, hosting and mining hotels. Also cooperated with contractors in Russia and the CIS. Created turnkey mining zones: from renting to putting the farm into operation.",
                "Halving happened, mining difficulty increased. A development team has appeared. Our goal was to create up-to-date solutions to optimize the operation of industrial miners and data centers.",
                "Bitcoin had risen in price significantly. We had expanded our staff several times and created a monitoring system for data centers. In the same year, the first contracts for custom integration were concluded.",
                "We had officially registered a pool for mining cryptocurrencies. The first data centers connected to the system. Their profits increased by 50% for every kilowatt of energy spent.",
                "We stopped working only as a closed pool for data centers and entered the international market. Now we have ambitious plans by the end of 2023.",
            ],
        },
        connect_with_us: "contact us",
        footer: {
            button: "Personal account",
            list: ["Home", "Data centers", "Miners", "FAQ", "News", "Contacts"],
            text: "Privacy Policy",
        },
    },
    ru: {
        comeback: 'Вернуться в личный кабинет',
        "faq-links": ["FAQ", "Описание функционала"],
        scroll_tabs: ['Выбор субаккаунта','Статистика','Доходы','Воркеры','Субаккаунты','Подключение','Кошельки','Режим наблюдателя','Аккаунт','Курс BTC и USD','Смена темы интерфейса','Смена языка'],
        title_scroll_tabs: 'Разделы',
        title: "Описание функционала allbtc pool",
        titles_texts: {
            titles: ['Выбор суббаккаунта','Пункт меню "Статистика','Пункт меню «Доходы','Пункт меню «Воркеры»','Пункт меню «Субаккаунты»','Пункт меню «Подключение» ',
                'Пункт меню «Кошелек»','Пункт меню «Режим наблюдателя»','Пункт меню «Аккаунт"','Курс BTC/USD и USD/RUB','Смена темы интерфейса','Смена языка интерфейса'],
            subtitles: ['График хешрейта','Показатели производительности','Начисление за майнинг','Автовыплата и график доходности','Шаг 1 — URL-адреса пула ','Шаг 2 — Имя воркера','Добавление кошелька','Изменение кошелька'],
        },
        texts: {
            text: ['Данная область позволяет переключаться между вашими субаккаунтами, которые появляются в выпадающем списке при клике.',
                'С помощью графика хешрейта вы можете отследить изменение мощности ваших воркеров и смотреть их производительность в определенное время, выбрав на графике нужный период. График позваляет наглядного разборать любые ситуации связанные с нестабильной работой.',
                'Текущий хешрейт - это среднее значение хешрейта со всех ваших устройств в рамках текущего субаккаунта в\n' +
                '                данный момент.',
                'Хешрейт / 24ч - это среднее значение хешрейта со всех ваших устройств за 24 часа.',
                'Активные - это работающие воркеров, которые отправляют в сеть результаты вычислений.',
                '                Неактивные - это неработающие воркеры, которые не отправляют результаты вычислений более 10 минут.\n',
                'Прогноз на сегодня - это ориентировочная прибыль за майнинг за сегодняшний день.',
                'Вчерашний доход - это прибыль за майнинг за вчерашний день.',
                'Прогноз на месяц - это ориентировочная прибыль за майнинг в ближайший месяц.',
                'Начислено - это прогресс-бар, который показывает ваш текущий баланс BTC, начисленных за майнинг\n' +
                '                (значение слева), и сумму при которой произойдет автовыплата на ваш кошелек (значение справа).',
                'График дохода за месяц - это интерактивный график, который\n' +
                '                отображает ваши начисления по дням за последний месяц.',
                'Страница отображает информацию о ваших ежедневных начислениях\n' +
                '                и выплатах.',
                'Дата добычи - это день начисления вознаграждения за майнинг. Начисления производятся ежедневно 11:00\n' +
                '                    - 12:00 (GMT+4).',
                'Заработок - это вознаграждение за майнинг. Зависит от кол-ва хешрейта на вашем субаккаунте.',
                'Хешрейт - это среднее значение мощности всех ваших устройств за 24 часа.',
                'Дата выплаты - это день, когда происходит выплата вознаграждения на ваш кошелек. Выплата происходит\n' +
                '                    в том случае, когда сумма начислений >= минимальной суммы для выплаты.',
                'Кошелек - это адрес кошелька, на который произведена выплата за майнинг.',
                'Выплата - это сумма начислений за майнинг.',
                'TxID - это уникальный идентификатор транзакции в блокчейне Bitcoin. С его помощью вы можете\n' +
                '                    отследить статус вашей транзакции в сети.',
                'Страница отображает информацию и статистику, связанную с\n' +
                '                вашими устройствами.\n' +
                '                Таблица воркеров показывает состояние каждого воркера: текущий хешрейт, средний хешрейт за 24 часа и\n' +
                '                процент\n' +
                '                реджекта за последние 24 часа. Также нажав на строку в таблице, можно увидеть детальную информацию о\n' +
                '                динамике\n' +
                '                изменения хешрейта воркера за определенный промежуток времени.',
                'Статус - это текущее состояние (выплачено/в ожидании/проверка/ошибка) в котором находится\n' +
                '                    начисление.',
                'С помощью данного меню вы можете посмотреть статистику\n' +
                '                среднего хешрейта, количество\n' +
                '                воркеров, сколько монет было всего выплачено на ваш кошелек, а так же переключаться между субаккаунтами\n' +
                '                и\n' +
                '                создавать дополнительные субаккаунты.',
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
                '                двухфакторную аутентификацию, сменить пароль.',
                'Актуальный курсы валют с частотой обновления 5 секунд.',
                'С помощью данной кнопки вы можете изменить тему интерфейса на\n' +
                '                светлую/тёмную. Улучшайте комфорт просмотра с учетом вашего предпочтения. Обеспечьте доступность и\n' +
                '                выберите подходящую тему для оптимального визуального восприятия.',
                'С помощью данной кнопки вы можете изменить язык интерфейса.\n' +
                '                Для смены языка нажмите на кнопку и выберите нужный вам язык из появившегося списка.',
            ],
        },
        warning_wallets: {
            text: 'Важно!',
            sub_text: 'Указать кошелек в сети BTC / Bitcoin, чтобы избежать потери ваших средств.'

        },
        warning_wallets_change: {
            sub_text: 'В случае изменения адреса кошелька автовыплаты будут приостановлены в течении 48 часов для проверки кошелька.'
        },
        history_pool: {
            block_title: "История нашего пула",
            texts: [
                "Создаем площадки под размещение дата-центов, хостингов и майнинг-отелей. Сотрудничаем с подрядчиками в РФ и СНГ. Создаем зоны для майнинга «под ключ»: от аренды до введения фермы в эксплуатацию.",
                "Произошел халвинг, сложность майнинга выросла. Появилась команда разработчиков. Наша цель – создание актуальных решений для оптимизации работы промышленных майнеров и дата-центров.",
                "Биткоин значительно подорожал. Мы кратно расширили штат и сформировали систему мониторинга для дата-центров. В этом же году заключили первые договоры на кастомную интеграцию.",
                "Официально зарегистрировали пул для майнинга криптовалют. К системе подключились первые дата-центры. На 50% увеличили их прибыль за каждый потраченный киловатт энергии.",
                "Перестали работать только лишь как закрытый пул для дата-центров, вышли на международный рынок. К концу 2023 года у нас амбициозные планы.",
            ],
        },
        text: "Allbtc pool  — приватный майнинг-пул, оптимизированный для добычи BTC, с прозрачной аналитикой и своевременными выплатами.",
        button: "попробовать демо кабинет",
        who_we_are: {
            button: "кто мы",
            card_private: {
                title: ["приватный пул для дата- центров"],
                num: [">3", "2.8", "30", "50%"],
                text: [
                    "лет в крипто индустрии",
                    "EH/ s хешрейт пула",
                    "BTC добыто всего",
                    "до",
                    "больше прибыли за кВт",
                ],
                button: ["Узнать больше", "получить персональные условия"],
            },
            card_community: {
                title: ["комьюнити для частных майнеров"],
                num: ["№1", "24/7", "1", "4%"],
                text: [
                    "клиентский сервис",
                    "быстрая техподдержка",
                    "экран для статистики",
                    "комиссия пула",
                ],
                button: ["Узнать больше"],
                tooltip:
                    "При больших мощностях вы можете получить персональную сниженную комиссию",
            },
        },
        profitability_calculator: {
            button: ["калькулятор доходности", "калькулятор pro"],
            title: [
                "рассчитайте ",
                "свой доход",
                "с помощью",
                "калькулятора",
                "доходности",
            ],
            text: "Позволяет оценить и спрогнозировать возможный приблизительный доход за определенный период. Фактические доходы могут незначительно отличаться. ",
            form_calculator: {
                title: "Калькулятор Доходности",
                placeholder: ["Общий хешрейт", "Комиссия"],
                tooltip: [
                    "Средний хешрейт всех устройств",
                    "Комиссия зависит от общего среднего хешрейта: чем больше хешрейт, тем меньше комиссия",
                ],
                item: ["Текущая сложность", "Курс BTC"],
                segment: ["1 день", "1 месяц", "3 месяца"],
                text: "Для более точного прогноза доходности используйте Калькулятор Pro",
            },
        },
        why_allbtc: {
            button: "почему allbtc pool",
            title: ["ПРодукт,", "созданный", "майнерами", "для майнеров"],
            list: {
                title: [
                    "Фокус на Bitcoin",
                    "Прозрачный мониторинг",
                    "технологии и безопасность",
                ],
                text: [
                    "Наша команда, будучи экспертами и практикующими майнерами, специализируется на биткоине, знает все тонкости добычи криптовалюты и внедряет новые идеи и механизмы в развитие пула. Все внедренные инструменты помогают зарабатывать больше.",
                    "Актуальная информация в личном кабинете о хешрейте пула, производительности воркеров, начислениях, выплатах и других статистических данных, позволяющие оценивать работу пула и прогнозировать будущие доходы.",
                    "Продвинутая Stratum 3.0 технология, позволяющая сократить время синхронизации майнинг оборудования с пулом. Передовая система безопасности как физической так и виртуальной.",
                ],
            },
        },
        personal_account: {
            button: ["личный кабинет", "посмотреть личный кабинет"],
            title: ["удобный", "личный", "кабинет"],
            tooltip: [
                "Ничего лишнего, только самые",
                "актуальные данные",
                "Средний хешрейт всех",
                "ваших устройств",
                "Удобная панель навигации",
                "Будьте в курсе своего",
                "дохода",
                "Прогресс до выплаты",
                "начислений",
                "Актуальный курс валют, переключение",
                "темы и смена языка",
            ],
            text: "Позволяет оценить и спрогнозировать возможный приблизательный доход и прибыль за определенный период. Фактические доходы могут незначительно отличаться. ",
        },
        safety: {
            button: "безопасность",
            encryption: {
                title: "шифрование данных майнера",
                text:
                    "Шифрование данных, передаваемых между пользователями и сервером \n" +
                    "пула, помогает предотвратить подслушивание или перехват злоумышленниками. Используя безопасные каналы, такие как \n" +
                    "SSL/TLS, allbtc pool гарантирует, \n" +
                    "что данные остаются конфиденциальными и безопасными во время передачи и защищенными от несанкционированного доступа.",
            },
            updates: {
                title: "регулярные обновления по",
                text: "Регулярные обновления обеспечивают улучшение системы безопасности: обнаружение уязвимостей, их закрытие, и, как следствие, повышение надежности. Также регулярные обновления программного обеспечения пула обеспечивают совместимость с последними изменениями, вызванными динамикой развития криптоиндустрии.",
            },
            DDoS: {
                title: "защита от DDoS-атак",
                text:
                    "Когда майнинг-пул подвержен DDoS-атакам, это может привести \n" +
                    "к перебоям в майнинг операциях, что приводит к снижению выплат клиентам пула. Защита от DDoS-атак гарантирует, что allbtc pool всегда будет работоспособным и обеспечит непрерывное надежное обслуживание своих пользователей.",
            },
        },
        mobile_app: {
            button: "мобильное приложение",
            title: "понятное приложение \n" + "с актуальными данными",
            text: "Наша команда, будучи экспертами и практикующими майнерами, специализируется на биткоине, знает все тонкости добычи криптовалюты и внедряет новые идеи и механизмы в развитие пула. Все внедренные инструменты помогают зарабатывать больше.",
            note: "скоро в appstore",
            slides: [
                "Прозрачный мониторинг \n" + "и эффективное управление",
                "Своевременные начисления и автовывод на любой кошелек",
                "контроль всех майнинговых устройств",
                "Надежная \n" + "система управления аккаунтом ",
            ],
        },
        payments: {
            button: "выплаты",
            main_title: ["fPPS+", "(gmt+3) 09 am – 11 am", "комиссия 0%"],
            title: ["метод вознаграждения", "автовыплаты", "бесплатный вывод"],
            text: [
                "Модернизированная система вознаграждений, которая исключает риск снижения доходов майнеров из-за колебаний комиссий за транзакции, поскольку объединяет вознаграждение за блок и выплаты комиссий за транзакции в одно значение. Также гарантирует справедливое распределение вознаграждений между участниками пула.",
                "Автоматические выплаты осуществляются без каких-либо действий со стороны майнера. \n" +
                "Так как выплаты возможны при выполнении заранее заданных условий (достижение заданного минимального порога), поступление средств производится без задержек. Более того, исключается возможность допущения ошибки (неправильно введенный адрес кошелька или сумма транзакции), вызванной человеческим фактором.",
                "Автовывод средств полностью бесплатный, никакая комиссия не начисляется. Более того, вывод на любые кошельки также производится без комиссии.",
            ],
        },
        main: {
            button: "главное",
            title: ["Ценности", "миссия", "цели"],
            text: [
                "Мы поддерживаем честность, прозрачность и постоянное развитие во всем, что мы делаем. Поощряем творчество, принимаем перемены и постоянно ищем новые способы улучшения наших предложений и процессов.и процессов.",
                "Сделать майнинг биткоина максимально эффективным и удобным, обеспечивая высокую безопасность данных клиентов и их цифровых активов.",
                "Мы стремимся создать максимально безопасную среду для управления своими цифровыми активами и объединить майнеров в большое комьюнити единомышленников.",
            ],
        },
        history: {
            button: "история нашего пула",
            text: [
                "Создаем площадки под размещение дата-центов, хостингов и майнинг-отелей. Сотрудничаем с подрядчиками в РФ и СНГ. Создаем зоны для майнинга «под ключ»: от аренды до введения фермы в эксплуатацию.",
                "Произошел халвинг, сложность майнинга выросла. Появилась команда разработчиков. Наша цель – создание актуальных решений для оптимизации работы промышленных майнеров и дата-центров.",
                "Биткоин значительно подорожал. Мы кратно расширили штат и сформировали систему мониторинга для дата-центров. В этом же году заключили первые договоры на кастомную интеграцию.",
                "Официально зарегистрировали пул для майнинга криптовалют. К системе подключились первые дата-центры. На 50% увеличили их прибыль за каждый потраченный киловатт энергии.",
                "Перестали работать только лишь как закрытый пул для дата-центров, вышли на международный рынок. К концу 2023 года у нас амбициозные планы.",
            ],
        },
        connect_with_us: "связаться с нами",
        footer: {
            button: "Личный кабинет",
            list: [
                "Главная",
                "Дата-центрам",
                "Майнерам",
                "FAQ",
                "Новости",
                "Контакты",
            ],
            text: "Политика конфиденциальности",
        },
    },
};
