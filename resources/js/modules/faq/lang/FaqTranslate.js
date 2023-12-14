export const faqTranslate = {
    en: {
        comeback: 'Back to my account',
        "faq-links": ["FAQ", "Functional Description"],
        scroll_tabs: ['Sub-account selection', 'Statistic', 'Income', 'Workers', 'Subaccounts', 'Connecting', 'Wallets', 'Watchers mode', 'Account', 'Course BTC and USD', 'Change interface theme', 'Language change'],
        title_scroll_tabs: 'Sections',
        title: "Description of allbtc pool functionality",
        titles_texts: {
            titles: ['Choosing a subaccount', 'Menu item «Statistic»', 'Menu item «Income»', 'Menu item «Workers»', 'Menu item «Subaccounts»', 'Menu item «Connecting»',
                'Menu item «Wallets»', 'Menu item «Watchers»', 'Menu item «Accounts»', 'Course BTC and USD', 'Change interface theme', 'Language change'],
            subtitles: ['Hashrate graph', 'Performance metrics', 'Accrual for mining', 'Auto-payment and graph schedule', 'Step 1 - Pool URLs', 'Step 2 - Worker Name', 'Adding wallet', 'Wallet change']
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
        scroll_questions: {
            tabs: ['How to protect from yourself fraud?',
                'How is the security of my funds ensured in the mining pool?',
                'How is the protection of miners’ personal information ensured?',
                'How to secure your account?',
                'Are there additional authentication methods to ensure account security?',
                'How does the support service work?',
                'What is stratum?',
                'How to reduce rejection?',
                'How does the actual hashrate differ from the declared hashrate?',
                'What are workers?',
                'Why are workers not shown?',
                'What worker name should I specify when setting up equipment?',
                'What payment methods does the pool use?',
                'What happens if I do not specify a wallet for payment?',
                'Why haven\'t I received my payment?',
                'What is the minimum withdrawal amount on the pool?',
                'Can I pause payments?',
                'Where can I check the payment TxID?',
                'What is a subaccount?',
                'How to delete an account?',],
            subtitle: ['Fraud protection is an important aspect in cryptocurrency mining. Here are a few measures you can take to protect yourself from fraud:',
                'To ensure the security of miner funds we have implemented:',
                'To ensure the security of miners’ personal data we use:',
                'Here are some tips to keep your account secure:',
                'Yes, for additional protection in allbtc pool you can enable two-factor authentication.',
                'If you have any questions or encounter a problem, please contact support.  /\n' +
                'The support service works every day and responds to the client within 5 minutes. Our managers will answer all your questions and help resolve technical problems.',
                'Stratum is a standardized protocol for mining pools. In other words, this is the established name of the URL that is written in the ASIC to connect to the pool. You can find this URL in the “Connection” section in your personal account.',
                'Reject is the percentage of rejection, that is, the ratio of rejected and accepted shares. When a pool uses a share to create a block, the miner receives a reward. Otherwise, the equipment will work for free, so you need to regularly monitor the rejection rate.',
                'Actual hashrate is the actual computational speed that mining equipment achieves during the process of mining cryptocurrency.\n' +
                '//The declared hashrate is the value indicated by the manufacturer of the mining equipment in its specifications or advertising materials. It is usually the maximum possible computing speed that the hardware can achieve under ideal conditions.',
                'Workers are computers or special devices that perform computational operations to verify and process transactions on the blockchain and create new blocks.',
                'If you have just connected your devices, it will take 1 - 10 minutes to update the data and display the workers in the pool statistics. If during this time the workers have not appeared, contact our support team.',
                'The worker name must be set in the following form: "subaccount name"."worker_name". / Let\'s decipher:',
                'The pool uses the FPPS+ payout method.',
                'The funds will not disappear anywhere, but will accumulate in your subaccount until you specify a wallet. Please note: once you link your payout wallet, withdrawals will be frozen for 48 hours for security reasons.',
                'Payment is a transfer of earned funds (rewards) to your active wallet.',
                'The minimum amount is a threshold, upon reaching which the accumulated amount is paid to your wallet. In our pool auto payout occurs when the balance reaches 0.0005 BTC. The minimum threshold for automatic payout is set by the pool; it cannot be changed manually.',
                'Yes, if you have been hacked or lost access to your wallet, contact technical support for help.',
                'To view the TxID of a transaction, go to the “Income” section, find the payment history in the table, copy the TxID and paste the copied number into the blockchain network verification site.',
                'A sub-account is a separate account that is created within the main account in your personal account. For convenience, creating several subaccounts allows users to separate information into so-called groups: the statistics of one subaccount will differ from the statistics of another subaccount.',
                'For security reasons, you cannot delete your account manually. To delete your account you need to contact support.'],
            frood: {
                list: ['Be careful with unverified links and programs', 'Use strong passwords', 'Update your antivirus software', 'Be alert to social engineering', 'Data backup'],
                text_list: ['Do not click on unverified links or install software from untrusted sources. Fraudsters can use fake links and programs to gain access to your mining equipment or steal your cryptocurrency.',
                    'Protect your mining account and cryptocurrency wallets with strong passwords. Use a unique password for each platform and change passwords regularly.',
                    'Install reliable antivirus software on all your devices and keep it updated regularly. This will help detect and prevent security threats, including fraudsters.',
                    'Fraudsters may use social engineering techniques to gain access to your information or mining equipment. Be careful when communicating with strangers, especially in an online environment, and do not share sensitive information.',
                    'Regularly back up important data such as cryptocurrency wallets and mining hardware settings. In case of fraud or network failure, you can quickly restore your information and continue mining.'],
            },
            security_jam: {
                list: ['FPPS+ reward method', 'All payments occur automatically', 'No extra expenses'],
                text_list: ['This is a modernized reward system that eliminates the risk of miners losing their earnings due to fluctuating transaction fees because it combines the block reward and transaction fee payments into one value. FPPS+ also guarantees a fair distribution of rewards between pool participants.',
                    'Automatic payments are made without any action on the part of the miner. Once the total reward amount reaches a certain minimum threshold, the funds are automatically transferred to your wallet. What are the advantages of auto payments? The receipt of funds is carried out without delay, and the possibility of an error (incorrectly entered wallet address or transaction amount) caused by a human factor is eliminated.',
                    'Since the number of transactions is regulated by the system, automatic withdrawal of funds is completely free, no commission is charged.'],
            },

            security_information: {
                list: ['Miner data encryption', 'Regular operating system updates', 'Methods for protecting against DDOS attacks'],
                text_list: ['Encrypting data that is transferred between users and the pool server helps prevent eavesdropping or interception by attackers. By using secure channels such as SSL/TLS, we ensure that data remains private and secure during transmission and protected from unauthorized access.',
                    'Regular updates improve the security system: detect vulnerabilities, close them and as a result increase reliability. Also, regular updates of the pool software ensure compatibility with the latest changes caused by the dynamics of the crypto industry.',
                    'When a mining pool is subject to DDoS attacks, this can lead to interruptions in mining operations, which results in reduced payouts to the miners. DDoS protection ensures that allbtc pool is always up and running and provides continuous reliable service to its users.'],
            },
            security_account: {
                list: ['Strong password', 'Two-factor authentication (2FA)', 'Be careful when using public Wi-Fi', 'Software update', 'Beware of phishing attacks', 'Account activity monitoring'],
                text_list: ['Use a unique password consisting of a combination of letters, numbers and special characters. Avoid using easy-to-guess passwords and reusing your password on other platforms.',
                    'Enable 2FA for an extra layer of security. This allows you to verify your identity using an additional code or application other than your password.',
                    'Avoid using public Wi-Fi networks to access your account. Such networks may not be secure and your data may be stolen.',
                    'Regularly update the software on your device, including your operating system, antivirus software, and other security-related software.',
                    'Be alert for suspicious emails, messages, or websites that may be trying to obtain your credentials. Never provide your passwords or sensitive information to unverified sources.',
                    'Check your account activity regularly to notice any suspicious activity. If you notice unusual activity, contact support immediately.'],
            },
            texts: {
                flood: '',
                security_jam: '',
                security_information: '',
                security_account: '',
                methods_security: '2FA improves the security of online accounts and systems by making it more difficult for attackers to gain access to an account even ' +
                    'if they know the password. Even if an attacker steals or discovers your password, they will not have access to the second factor, which is required ' +
                    'for full authentication.//To enable two-factor authentication in allbtc pool, you need to download the Google Authenticator application and scan the ' +
                    'QR code to link your account to Google Authenticator. If you don`t have access to the camera, you can enter the setup key in the Google Authenticator ' +
                    'app instead of scanning the QR code.//After linking your account to the Google Authenticator app, you will need to enter a code to confirm the 2FA ' +
                    'connection. You will find this code in the Google Authenticator app.//Once you enable 2FA, all actions (login, adding-changing a wallet, disabling 2FA) ' +
                    'must be confirmed with a unique code from Google Authenticator.',
                support: 'Как связаться со службой поддержки? // написать в наш телеграм: \@allbtc_support / написать на почту: support\@all-btc.com//Также вступайте в наше комьюнити в телеграме "allbtc_community", где мы освещаем последние новости майнинг индустрии и говорим о последних обновлениях в Allbtc Pool.',
                stratum: 'Stratum helps optimize the interaction between miners and the pool during the mining process. This is a communication protocol that is used to ensure the most efficient operation.//The mining pool sends a block of data for processing to each member of the pool, who then begins processing this data in order to find a solution for a new block in the blockchain. When one of the miners finds the correct solution, the result is sent back to the mining pool.//Stratum makes this entire procedure as efficient as possible, it minimizes delays and ensures smoother and more stable operation. Because of it miners are able to process more blocks and therefore earn more rewards.',
                status_reject: 'The normal daily rejection rate is from 1% to 3%. It is almost impossible to achieve a zero rejection rate in the form of all accepted shares, since there is a delay between the device and the pool server.//Rejectrate is rejected solutions that ASICs sent to the pool. Most often they are rejected because the solution came too late and the pool moved on to solving a new problem.//If the percentage of rejection exceeds the daily norm (up to 3%), we recommend checking the stability of the Internet connection, rebooting the router, and replacing the corresponding cables if they have become unusable.//Reducing the level of rejects in mining can be achieved by taking the following measures:/',
                status_reject_list: ['Update your mining hardware software to the latest version. ',
                    'Check your network connection. The connection must be stable and reliable. Periodic loss of connection or low Internet speed can lead to an increase in rejects.',
                    'Edit your mining software settings. Make sure you are using the optimal settings for your device.',
                    'Make sure your equipment doesn\'t overheat. High temperatures can lead to errors and rejections. Place your mining equipment in a cool and well-ventilated area.'],
                fact_hashrate: ['The difference between actual and reported hashrate can be caused by several factors.', 'It is important to understand that the actual hashrate may differ from the declared one, and this is normal. When planning mining operations, it is recommended to consider the actual hashrate in order to have more realistic mining expectations.'],
                fact_hashrate_list: ['Actual mining conditions may differ from ideal ones, which affects the performance of the equipment.',
                    'The efficiency of mining equipment may be lower than stated by the manufacturers.',
                    'Power, cooling, or software issues may also affect the actual hashrate.'],
                what_workers: 'Workers are part of a mining network and work together to solve complex mathematical problems that are necessary to add new blocks to the blockchain and receive cryptocurrency rewards.//' +
                    'Mining workers perform computational operations, usually using graphics processing units (GPUs) or specialized mining devices such as Application-Specific Integrated Circuit (ASIC). They solve cryptographic puzzles known as hashes and submit their solutions to the blockchain network for verification. When a decision is made by the blockchain, miners are rewarded for their contribution to securing the network and validating transactions.//' +
                    'Participating in mining using workers requires high computing power and energy. As competition increases, mining with individual workers becomes less and less profitable, and some miners choose to join mining pools to pool their resources and increase their chances of receiving rewards.',
                workers_not_visible: '',
                where_name_workers: 'For other equipment settings, use the instructions from your equipment manufacturer. When using one worker name, your devices will appear as one worker.',
                where_name_workers_list: ['<subaccount name> is the name of your subaccount that you specified during registration;', '. - yes, this is the point, it is absolutely necessary;', '<worker_name> - set automatically'],
                methods_income: 'FPPS+ is a modernized reward system that eliminates the risk of miners\' earnings being impacted by fluctuating transaction fees because it combines block rewards and transaction fee payments into one value. FPPS+ also guarantees a fair distribution of rewards between pool participants.',
                not_enter_wallets: '',
                why_not_income: 'Why might the payment not happen?',
                why_not_income_list: ['Check if you added a wallet after registration. If you just added a wallet, automatic payments will not work for 48 hours. You will receive mining rewards, but will not be able to withdraw them to your wallet within the specified time for security reasons.',
                    'Invalid wallet address. Check that the wallet address is correct. The wallet must contain a BTC address.',
                    'You recently changed your wallet. If you change your wallet, automatic payments will not work for 48 hours. You will receive rewards for mining, but will not be able to withdraw them to your wallet within the specified time for security reasons.',
                    'The current balance has not reached the minimum threshold for automatic payment. You can see information about the current balance of accruals in the “Statistics” or “Earnings” sections.',
                    'If everything looks correct, but there are still no payments, you need to write to our support team, we will help you solve the problem.'],
                min_sum_income: '',
                stop_income: '',
                txid: '',
                sub: '“Subaccounts” section: here you can switch between your subaccounts and see basic information for each of them. In the top block you can see general statistics of all your subaccounts.',
                delete_acc: '',

            },
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
        scroll_questions: {
            tabs: ['Как защититься от фрода?',
                'Как обеспечивается безопасность моих средств в майнинг пуле?',
                'Как обеспечивается защита персональной информации майнеров?',
                'Как обезопасить свой аккаунт?',
                'Существуют ли дополнительные методы аутентификации для обеспечения безопасности аккаунта?',
                'Как работает служба поддержки?',
                'Что такое стратум?',
                'Как понизить реджект?',
                'Чем отличается фактический хешрейт от заявленного?',
                'Что такое воркеры?',
                'Почему воркеры не отображаются?',
                'Какое имя воркера мне указать при настройке оборудования?',
                'Какие методы выплат использует пул?',
                'Что будет, если я не укажу кошелек для выплаты?',
                'Почему я не получил выплату?',
                'Какая минимальная сумма вывода на пуле?',
                'Могу ли я приостановить выплаты?',
                'Где я могу проверить TxID выплаты?',
                'Что такое субаккаунт?',
                'Как удалить аккаунт?',],
            subtitle: ['Защита от фрода - это важный аспект в майнинге криптовалют. Вот несколько мер, которые можно принять, чтобы защититься от фрода:',
                'Для обеспечения безопасности средств майнера мы внедрили:',
                'Для обеспечения безопасности персональных данных майнеров мы используем:',
                'Вот несколько рекомендаций, как обеспечить безопасность вашего аккаунта:',
                'Да, для дополнительной защиты в Allbtc Pool вы можете подключить двухфакторную аутентификацию.',
                'Если у вас возникли вопросы, или вы столкнулись с проблемой, пожалуйста, обратитесь в службу поддержки. /\n' +
                'Служба поддержки работает каждый день и отвечает клиенту в течение 5 минут. Наши менеджеры ответят на все ваши вопросы и помогут устранить проблемы технического характера.',
                'Стратум - это стандартизированный протокол для майниг пула. Иначе говоря, это устоявшееся название URL которые прописываются в ASIC для подключения к пулу. Этот URL вы можете найти, в разделе “Подключение” в личном кабинете.',
                'Реджект – это процент отказа, то есть соотношение отклоненных и принятых шар. Когда пул использует акцию для создания блока, майнер получает вознаграждение. В противном случае оборудование будет работать бесплатно, поэтому нужно регулярно отслеживать коэффициент реджектов.',
                'Фактический хэшрейт - это реальная скорость вычислений, которую достигает майнинговое оборудование в процессе майнинга криптовалюты. /\n' +
                'Заявленный хэшрейт - это значение, указанное производителем майнингового оборудования в его спецификациях или рекламных материалах. Он обычно является максимально возможной скоростью вычислений, которую может достичь оборудование в идеальных условиях.',
                'Воркеры — это компьютеры или специальные устройства, которые выполняют вычислительные операции для проверки и обработки транзакций в блокчейне и создания новых блоков.',
                'Если вы только подключили свои устройства, то потребуется 1 — 10 минут, чтобы обновить данные и отобразить воркеры в статистике пула. Если в течение этого времени воркеры так и не отобразились — свяжитесь с нашей службой поддержки.',
                'Имя воркера должно быть задано в таком виде: / "имя_субаккаунта"."workers_name" / Расшифровываем:',
                'Пул использует метод выплат FPPS+.',
                'Средства никуда не исчезнут, а будут накапливаться на вашем субаккаунте, пока вы не укажете кошелек. Обратите внимание: после привязки кошелька для выплат вывод средств будет заморожен на 48 часа в целях безопасности.',
                'Выплата – это перечисление заработанных денежных средств (вознаграждения) на ваш активный кошелек.',
                'Минимальная сумма – это порог, достигнув который выплачивается накопленная сумма на ваш кошелек. В нашем пуле автовыплата осуществляется, когда баланс достигает 0.0005 BTC. Минимальный порог для автовыплаты устанавливается пулом, вручную его изменить нельзя.',
                'Да, в случае если вас взломали или вы потеряли доступ к кошельку, обратитесь в техническую поддержку за помощью.',
                'Чтобы посмотреть TxID транзакции, зайдите в раздел “Доходы”, в таблице найдите историю выплаты, скопируйте TxID и вставьте скопированный номер на сайт проверки сети блокчейн.',
                'Субаккаунт – это отдельный аккаунт (под-аккаунт), который создается в рамках основного аккаунта в личном кабинете. Для удобства создание нескольких субаккаунтов позволяет пользователям разделять информацию по так называемым группам: статистика одного субаккаунта будет отличаться от статистики другого субаккаунта.',
                'В целях безопасности нельзя удалить аккаунт вручную. Чтобы удалить аккаунт, нужно связаться со службой поддержки.'],
            frood: {
                list: ['Будьте осторожны с непроверенными ссылками и программами', 'Используйте сильные пароли', 'Обновляйте антивирусное программное обеспечение', 'Будьте внимательны к социальной инженерии', 'Резервное копирование данных'],
                text_list: ['Не переходите по непроверенным ссылкам и не устанавливайте программное обеспечение из ненадежных источников. Фродеры могут использовать поддельные ссылки и программы для получения доступа к вашему майнинговому оборудованию или кражи вашей криптовалюты.',
                    'Защитите свой майнинговый аккаунт и кошельки криптовалюты сильными паролями. Используйте уникальный пароль для каждой платформы и регулярно меняйте пароли.',
                    'Установите надежное антивирусное программное обеспечение на все свои устройства и регулярно обновляйте его. Это поможет обнаружить и предотвратить угрозы для безопасности, включая фродеров.',
                    'Фродеры могут использовать методы социальной инженерии, чтобы получить доступ к вашей информации или майнинговому оборудованию. Будьте осторожны при общении с незнакомыми людьми, особенно в онлайн-среде, и не делитесь чувствительными данными.',
                    'Регулярно создавайте резервные копии важных данных, таких как кошельки криптовалют и настройки майнингового оборудования. В случае фрода или сбоя, вы сможете быстро восстановить свою информацию и продолжить майнинг.'],
            },
            security_jam: {
                list: ['Метод вознаграждения FPPS+', 'Все выплаты происходят автоматически', 'Автовыплаты освобождают от лишних расходов'],
                text_list: ['Это модернизированная система вознаграждений, которая исключает риск снижения доходов майнеров из-за колебаний комиссий за транзакции, потому что объединяет вознаграждение за блок и выплаты комиссий за транзакции в одно значение. Также FPPS+ гарантирует справедливое распределение вознаграждений между участниками пула.',
                    'Автоматические выплаты осуществляются без каких-либо действий со стороны майнера. Как только общая сумма вознаграждения достигает определенного минимального порога, средства автоматически переводятся на ваш кошелек. В чем преимущества автовыплат? Поступление средств производится без задержек, а также исключается возможность допущения ошибки (неправильно введенный адрес кошелька или сумма транзакции), вызванной человеческим фактором.',
                    'Так как количество транзакций регулируется системой, автовывод средств полностью бесплатный, никакая комиссия не начисляется.'],
            },

            security_information: {
                list: ['Шифрование данных майнера', 'Регулярные обновления операционной системы', 'Методы по защите от DDOS-атак'],
                text_list: ['Шифрование данных, которые передаются между пользователями и сервером пула, помогает предотвратить подслушивание или перехват злоумышленниками. Используя безопасные каналы, такие как SSL/TLS, мы гарантируем, что данные остаются конфиденциальными и безопасными во время передачи и защищенными от несанкционированного доступа.',
                    'Регулярные обновления обеспечивают улучшение системы безопасности: обнаружение уязвимостей, их закрытие, и, как следствие, повышение надежности. Также регулярные обновления программного обеспечения пула обеспечивают совместимость с последними изменениями, вызванными динамикой развития криптоиндустрии.',
                    'Когда майнинг пул подвержен DDoS-атакам, это может привести к перебоям в майнинг операциях, что влечет за собой снижение выплат клиентам пула. Защита от DDoS-атак гарантирует, что Allbtc Pool всегда будет работоспособным и обеспечит непрерывное надежное обслуживание своих пользователей.'],
            },
            security_account: {
                list: ['Сильный пароль', 'Двухфакторная аутентификация (2FA)', 'Аккуратность при публичном Wi-Fi', 'Обновление программного обеспечения', 'Осторожность с фишинговыми атаками', 'Мониторинг активности аккаунта'],
                text_list: ['Используйте уникальный пароль, состоящий из комбинации букв, цифр и специальных символов. Избегайте использования легко угадываемых паролей и повторного использования пароля на других платформах.',
                    'Включите 2FA для дополнительного слоя защиты. Это позволяет проверить вашу личность с помощью дополнительного кода или приложения, помимо пароля.',
                    'Избегайте использования общедоступных Wi-Fi сетей для доступа к своему аккаунту. Такие сети могут быть небезопасными и ваши данные могут быть украдены.',
                    'Регулярно обновляйте программное обеспечение на вашем устройстве, включая операционную систему, антивирусные программы и другие программы, связанные с безопасностью.',
                    'Будьте внимательны к подозрительным электронным письмам, сообщениям или веб-сайтам, которые могут пытаться получить ваши учетные данные. Никогда не предоставляйте свои пароли или чувствительную информацию по непроверенным источникам.',
                    'Регулярно проверяйте свою активность аккаунта, чтобы заметить любые подозрительные действия. Если вы заметите необычную активность, немедленно свяжитесь со службой поддержки.'],
            },
            texts: {
                flood: '',
                security_jam: '',
                security_information: '',
                security_account: '',
                methods_security: 'Да, для дополнительной защиты в Allbtc Pool вы можете ' +
                    'подключить двухфакторную аутентификацию. // Двухфакторная аутентификация (2FA) – ' +
                    'это метод проверки подлинности пользователя, который требует предоставления двух различных ' +
                    'факторов для доступа к системе или учетной записи. Вместо того чтобы просто вводить пароль, ' +
                    'пользователь также предоставляет второй фактор, например одноразовый код для подтверждения своей ' +
                    'личности./2FA улучшает безопасность онлайн-аккаунтов и систем, поскольку злоумышленникам будет труднее' +
                    ' получить доступ к учетной записи, даже если они узнали пароль. Даже если злоумышленник украдет или узнает ваш ' +
                    'пароль, у него не будет доступа ко второму фактору, который требуется для полноценной аутентификации.//Чтобы подключить ' +
                    'двухфакторную аутентификацию в Allbtc Pool, нужно скачать приложение Google Authenticator и отсканировать QR-код для ' +
                    'привязки своего аккаунта к Google Authenticator. Если у вас нет доступа к камере, вы можете вместо сканирования QR-кода ввести ' +
                    'ключ настройки в приложении Google Authenticator.//После привязки аккаунта к приложению Google Authenticator вам необходимо будет ' +
                    'ввести код для подтверждения подключения 2FA. Этот код вы найдете в приложении Google Authenticator.//Как только вы подключите 2FA, ' +
                    'все действия (вход, добавление/изменение кошелька, отключение 2FA) должны быть подтверждены уникальным кодом из Google Authenticator.',
                support: 'Как связаться со службой поддержки? // написать в наш телеграм: \@allbtc_support / написать на почту: support\@all-btc.com//Также вступайте в наше комьюнити в телеграме "allbtc_community", где мы освещаем последние новости майнинг индустрии и говорим о последних обновлениях в Allbtc Pool.',
                stratum: 'Стратум помогает оптимизировать взаимодействие между майнерами и пулом в процессе майнинга. Это протокол коммуникации, который используется, чтобы обеспечить наиболее эффективную работу.//Майнинг пул отправляет блок данных для обработки каждому участнику пула, который затем начинает обработку этих данных с целью нахождения решения для нового блока в блокчейне. Когда один из майнеров находит правильное решение, результат отправляется обратно в майнинг пул.//Стратум делает всю эту процедуру максимально эффективной, он минимизирует задержки и обеспечивает более гладкую и стабильную работу. Благодаря этому майнеры способны обрабатывать больше блоков и, следовательно, зарабатывать больше вознаграждения.',
                status_reject: 'Нормальный показатель суточного реджекта — от 1% до 3%. Достичь нулевого показателя реджекта в виде полностью всех принятых шар почти невозможно, так как существует задержка между устройством и сервером пула.//Реджектрейт — это отклоненные решения, которые асики отправили на пул. Чаще всего они отклоняются из-за того, что решение пришло слишком поздно, а пул перешел к решению новой задачи.//Если процент реджекта превышает суточный показатель нормы (до 3%) — мы рекомендуем проверить стабильность интернет соединения, перезагрузить маршрутизатор, заменить соответсвующие кабели, если они пришли в негодность.//Понижение уровня реджектов в майнинге может быть достигнуто путем принятия следующих мер:/',
                status_reject_list: ['Обновите программное обеспечение своего майнингового оборудования до последней версии. ',
                'Проверьте ваше подключение к сети. Подключение должно быть стабильным и надежным. Периодические потери связи или низкая скорость интернета могут привести к увеличению реджектов.',
                'Отредактируйте настройки майнингового программного обеспечения. Убедитесь, что вы используете оптимальные параметры для вашего устройства.',
                'Убедитесь, что ваше оборудование не перегревается. Высокая температура может привести к ошибкам и реджектам. Разместите майнинговое оборудование в прохладном и хорошо проветриваемом месте.'],
                fact_hashrate: ['Заявленный хэшрейт - это значение, указанное производителем майнингового оборудования в его спецификациях или рекламных материалах. Он обычно является максимально возможной скоростью вычислений, которую может достичь оборудование в идеальных условиях.//Отличие между фактическим и заявленным хэшрейтом может быть вызвано несколькими факторами.', 'Важно понимать, что фактический хэшрейт может отличаться от заявленного, и это нормальное явление. При планировании майнинговых операций рекомендуется учитывать фактический хэшрейт, чтобы получить более реалистичные ожидания от майнинга.'],
                fact_hashrate_list: ['Реальные условия майнинга могут отличаться от идеальных, что влияет на производительность оборудования. ',
                    'Степень эффективности майнингового оборудования может быть ниже заявленной производителями.',
                'Наличие проблем с питанием, охлаждением или программным обеспечением также может влиять на фактический хэшрейт.'],
                what_workers: 'Воркеры являются частью майнинговой сети и работают вместе для решения сложных математических задач, которые необходимы для добавления новых блоков в блокчейн и получения вознаграждения в виде криптовалюты.//' +
                    'Каждый воркер в майнинге имеет свой уникальный идентификатор, который используется для зачисления вознаграждения. Эти устройства объединяются в майнинговые пулы, чтобы увеличить свои шансы на решение задачи и получение вознаграждения.//' +
                    'Воркеры в майнинге выполняют вычислительные операции, обычно с использованием графических процессоров (GPU) или специализированных майнинговых устройств, таких как ASIC (Application-Specific Integrated Circuit). Они решают криптографические головоломки, известные как хэши, и отправляют полученные решения на проверку в блокчейн сеть. Когда решение принимается блокчейном, майнеры получают вознаграждение за свой вклад в обеспечение безопасности сети и проверку транзакций.//' +
                    'Участие в майнинге с использованием воркеров требует высокой вычислительной мощности и энергии. С ростом конкуренции майнинг с помощью отдельных воркеров становится всё менее прибыльным, и некоторые майнеры предпочитают присоединяться к майнинговым пулам, чтобы объединить свои ресурсы и повысить свои шансы на получение вознаграждения.',
                workers_not_visible: '',
                where_name_workers: 'Для остальных настроек оборудования воспользуйтесь инструкцией производителя вашего оборудования. При использовании одного имени воркера ваши устройства будут отображаться одним воркером.',
                where_name_workers_list: ['<имя субаккаунта> - это имя вашего субаккаунта, который вы задали при регистрации;', '. - да, это точка, она обязательна нужна;', '<worker_name> - задается автоматически'],
                methods_income: 'FPPS+ – это модернизированная система вознаграждений, которая исключает риск снижения доходов майнеров из-за колебаний комиссий за транзакции, потому что объединяет вознаграждение за блок и выплаты комиссий за транзакции в одно значение. Также FPPS+ гарантирует справедливое распределение вознаграждений между участниками пула.',
                not_enter_wallets: '',
                why_not_income: 'Почему выплата может не произойти?',
                why_not_income_list: ['Проверьте, добавили ли вы кошелек после регистрации. Если вы только добавили кошелек, автовыплаты не будут работать в течении 48 часов. Вы будете получать вознаграждения за майнинг, но не сможете вывести их на свой кошелек в течение указанного времени в целях безопасности.',
                'Неверный адрес кошелька. Проверьте, чтобы адрес кошелька был корректным. Кошелек должен содержать BTC адрес.',
                'Вы недавно изменили кошелек. Если вы изменили кошелек, автовыплаты не будут работать в течении 48 часов. Вы будете получать вознаграждения за майнинг, но не сможете вывести их на свой кошелек в течении указанного времени в целях безопасности.',
                'Текущий баланс не достиг минимального порога для автовыплаты. Информацию о текущем балансе начислений вы можете увидеть в разделе “Статистика” или “Доходы”.',
                'Если все выглядит правильно, а выплат все еще нет — нужно написать в нашу службу поддержки, мы поможем решить проблему.'],
                min_sum_income: '',
                stop_income: '',
                txid: '',
                sub: 'Раздел “Субаккаунты”: здесь вы можете переключаться между своими субаккаунтами и видеть основную информацию по каждому из них. В верхнем блоке вы можете видеть общую статистику всех ваших субаккаунтов.',
                delete_acc: '',

            },
        },
        questions: [
            {
                frod: {
                    subtitle: 'Защита от фрода - это важный аспект в майнинге криптовалют. Вот несколько мер, которые можно принять, чтобы защититься от фрода:',
                    list: ['Будьте осторожны с непроверенными ссылками и программами', 'Используйте сильные пароли', 'Обновляйте антивирусное программное обеспечение', 'Будьте внимательны к социальной инженерии', 'Резервное копирование данных'],
                    text_list: ['Не переходите по непроверенным ссылкам и не устанавливайте программное обеспечение из ненадежных источников. Фродеры могут использовать поддельные ссылки и программы для получения доступа к вашему майнинговому оборудованию или кражи вашей криптовалюты.',
                        'Защитите свой майнинговый аккаунт и кошельки криптовалюты сильными паролями. Используйте уникальный пароль для каждой платформы и регулярно меняйте пароли.',
                        'Установите надежное антивирусное программное обеспечение на все свои устройства и регулярно обновляйте его. Это поможет обнаружить и предотвратить угрозы для безопасности, включая фродеров.',
                        'Фродеры могут использовать методы социальной инженерии, чтобы получить доступ к вашей информации или майнинговому оборудованию. Будьте осторожны при общении с незнакомыми людьми, особенно в онлайн-среде, и не делитесь чувствительными данными.',
                        'Регулярно создавайте резервные копии важных данных, таких как кошельки криптовалют и настройки майнингового оборудования. В случае фрода или сбоя, вы сможете быстро восстановить свою информацию и продолжить майнинг.'],
                    text: ['Помните, что защита от фрода - это непрерывный процесс, и важно оставаться внимательным и информированным о новых угрозах и методах защиты.'],
                }
            },
            {
                security_jam: {
                    subtitle: 'Для обеспечения безопасности средств майнера мы внедрили:',
                    list: ['Метод вознаграждения FPPS+', 'Все выплаты происходят автоматически', 'Автовыплаты освобождают от лишних расходов'],
                    text_list: ['Это модернизированная система вознаграждений, которая исключает риск снижения доходов майнеров из-за колебаний комиссий за транзакции, потому что объединяет вознаграждение за блок и выплаты комиссий за транзакции в одно значение. Также FPPS+ гарантирует справедливое распределение вознаграждений между участниками пула.',
                        'Автоматические выплаты осуществляются без каких-либо действий со стороны майнера. Как только общая сумма вознаграждения достигает определенного минимального порога, средства автоматически переводятся на ваш кошелек. В чем преимущества автовыплат? Поступление средств производится без задержек, а также исключается возможность допущения ошибки (неправильно введенный адрес кошелька или сумма транзакции), вызванной человеческим фактором.',
                        'Так как количество транзакций регулируется системой, автовывод средств полностью бесплатный, никакая комиссия не начисляется.'],
                    text: [],
                }
            },
            {
                security_information: {
                    subtitle: 'Для обеспечения безопасности персональных данных майнеров мы используем:',
                    list: ['Шифрование данных майнера', 'Регулярные обновления операционной системы', 'Методы по защите от DDOS-атак'],
                    text_list: ['Шифрование данных, которые передаются между пользователями и сервером пула, помогает предотвратить подслушивание или перехват злоумышленниками. Используя безопасные каналы, такие как SSL/TLS, мы гарантируем, что данные остаются конфиденциальными и безопасными во время передачи и защищенными от несанкционированного доступа.',
                        'Регулярные обновления обеспечивают улучшение системы безопасности: обнаружение уязвимостей, их закрытие, и, как следствие, повышение надежности. Также регулярные обновления программного обеспечения пула обеспечивают совместимость с последними изменениями, вызванными динамикой развития криптоиндустрии.',
                        'Когда майнинг пул подвержен DDoS-атакам, это может привести к перебоям в майнинг операциях, что влечет за собой снижение выплат клиентам пула. Защита от DDoS-атак гарантирует, что Allbtc Pool всегда будет работоспособным и обеспечит непрерывное надежное обслуживание своих пользователей.'],
                    text: [],
                }
            },
            {
                security_account: {
                    subtitle: 'Вот несколько рекомендаций, как обеспечить безопасность вашего аккаунта:',
                    list: ['Сильный пароль', 'Двухфакторная аутентификация (2FA)', 'Аккуратность при публичном Wi-Fi', 'Обновление программного обеспечения', 'Осторожность с фишинговыми атаками', 'Мониторинг активности аккаунта'],
                    text_list: ['Используйте уникальный пароль, состоящий из комбинации букв, цифр и специальных символов. Избегайте использования легко угадываемых паролей и повторного использования пароля на других платформах.',
                        'Включите 2FA для дополнительного слоя защиты. Это позволяет проверить вашу личность с помощью дополнительного кода или приложения, помимо пароля.',
                        'Избегайте использования общедоступных Wi-Fi сетей для доступа к своему аккаунту. Такие сети могут быть небезопасными и ваши данные могут быть украдены.',
                        'Регулярно обновляйте программное обеспечение на вашем устройстве, включая операционную систему, антивирусные программы и другие программы, связанные с безопасностью.',
                        'Будьте внимательны к подозрительным электронным письмам, сообщениям или веб-сайтам, которые могут пытаться получить ваши учетные данные. Никогда не предоставляйте свои пароли или чувствительную информацию по непроверенным источникам.',
                        'Регулярно проверяйте свою активность аккаунта, чтобы заметить любые подозрительные действия. Если вы заметите необычную активность, немедленно свяжитесь со службой поддержки.'],
                    text: [],
                }
            },
            {
                methods_security: {
                    subtitle: 'Да, для дополнительной защиты в Allbtc Pool вы можете подключить двухфакторную аутентификацию.',
                    list: [],
                    text_list: [],
                    text: ['Двухфакторная аутентификация (2FA) – это метод проверки подлинности пользователя, который требует предоставления двух различных факторов для доступа к системе или учетной записи. Вместо того чтобы просто вводить пароль, пользователь также предоставляет второй фактор, например одноразовый код для подтверждения своей личности./\n' +
                    '2FA улучшает безопасность онлайн-аккаунтов и систем, поскольку злоумышленникам будет труднее получить доступ к учетной записи, даже если они узнали пароль. Даже если злоумышленник украдет или узнает ваш пароль, у него не будет доступа ко второму фактору, который требуется для полноценной аутентификации.',
                        'Чтобы подключить двухфакторную аутентификацию в Allbtc Pool, нужно скачать приложение Google Authenticator и отсканировать QR-код для привязки своего аккаунта к Google Authenticator. Если у вас нет доступа к камере, вы можете вместо сканирования QR-кода ввести ключ настройки в приложении Google Authenticator.',
                        'После привязки аккаунта к приложению Google Authenticator вам необходимо будет ввести код для подтверждения подключения 2FA. Этот код вы найдете в приложении Google Authenticator.', "После привязки аккаунта к приложению Google Authenticator вам необходимо будет ввести код для подтверждения подключения 2FA. Этот код вы найдете в приложении Google Authenticator.",
                        'Как только вы подключите 2FA, все действия (вход, добавление/изменение кошелька, отключение 2FA) должны быть подтверждены уникальным кодом из Google Authenticator.'],
                }
            },
            {
                support: {
                    subtitle: '  ',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                stratum: {
                    subtitle: '  ',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                status_reject: {
                    subtitle: ' ',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                fact_hashrate: {
                    subtitle: ' ',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                what_workers: {
                    subtitle: 'Воркеры — это компьютеры или специальные устройства, которые выполняют вычислительные операции для проверки и обработки транзакций в блокчейне и создания новых блоков.',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                workers_not_visible: {
                    subtitle: '',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                where_name_workers: {
                    subtitle: 'Имя воркера должно быть задано в таком виде:',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                methods_income: {
                    subtitle: 'Пул использует метод выплат FPPS+.',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                not_enter_wallets: {
                    subtitle: '',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                why_not_income: {
                    subtitle: 'Выплата – это перечисление заработанных денежных средств (вознаграждения) на ваш активный кошелек.',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                min_sum_income: {
                    subtitle: 'Что такое минимальная сумма для автовыплаты?',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                stop_income: {
                    subtitle: '',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                txid: {
                    subtitle: '',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                sub: {
                    subtitle: '',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
            {
                delete_acc: {
                    subtitle: 'В целях безопасности нельзя удалить аккаунт вручную. Чтобы удалить аккаунт, нужно связаться со службой поддержки.',
                    list: [],
                    text_list: [],
                    text: [],
                }
            },
        ],

    }
};
