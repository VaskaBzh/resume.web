// If using a module system (e.g. via vue-cli), import Vue and VueI18n and then call Vue.use(VueI18n).
import { createI18n } from "vue-i18n";

// Ready translated locale messages
const messages = {
    en: {
        header: {
            login_button: "Account",
            popups: {
                errors: {
                    link_email_confirm: "Confirm the address.",
                },
                login: {
                    title: "Log into Allbtc account",
                    placeholders: {
                        email: "Please enter the Email",
                        password: "Please enter the password",
                    },
                    swiper: {
                        text: "No account?",
                        link: "Register",
                    },
                    button: "Log in",
                },
                registration_steps: {
                    swiper: {
                        text: "Already have an account?",
                        link: "Log in",
                    },
                    email: {
                        title: "Create account Allbtc",
                        placeholders: {
                            email: "Please enter the email",
                        },
                        button: "Continue",
                    },
                    name: {
                        title: "Create account Allbtc",
                        placeholders: {
                            name: "Please enter the name",
                        },
                        button: "Continue",
                    },
                    password: {
                        title: "Create account Allbtc",
                        placeholders: {
                            password: "Please enter the password",
                            password_confirmation:
                                "Please confirm the password",
                        },
                        button: "Register",
                    },
                },
            },
            menu: {
                title: "Finances and accounts",
                wallets: {
                    all: "Full earn",
                    button: "Earnings",
                },
                accounts_title: "Accounts",
                acc_admin: {
                    title: "Profile management",
                    settings: "Settings",
                    logout: "Exit",
                },
            },
            login: {
                title: "Authorize yourself!",
                hash: "Average hashrate / 1 hour",
                workers: "Number of workers",
                text: "Login or register to start mining!",
                buttons: {
                    login: "Login",
                    step: "or",
                    registration: "Register",
                },
                menu: {
                    add: "Add subaccount",
                    logout: "Log out",
                },
            },
            links: {
                statistic: "Statistics",
                accounts: "Accounts",
                workers: "Workers",
                income: "Earnings",
                connection: "Connection",
                wallets: "Wallets",
                home: "Home",
                own_cabinet: "Profile",
                complexity: "Difficulty",
                hosting: "Hosting services",
            },
        },
        language: {
            ru: "Russian",
            en: "English",
        },
        home: {
            title: "Earn from mining together with allbtc pool",
            text: "High income. Reliability. Efficiency.",
            button: "Start Mining",
            bitcoin_block: {
                network: "Network difficulty",
                next_diff: "Expected next difficulty",
                date_diff: ["Next difficulty date", "Days", "Hours"],
                button: "Start Mining",
            },
            promo_blocks: {
                payment: {
                    title: "Daily payouts",
                    text: "Without a minimum payout requirement, except for ETH and ETC",
                    link: "Start receiving payouts",
                },
                fpps: {
                    title: "FPPS+",
                    text: "The most profitable mining reward method",
                    link: "Learn more",
                },
            },
        },
        hosting: {
            title: "Hosting Management Platform",
            text: "platform is the optimal solution for those who want to <b>increase their profits <br> automate the management of data centers</b>",
            button: "Start Mining",
        },
        hosting_info: {
            cards: [
                {
                    title: "Employee Handbook",
                    img: "hosting_info_img-1.png",
                    text: "Create and control employees' work regulations",
                },
                {
                    title: "ASIC Device Monitoring",
                    img: "hosting_info_img-2.png",
                    text: "Track the operation of all ASIC devices in real time",
                },
                {
                    title: "Mining Hosting Management System",
                    img: "hosting_info_img-3.png",
                    text: "Full control over your ASIC devices",
                },
            ],
        },
        complexity: {
            title: "Network complexity",
            text: "Complexity is adjusted every 2016 blocks (approximately every 2 weeks) to maintain the average time between each block at 10 minutes.",
            blocks: {
                chart_label: "Complexity",
                subtitles: [
                    "Hashrate",
                    "Complexity",
                    "Expected complexity",
                    "Date of next complexity",
                ],
            },
        },
        platform: {
            title: "An all-in-one platform designed to increase miners' earnings",
            blocks: [
                {
                    title: "Security and transparency",
                    text: "The hashrate is displayed in real-time while the Allbtc security team protects your assets.",
                },
                {
                    title: "Stable income",
                    text: "Your go-to guide in the crypto mining universe! Jump into our mining pool and unlock the power of an intuitive platform to steer your assets.",
                },
                {
                    title: "Comprehensive service",
                    text: "Our comprehensive service is designed to boost miners' revenue and ensure a versatile mining ecosystem.",
                },
            ],
        },
        panel: {
            title: "Convenient control panel",
            text: "Your personal assistant in cryptocurrency mining universe! Join our mining pool and get an access to the up to date mining platform for managing your cryptocurrency assets.",
            img: "about-panel-img-en",
        },
        info: {
            title: "Start mining with Allbtc pool",
            link: "Start Mining",
            blocks: [
                {
                    title: "High reliability",
                    text: "Innovative solutions and cutting-edge technologies ensure optimal performance and stability of your equipment.",
                },
                {
                    title: "Frequent and customizable payouts",
                    text: "Take control of every detail of your financial streams with our customizable payout system.",
                },
                {
                    title: "Workers management and monitoring",
                    text: "Explore new horizons of efficiency in managing workflows and monitoring performance.",
                },
                {
                    title: "Constant profit monitoring",
                    text: "We constantly monitor the profit of our users and compare it with the earnings on other pools to ensure competitiveness.",
                },
            ],
        },
        tabs: {
            statistic: "Statistics",
            accounts: "Accounts",
            workers: "Workers",
            income: "Earnings",
            connection: "Connection",
            wallets: "Wallets",
        },
        days: "Days",
        hours: "Hours",
        chart: {
            buttons: {
                day: "24 days",
                week: "7 hours",
            },
            labels: ["Hashrate", "time"],
            hint_label: "Active workers",
        },
        date: {
            label: "Date",
            placeholder: "For all time",
        },
        swiper: {
            or: "of",
        },
        no_info: "No info",
        worker_statuses: {
            all: "All",
            active: "Active",
            inactive: "Inactive",
            unstable: "Unstable",
        },
        statistic: {
            title: "Statistics",
            chart: {
                title: "Hashrate",
                no_workers_title: "Connect to allbtc pool",
            },
            info_blocks: {
                title: "Earnings and payouts",
                payment: {
                    titles: [
                        "Earnings for yesterday",
                        "Projected earnings for today",
                    ],
                },
                hash: {
                    titles: ["Current hashrate", "Avg.hashrate / 24"],
                },
                workers: {
                    title: "Workers",
                    types: ["Active", "Unstable", "Inactive"],
                },
            },
        },
        accounts: {
            title: "Accounts",
            block: {
                titles: [
                    "Avg.hashrate / 1h",
                    "Number of workers",
                    "Projected earnings for today",
                    "Total paid out",
                ],
                workers_status: ["Active", "All"],
                menu: ["Change name", "Linked wallets"],
            },
            popups: {
                add: {
                    title: "Enter the sub-account name",
                    placeholders: {
                        name: "Please enter the name",
                    },
                    button: "+ Add",
                },
                change: {
                    title: "Change the sub-account name",
                    placeholders: {
                        name: "Please enter the name",
                    },
                    button: "Change",
                },
            },
        },
        workers: {
            title: "Workers",
            select_label: "Status",
            select: ["All", "Active", "Inactive"],
            table: {
                thead: [
                    "Worker name",
                    "Current hashrate",
                    "Avg.hashrate / 24",
                    "Failure rate / 24",
                ],
                thead_short: [
                    "Name",
                    "Hashrate",
                    "Avg.hashrate/1d",
                    "Failure/1d",
                ],
                sub_thead: "Total hashrate",
            },
            popups: {
                connection: {
                    title: "Connect to allbtc pool",
                },
                chart: {
                    title: "Hashrate",
                },
            },
        },
        income: {
            title: "Earnings history",
            income_info: {
                title: "Earnings",
                titles: ["Paid", "Unpaid", "Yesterday's income"],
            },
            table: {
                thead: [
                    "Accrual date",
                    "Payout date",
                    "Hashrate",
                    "Accrual amount",
                    "Wallet",
                    "Withdrawal percentage",
                    "Status",
                ],
                thead_short: [
                    "Accrual date",
                    "Payout date",
                    "Hashrate",
                    "Average Hashrate",
                    "Amount of accruals",
                    "Wallet",
                    "Withdrawal percentage",
                    "Status",
                ],
                messages: {
                    sum: "Amount to be paid",
                    no_wallet_txid: "Enter the wallet",
                    no_wallet:
                        "Configure your account for withdrawal (enter the wallet).",
                    less_minWithdrawal: "Insufficient funds for withdrawal.",
                    error: "An error occurred while making the payment.",
                    error_payout: "An error occurred while making the payout.",
                    completed: "Payout successfully completed.",
                },
                status: {
                    pending: "Pending",
                    rejected: "Rejected",
                    fullfill: "Completed",
                },
            },
        },
        connection: {
            title: "Worker connection",
            block: {
                title: "1. Configure your device according to the data provided below:",
            },
        },
        wallets: {
            title: "Your wallets",
            block: {
                title: "Wallets list",
                filter: "Hide with zero balance",
                wallet_block: {
                    menu: ["Change", "Remove"],
                    i_info_titles: [
                        "Withdrawal percentage",
                        "Min withdrawal amount",
                    ],
                },
            },
            popups: {
                add: {
                    title: "Add wallet",
                    placeholders: {
                        wallet: "Please enter the wallet *",
                        name: "Please enter the wallet's name",
                    },
                    labels: {
                        percent: "Percent *",
                        minWithdrawal: "Min. withdrawal *",
                    },
                    button: "+ Add",
                },
                change: {
                    title: "Change wallet",
                    placeholders: {
                        wallet: "Please enter the wallet *",
                        name: "Please enter the name",
                    },
                    labels: {
                        percent: "Percent",
                        minWithdrawal: "Min. withdrawal",
                    },
                    button: "Change",
                },
            },
        },
        settings: {
            title: "Account settings",
            block: {
                titles: ["Personal information", "Security"],
                settings_block: {
                    change_link: "Change",
                    labels: {
                        login: "Login",
                        password: "Password",
                        phone: "Phone number",
                    },
                    phone_message: "Add phone number",
                    popup: {
                        title: "Set a new one",
                        placeholders: {
                            placeholder: "Please enter the ",
                            password_new: "Please enter the password",
                            password_confirmation:
                                "Please confirm the password",
                        },
                        button: "Change",
                    },
                },
            },
        },
        footer: {
            feedback: {
                button: "Feedback",
                popup: {
                    title: "Leave a comment about the pool's performance",
                    placeholders: {
                        contacts: "You can leave your contacts",
                        comment: "Please enter the comment *",
                    },
                    button: "Send",
                },
            },
            confidence: "Privacy policy",
        },
    },
    ru: {
        header: {
            login_button: "Личный кабинет",
            popups: {
                errors: {
                    link_email_confirm: "Подтвердите адрес.",
                },
                login: {
                    title: "Войти в аккаунт Allbtc",
                    placeholders: {
                        email: "Введите ваш Email",
                        password: "Введите пароль",
                    },
                    swiper: {
                        text: "Нет аккаунта?",
                        link: "Зарегистрироваться",
                    },
                    button: "Войти",
                },
                registration_steps: {
                    swiper: {
                        text: "Уже есть аккаунт?",
                        link: "Войти",
                    },
                    email: {
                        title: "Создать аккаунт Allbtc",
                        placeholders: {
                            email: "Введите ваш Email",
                        },
                        button: "Дальше",
                    },
                    name: {
                        title: "Создать аккаунт Allbtc",
                        placeholders: {
                            name: "Введите название аккаунта",
                        },
                        button: "Дальше",
                    },
                    password: {
                        title: "Создать аккаунт Allbtc",
                        placeholders: {
                            password: "Введите пароль",
                            password_confirmation: "Подтвердите пароль",
                        },
                        button: "Зарегистрироваться",
                    },
                },
            },
            menu: {
                title: "Финансы и аккаунты",
                wallets: {
                    all: "Всего",
                    button: "Доходы",
                },
                accounts_title: "Аккаунты",
                acc_admin: {
                    title: "Управление профилем",
                    settings: "Настройки",
                    logout: "Выход",
                },
            },
            login: {
                title: "Авторизируйтесь!",
                hash: "Средний хэшрейт / 1ч",
                workers: "Количество воркеров",
                text: "Войдите или зарегистрируйтесь, чтобы начать майнинг!",
                buttons: {
                    login: "Войти",
                    step: "или",
                    registration: "Регистрация",
                },
                menu: {
                    add: "Добавить субаккаунт",
                    logout: "Выйти",
                },
            },
            links: {
                statistic: "Статистика",
                accounts: "Аккаунты",
                workers: "Воркеры",
                income: "Доходы",
                connection: "Подключение",
                wallets: "Кошельки",
                home: "Главная",
                own_cabinet: "Личный кабинет",
                complexity: "Сложность",
                hosting: "Хостингам",
            },
        },
        language: {
            ru: "Русский",
            en: "Английский",
        },
        home: {
            title: "Зарабатывайте на майнинге вместе с allbtc pool",
            text: "Высокий доход. Надежность. Эффективность.",
            button: "Начать майнинг",
            bitcoin_block: {
                network: "Мощность сети",
                next_diff: "Ожидаемая следующая сложность",
                date_diff: ["Дата следующей сложности", "Дней", "Часов"],
                button: "Начать майнинг",
            },
            promo_blocks: {
                payment: {
                    title: "Ежедневные выплаты",
                    text: "Без минимальной суммы за исключением ETH и ETC",
                    link: "Начать получать выплаты",
                },
                fpps: {
                    title: "FPPS+",
                    text: "Метод вознаграждения за майнинг с наивысшей доходностью",
                    link: "Подробнее",
                },
            },
        },
        hosting: {
            title: "Платформа управления хостингом",
            text: "Наша платформа — это оптимальное решение для тех, кто хочет <b>увеличить свою прибыль <br> и автоматизировать управление дата-центрами</b>",
            button: "Начать майнинг",
        },
        hosting_info: {
            cards: [
                {
                    title: "Регламент для сотрудников",
                    img: "hosting_info_img-1.png",
                    text: "Создавайте и контролируйте регламент работы сотрудников",
                },
                {
                    title: "Отслеживание работы ASIC-устройств",
                    img: "hosting_info_img-2.png",
                    text: "Отслеживайте работу всех  ASIC-устройств в реальном времени",
                },
                {
                    title: "Система управления\n" + "майнинг-хостингом",
                    img: "hosting_info_img-3.png",
                    text: "Полный контроль над вашими \n" + "ASIC-устройствами",
                },
            ],
        },
        complexity: {
            title: "Сложность сети",
            text: "Сложность корректируется каждые 2016 блоков (примерно каждые 2 недели), чтобы среднее время между каждым блоком оставалось в размере 10 минут.",
            blocks: {
                chart_label: "Сложность",
                subtitles: [
                    "Хешрейт",
                    "Сложность",
                    "Ожидаемая сложность",
                    "Дата следующей сложности",
                ],
            },
        },
        platform: {
            title: "Комплексная платформа, предназначенная для повышения доходов майнеров",
            blocks: [
                {
                    title: "Безопасность и прозрачность",
                    text: " Хешрейт отображается в режиме реального времени, пока команда безопасности Allbtc защищает ваши активы ",
                },
                {
                    title: "Стабильный заработок",
                    text: " Ваш персональный помощник в мире майнинга криптовалют! Присоединяйтесь к майнинг-пулу и получите доступ к интуитивно понятной и мощной платформе для управления вашими активами. ",
                },
                {
                    title: " Комплексное обслуживание ",
                    text: " Наше комплексное обслуживание направлено на повышение доходов майнеров, а также обеспечение универсальной экосистемы майнинга. ",
                },
            ],
        },
        panel: {
            title: "Удобная панель управления",
            text: "Ваш персональный помощник в мире майнинга криптовалют! Присоединитесь к майнинг-пулу и получите доступ к интуитивно понятной и мощной платформе для управления вашими активами.\n",
            img: "about-panel-img-ru",
        },
        info: {
            title: "Начните майнинг c allbtc pool",
            link: "Начать майнинг",
            blocks: [
                {
                    title: "Высокая надежность",
                    text: "Инновационные решения и передовые технологии обеспечивают оптимальную производительность и стабильность работы вашего оборудования.",
                },
                {
                    title: "Частые и настраиваемые выплаты",
                    text: "Контролируйте каждую деталь ваших финансовых потоков с помощью нашей настраиваемой системы выплат",
                },
                {
                    title: "Управление воркерами и мониторинг",
                    text: "Откройте новые горизонты эффективности по управлению рабочими процессами и мониторингу производительности.",
                },
                {
                    title: "Постоянный мониторинг прибыли",
                    text: "Мы постоянно мониторим прибыль наших пользователей и сраниваем ее с прибылью на других пулах, чтобы обеспечить конкурентоспособность.",
                },
            ],
        },
        tabs: {
            statistic: "Статистика",
            accounts: "Аккаунты",
            workers: "Воркеры",
            income: "Доходы",
            connection: "Подключение",
            wallets: "Кошельки",
        },
        days: "Дней",
        hours: "Часов",
        chart: {
            buttons: {
                day: "24 часа",
                week: "7 дней",
            },
            labels: ["Хешрейт", "Время"],
            hint_label: "Активные воркеры",
        },
        date: {
            label: "Дата",
            placeholder: "За все время",
        },
        swiper: {
            or: "из",
        },
        no_info: "Нет данных",
        worker_statuses: {
            all: "Все",
            active: "Активные",
            inactive: "Неактивные",
            unstable: "Нестабильные",
        },
        statistic: {
            title: "Статистика",
            chart: {
                title: "Общий хешрейт",
                no_workers_title: "Подключиться к allbtc pool",
            },
            info_blocks: {
                title: "Начисления и выплаты",
                payment: {
                    titles: [
                        "Начисление за вчера",
                        "Прогнозируемое начисление за сегодня",
                    ],
                },
                hash: {
                    titles: ["Текущий хешрейт", "Ср.Хешрейт / 24"],
                },
                workers: {
                    title: "Воркеры",
                    types: ["Активные", "Нестабильные", "Неактивные"],
                },
            },
        },
        accounts: {
            title: "Аккаунты",
            block: {
                titles: [
                    "Ср.хешрейт / 1ч",
                    "Количество воркеров",
                    "Прогнозируемое начисление за сегодня",
                    "Всего выплачено",
                ],
                workers_status: ["Активные", "Все"],
                menu: ["Изменить название", "Привязанные кошельки"],
            },
            popups: {
                add: {
                    title: "Задайте имя субаккаунта",
                    placeholders: {
                        name: "Введите имя",
                    },
                    button: "+ Добавить",
                },
                change: {
                    title: "Измените имя субаккаунта",
                    placeholders: {
                        name: "Введите новое имя",
                    },
                    button: "Изменить",
                },
            },
        },
        workers: {
            title: "Воркеры",
            select_label: "Статус",
            select: ["Все", "Активные", "Неактивные"],
            table: {
                thead: [
                    "Имя воркера",
                    "Текущий",
                    "Ср.хешрейт / 24",
                    "Частота отказов / 24",
                ],
                thead_short: ["Имя", "Текущий", "Ср.хешрейт/1д", "Отказы/1д"],
                sub_thead: "Общий хешрейт",
            },
            popups: {
                connection: {
                    title: "Подключиться к allbtc pool",
                },
                chart: {
                    title: "Хешрейт",
                },
            },
        },
        income: {
            title: "История платежей",
            income_info: {
                title: "Платежи",
                titles: ["Оплачено", "Неоплачено", "Вчерашний доход"],
            },
            table: {
                thead: [
                    "Дата начисления",
                    "Дата вылпаты",
                    "Хешрейт",
                    "Сумма начислений",
                    "Кошелек",
                    "Процент вывода",
                    "Статус",
                ],
                thead_short: [
                    "Дата начисления",
                    "Дата выплаты",
                    "Хешрейт",
                    "Средний Хешрейт",
                    "Сумма начислений",
                    "Кошелек",
                    "Процент вывода",
                    "Статус",
                ],
                messages: {
                    sum: "Сумма к выплате",
                    no_wallet_txid: "Введите кошелек",
                    no_wallet:
                        "Настройте аккаунт для вывода (введите кошелек).",
                    less_minWithdrawal: "Недостаточно средств для вывода",
                    error: "Произошла ошибка при выполнении выплаты.",
                    error_payout: "Произошла ошибка при выполнении выплаты.",
                    completed: "Выплата успешно выполнена.",
                },
                status: {
                    pending: "В ожидании",
                    rejected: "Отклонено",
                    fullfill: "Выполнено",
                },
            },
        },
        connection: {
            title: "Подключение воркера",
            block: {
                title: "1. Настройте ваше устройство согласно представленным ниже данным:",
            },
        },
        wallets: {
            title: "Мои кошельки",
            block: {
                title: "Список кошельков",
                filter: "Скрыть с нулевым балансом",
                wallet_block: {
                    menu: ["Изменить", "Удалить"],
                    i_info_titles: ["Процент вывода", "Мин сумма вывода"],
                },
            },
            popups: {
                add: {
                    title: "Добавить кошелек",
                    placeholders: {
                        wallet: "Введите кошелек *",
                        name: "Введите имя кошелька",
                    },
                    labels: {
                        percent: "Процент *",
                        minWithdrawal: "Мин. вывод *",
                    },
                    button: "+ Добавить",
                },
                change: {
                    title: "Измените кошелек",
                    placeholders: {
                        wallet: "Введите кошелек *",
                        name: "Введите имя",
                    },
                    labels: {
                        percent: "Процент *",
                        minWithdrawal: "Мин. вывод *",
                    },
                    button: "Изменить",
                },
            },
        },
        settings: {
            title: "Настройки аккаунта",
            block: {
                titles: ["Персональные данные", "Безопасность"],
                settings_block: {
                    change_link: "Изменить",
                    labels: {
                        login: "Логин",
                        password: "Пароль",
                        phone: "Телефон",
                    },
                    phone_message: "Добавьте телефон",
                    popup: {
                        title: "Задайте новый",
                        placeholders: {
                            placeholder: "Введите",
                            password_new: "Введите новый пароль",
                            password_confirmation: "Подтвердите пароль",
                        },
                        button: "Изменить",
                    },
                },
            },
        },
        footer: {
            feedback: {
                button: "Обратная связь",
                popup: {
                    title: "Оставьте комментарий по работе пула",
                    placeholders: {
                        contacts: "Можете оставить свои контакты",
                        comment: "Ваш комментарий *",
                    },
                    button: "Отправить",
                },
            },
            confidence: "Конфиденциальность",
        },
    },
};

// Create VueI18n instance with options
export const i18n = createI18n({
    legacy: false, // you must specify 'legacy: false' option
    locale: "en", // set locale
    messages, // set locale messages
});
