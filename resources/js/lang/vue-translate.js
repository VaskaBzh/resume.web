// If using a module system (e.g. via vue-cli), import Vue and VueI18n and then call Vue.use(VueI18n).
import { createI18n } from "vue-i18n";

// Ready translated locale messages
const messages = {
    en: {
        more: "More",
        auth: {
            error: "",
            login: {
                head: "Log in",
                title: "Log into Allbtc account",
                placeholders: ["Enter e-mail", "Enter password"],
                checkbox: "Remember me",
                button: "Log in",
                reset: "Forgot password?",
                link: ["Don't have an account?", "Sign up"],
            },
            reg: {
                head: "Registration",
                title: "Create Allbtc account",
                placeholders: [
                    "Enter e-mail",
                    "Enter username",
                    "Enter password",
                    "Confirm password",
                    "Ref. code (optional)",
                ],
                checkbox: ["I agree to the terms of", "Privacy Policy"],
                validate: [
                    "Length from 10 to 50 characters",
                    "The password must include:",
                    "Lowercase letter (a-z)",
                    "Uppercase letter (A-Z)",
                    "Special character (!, ?, %, $, etc.)",
                    "Digit (0-9)",
                ],
                button: "Sign up",
                link: ["Already have an account?", "Log in"],
            },
        },
        back: "Back",
        tooltip: {
            hash: "Hashrate",
            difficulty: "Difficulty",
            rejected: "Rejected",
            workers: "Active workers",
        },
        header: {
            login_button: "Account",
            user_title: "Subaccount",
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
                            password: "Please enter the ",
                            password_confirmation: "Please confirm the ",
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
                accounts_title: "Subaccounts",
                acc_admin: {
                    title: "Profile management",
                    add: "Add a subaccount",
                    settings: "Settings",
                    logout: "Exit",
                },
            },
            login: {
                title: "Authorize yourself!",
                hash: "Average hashrate / 1 hour",
                workers: "Worker",
                text: "Login or register to start mining!",
                buttons: {
                    login: "Login",
                    registration: "Register",
                },
                menu: {
                    add: "Add subaccount",
                    logout: "Log out",
                },
            },
            links: {
                statistic: "Statistics",
                accounts: "Subaccounts",
                workers: "Worker",
                income: "Earnings",
                connecting: "Connection",
                wallets: "Wallets",
                home: "Home",
                own_cabinet: "Profile",
                complexity: "Difficulty",
                hosting: "Hosting services",
                settings: "Settings",
                referral: "Ref. cabinet",
                buttons: {
                    add: "Add a subaccount",
                    leave: "Exit",
                },
            },
        },
        language: {
            ru: "Russian",
            en: "English",
        },
        home: {
            title: "Earn from mining together with allbtc pool",
            calculator: {
                title: "Calculator",
                text: "The mining profitability calculator will help you find out how much income the equipment will bring, taking into account the cost of electricity.",
                placeholder: [
                    "Your hashrate",
                    "Number of workers",
                    "Power",
                    "Costs",
                ],
                img_title: ["Income", "Expenses"],
                button: "Calculate",
                notification_calc: "Fill in the field",
            },
            text: ["High income.", "Reliability.", "Efficiency."],
            button: "Start Mining",
            bitcoin_block: {
                network: "Network difficulty",
                next_diff: "Expected next difficulty",
                date_diff: [
                    "Next difficulty date",
                    "Days",
                    "Days",
                    "Days",
                    "Hours",
                    "Hours",
                    "Hours",
                ],
                button: "Start Mining",
            },
            promo_blocks: {
                payment: {
                    title: "Daily payouts",
                    text: "Optimize your earnings with a reliable payout system for stable income.",
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
            text: "Our platform is the perfect solution for <b>those <b>looking <br> to boost their profits and automate data center management.</b>",
            button: "Start Mining",
            get_block: {
                title: "Open the door to a world of VIP conditions.",
                text: "We pride ourselves on providing a personalized approach to each client, delivering high profitability <br> and custom-tailored support. Experience a new level of mining with privileges crafted specifically for you.",
                button: "Contact a Manager",
            },
            profit: {
                title: "Maximize Profit with Our Platform",
                text: "Exceed your profit expectations with our advanced hosting management platform for mining equipment. Start using it today and experience how your profit grows while worries and risks decrease. With us, you can achieve maximum returns from your equipment and enhance the efficiency of your business.",
            },
            control: {
                title: "Flawless real-time revenue control throughout",
                spans: ["the day", "and", "night"],
            },
            interface: {
                title: "Intuitive Interface for Easy Management",
                text: "We have developed a user-friendly and intuitive interface that enables...",
                list: [
                    "<b>Manage device parameters</b> – restart the device and start/stop mining.",
                    "<b>Instant Performance System Notifications</b> via Telegram",
                    "<b>Track Mining</b> Equipment Status",
                    "<b>Convenient Pool Monitoring</b> – the process of overseeing all client equipment connected to the pool.",
                ],
            },
            security: {
                title: "Ensure Stability and Security of Data Centers",
                text: "We provide you with a set of tools that allow for quick identification and resolution of any issues, minimizing risks and enhancing the reliability of your equipment's performance.",
                button: "Start Mining",
            },
            eff: {
                title: "Increase the Efficiency of Your Resources",
                text: "Our platform empowers you with unparalleled flexibility and efficiency in effectively leveraging your valuable resources. We assist you in making well-informed decisions regarding resource distribution, ensuring the optimal utilization of every single device in your arsenal.",
            },
            consultation: {
                title: "Get Consultation",
                text: "on Maximizing Data Center Management Efficiency with Our Hosting Management Platform",
                button: "Call Me",
            },
        },
        hosting_info: {
            cards: [
                {
                    title: "Employee Handbook",
                    img: "hosting_info_img-1.webp",
                    text: "Create and control employees' work regulations",
                },
                {
                    title: "ASIC Device Monitoring",
                    img: "hosting_info_img-2.webp",
                    text: "Track the operation of all ASIC devices in real time",
                },
                {
                    title: "Mining Hosting Management System",
                    img: "hosting_info_img-3.webp",
                    text: "Full control over your ASIC devices",
                },
            ],
        },
        faq: [
            {
                title: "How to Start Mining on Allbtc Pool",
                description: "Find answers to your most pressing questions.",
                list: {
                    0: {
                        title: "What is Allbtc Pool?",
                        text: `Allbtc Pool is a mining pool that provides the opportunity to mine various cryptocurrencies collectively with other miners. The mining pool combines the computational resources of miners, allowing them to increase their chances of finding a block and receiving a reward. <br> <br>

                                                Miners who join Allbtc Pool can utilize their mining devices to connect to the pool and participate in collective computations. When the pool finds a block, the reward is distributed among all miners based on their contribution to the mining operation. <br> <br>

                                                Allbtc Pool offers a variety of cryptocurrencies for mining, providing miners with choice and the ability to diversify their mining operations. We also ensure pool stability, account security, and fair distribution of rewards among participants. <br> <br>

                                                Join Allbtc Pool today and start mining cryptocurrencies with us!
                                                `,
                    },
                    1: {
                        title: "How Do Payouts Work in Allbtc Pool?",
                        text: `Allbtc Pool utilizes the FPPS+ (Full Pay Per Share Plus) payout scheme. With FPPS+, each submitted share is instantly rewarded, providing a predictable payout for miners regardless of whether a block is found or not. The payout is calculated based on the contributed shares and the current block reward. Payouts occur automatically and are typically processed every few hours.`,
                    },
                    2: {
                        title: "What is Staking?",
                        text: `Staking in mining refers to the holding of a certain amount of cryptocurrency in a miner's account or in a pool. It may be necessary to ensure network stability, protection against malicious actions, or participation in Proof of Stake (PoS) or Proof of Importance (PoI) protocols, where staking coins in the account increases the probability of finding the next block and receiving rewards. Staking plays an important role in the stability and efficiency of cryptocurrency mining.`,
                    },
                    3: {
                        title: "What is the Difference Between Actual Hashrate and Reported Hashrate?",
                        text: `Actual hashrate refers to the real computational speed achieved by mining equipment during the cryptocurrency mining process. It is measured in hashes per second (H/s), kilohashes per second (kH/s), megahashes per second (MH/s), gigahashes per second (GH/s), terahashes per second (TH/s), and so on. <br> <br>

                                                Reported hashrate, on the other hand, is the value stated by the manufacturer of the mining equipment in its specifications or promotional materials. It usually represents the maximum possible computational speed the equipment can achieve under ideal conditions. <br> <br>

                                                The difference between actual and reported hashrate can be attributed to several factors. Firstly, real mining conditions may differ from ideal conditions, impacting the equipment's performance. Secondly, the actual efficiency of the mining equipment may be lower than the stated efficiency. Finally, issues with power, cooling, or software can also affect the actual hashrate. <br> <br>

                                                It is important to understand that the actual hashrate may differ from the reported hashrate, and this is a normal occurrence. When planning mining operations, it is advisable to consider the actual hashrate to have more realistic expectations from cryptocurrency mining.
                                                `,
                    },
                },
            },
            {
                title: "Account Security",
                list: {
                    0: {
                        title: "How to Secure Your Account in Allbtc Pool?",
                        text: `Ensuring the security of your account in Allbtc Pool is an important aspect of protecting your funds and data. Here are some recommendations to secure your account:
                                            <ul class="list"><li class="list_item">Strong Password: Use a unique password consisting of a combination of letters, numbers, and special characters. Avoid using easily guessable passwords and reusing passwords on other platforms.</li>
                                            <li class="list_item">Two-Factor Authentication (2FA): Enable 2FA for an additional layer of protection. This verifies your identity with an additional code or app, in addition to your password.</li>
                                            <li class="list_item">Caution with Public Wi-Fi: Avoid using public Wi-Fi networks to access your account. Such networks may be insecure, and your data could be compromised.</li>
                                            <li class="list_item">Keep Software Updated: Regularly update the software on your device, including the operating system, antivirus programs, and other security-related software.</li>
                                            <li class="list_item">Beware of Phishing Attacks: Be cautious of suspicious emails, messages, or websites that may attempt to obtain your credentials. Never provide your passwords or sensitive information through unverified sources.</li>
                                            <li class="list_item">Monitor Account Activity: Regularly check your account activity to spot any suspicious actions. If you notice any unusual activity, contact the Allbtc Pool support team immediately.</li></ul>
                                            Remember, securing your account is a shared responsibility. Follow good security practices and stay vigilant to secure your account in Allbtc Pool.
                                            `,
                    },
                    1: {
                        title: "How to Secure Your Wallet?",
                        text: `Protecting your wallet is a crucial aspect of cryptocurrency security. Here are a few simple steps to help secure your wallet:
                                            <ul class="list"><li class="list_item">Backup Your Wallet: Regularly create backups of your wallet and store them in a secure location. This will help restore access to your funds in case of wallet loss or damage.</li>
                                            <li class="list_item">Strong Password: Set a strong password for your wallet. Use a complex combination of letters, numbers, and special characters to ensure a high level of security.</li>
                                            <li class="list_item">Keep Software Updated: Regularly update your wallet software to the latest version. Updates often include vulnerability fixes and security improvements.</li>
                                            <li class="list_item">Two-Factor Authentication (2FA): Enable 2FA for an additional layer of wallet protection. This will provide an extra verification step for your identity during each wallet login.</li>
                                            <li class="list_item">Internet Safety: Exercise caution when interacting with online resources related to your wallet. Avoid clicking on suspicious links or downloading files from untrusted sources.</li>
                                            <li class="list_item">Physical Security: Protect your wallet from physical access by storing it in a secure location, such as a safe or a secure data carrier.</li></ul>
                                            By following these recommendations, you can help secure your wallet and safeguard your cryptocurrency funds.
                                            `,
                    },
                    2: {
                        title: "How to Protect Yourself Against Fraud?",
                        text: `To protect yourself against fraud, it is recommended to take the following measures:
                                            <ul class="list"><li class="list_item">Exercise caution when providing personal information online, especially to unverified sources.</li>
                                            <li class="list_item">Do not disclose passwords or other confidential information to third parties.</li>
                                            <li class="list_item">Use secure payment systems and services for financial transactions.
                                            <li class="list_item">Verify links and websites carefully before entering personal information or making payments.</li>
                                            <li class="list_item">Regularly review your banking and financial statements for any suspicious activity.</li>
                                            <li class="list_item">If you encounter suspicious or unsolicited messages, contact a trusted support source for additional information.</li>
                                            <li class="list_item">Keep your devices' software updated to address potential vulnerabilities that could be exploited by fraudsters.</li>
                                            <li class="list_item">Be cautious when making online purchases and check the reputation of the seller or website before making a payment.</li></ul>
                                            Be vigilant and follow basic security practices to protect yourself against fraud and ensure the security of your financial transactions.
                                            `,
                    },
                },
            },
            // <a href="https://t.me/allbtc_support">
            {
                title: "Technical support and contact us.",
                list: {
                    0: {
                        title: "How to Contact Our Technical Support?",
                        text: `If you have any questions or issues, our technical support team is ready to assist you. To get in touch with us, you can use the following methods:
                                            <ul class="list"><li class="list_item">Email: Send us an email at mail We will strive to respond to you as soon as possible.</li>
                                            <li class="list_item">Website Chat: Visit our website and use the live chat feature to communicate with our support team in real-time.</li>
                                            <li class="list_item">Telegram: Add us on Telegram via the link telegram for quick communication and prompt support.</li>
                                            <li class="list_item">Feedback Form: On our website, you can fill out a feedback form, providing your name, email address, and message. We will get back to you promptly.</li></ul>
                                            Feel free to reach out to us with any questions or concerns. We are here to help and provide quality technical support.
                                            `,
                    },
                    1: {
                        title: "How Quickly Can I Expect a Response from Our Support Team?",
                        text: `We strive to provide prompt and efficient responses to our customers from our support team. The response time may vary depending on the current workload and the complexity of the inquiry. However, typically, we aim to respond to inquiries within 24 hours. <br> <br>

                                We make every effort to deliver timely and quality service to our customers. If you have an urgent question or issue, we recommend utilizing our live chat or phone support to receive a quicker response from our support team. <br> <br>

                                We appreciate your patience and cooperation and are committed to providing you with top-notch support in a timely manner.`,
                    },
                    2: {
                        title: "What Recommendations Do You Provide for Quick and Effective Problem Resolution?",
                        text: `To achieve quick and effective problem resolution, we recommend following these recommendations:
                                            <ul class="list"><li class="list_item">Provide Detailed Problem Description: When reaching out to technical support, provide a detailed description of the problem. Include all relevant details, mention the steps leading up to the issue, and any error messages encountered. This will help us better understand the nature of the problem and provide the best possible solution.</li>
                                            <li class="list_item">Check Resource Availability: Ensure that all necessary resources, such as internet connectivity, power, and mining equipment, are functioning properly. Sometimes, issues may be related to external factors, and verifying these can help eliminate such problems.</li>
                                            <li class="list_item">Utilize Guides and Documentation: Make use of our user guides, FAQs, and other documentation provided. They contain helpful instructions and answers to frequently asked questions that may assist you in resolving some issues on your own.</li>
                                            <li class="list_item">Reach Out to Technical Support: If you're unable to resolve the problem on your own, reach out to our technical support. We are ready to assist you, perform additional checks, and provide the best possible solution to the problem.</li></ul>
                                            We are committed to providing you with quick and effective problem resolution. By following these recommendations, you increase the chances of successful issue resolution and minimize downtime.
                                            `,
                    },
                },
            },
        ],
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
                    text: "Using the FPPS, PPS+, PPS and instantaneous calculations, you can avoid fluctuations in earnings",
                },
                {
                    title: "Comprehensive service",
                    text: "Service aims to reduce the gap between mining and trading",
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
                    title: "Worker management and monitoring",
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
            accounts: "Subaccounts",
            workers: "Worker",
            income: "Earnings",
            connecting: "Connection",
            watchers: "Watchers",
            wallets: "Wallets",
            referral: "Ref. cabinet",
            account: "Account",
            faq: "FAQ",
            support: "Support",

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
            checkbox: "Statistic of all accounts",
            chart: {
                title: "Hashrate",
                no_workers_title: "Connect to allbtc pool",
            },
            info_blocks: {
                title: "Earnings",
                title_clear: "Net income",
                text_clear:
                    "Specify the cost of electricity to calculate net income.",
                button_clear: "Specify",
                payment: {
                    titles: ["Yesterday", "Projected for today"],
                },
                clear: {
                    titles: ["Today", "For month"],
                },
                hash: {
                    titles: ["Current hashrate", "Avg.hashrate / 24"],
                },
                hashrate: {
                    title: "Total hash rate",
                },
                workers: {
                    title: "Worker",
                    types: ["Active", "Unstable", "Inactive"],
                },
            },
        },
        accounts: {
            title: "Subaccounts",
            toggle: ["Active", "Toggle"],
            block: {
                titles: [
                    "Avg.hashrate / 1h",
                    "Worker",
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
            title: "Worker",
            select_label: "Status",
            select: ["All", "Active", "Inactive"],
            statuses: ["Active", "Unstable", "Inactive"],
            table: {
                thead: [
                    "Worker name",
                    "Current hashrate",
                    "Hashrate/1h",
                    "Hashrate/24h",
                    "Failure rate/24h",
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
            types: ["Ref. Income", "Mining"],
            title: "Income",
            income_info: {
                title: "Earnings",
                titles: ["Paid", "Unpaid", "Yesterday's income"],
            },
            table: {
                title: "Transaction history",
                tabs: ["Accruals", "Payouts"],
                thead: [
                    "Type of operation",
                    "Accrual date",
                    "Payout date",
                    "Hashrate",
                    "Accruals",
                    "Payments",
                    "TxID",
                    "Wallet address",
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
            title: "Pool URLs",
            note: "If connected correctly, the device will appear in 1-10 minutes",
            block: {
                title: "Configure your device according to the data provided below:",
            },
        },
        wallets: {
            title:[ "Setting up auto payout", "Wallets"],
            no_info: "Add Wallet",
            messages: ["Wait 5 seconds.", "You can delete your wallet through tech support."],
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
                note: "After adding a wallet, the address cannot be changed",
                add: {
                    title: "Add wallet",
                    placeholders: {
                        wallet: "Wallet address",
                        name: "Wallet label",
                    },
                    labels: {
                        percent: "Percent *",
                        minWithdrawal: "Minimum withdrawal",
                    },
                    button: "Add",
                },
                change: {
                    title: "Change label",
                    placeholders: {
                        wallet: "Please enter the wallet *",
                        name: "Please enter the name",
                    },
                    labels: {
                        percent: "Percent",
                        minWithdrawal: "Minimum withdrawal",
                    },
                    button: "Save",
                },
                remove:{
                    title: "Delete wallet",
                    note: "Are you sure you want to delete your wallet?",
                    button: ["Cancel", "Delete"]
                }
            },
        },
        settings: {
            title: "Account settings",
            block: {
                titles: ["Personal information", "Security"],
                settings_block: {
                    change_link: "Change",
                    income: {
                        title: "Net Income Calculation",
                        text: "Enter the cost of electricity for the month",
                        button: "Change",
                    },
                    labels: {
                        login: "Login",
                        email: "Email",
                        password: "Password",
                        phone: "Phone number",
                    },
                    phone_message: "Add phone number",
                    popup: {
                        title: "Set a new one",
                        title_email: "Set a new one",
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
        more: "Подробнее",
        auth: {
            login: {
                head: "Вход",
                title: "Войти в аккаунт Allbtc",
                placeholders: ["Введите e-mail", "Введите пароль"],
                checkbox: "Запомнить меня",
                button: "Войти",
                reset: "Забыли пароль?",
                link: ["Нет аккаунта?", "Зарегистрироваться"],
            },
            reg: {
                head: "Регистрация",
                title: "Создать аккаунт Allbtc",
                placeholders: [
                    "Введите e-mail",
                    "Введите имя пользователя",
                    "Введите пароль",
                    "Введите пароль",
                    "Реф. код (не обязательно)",
                ],
                checkbox: [
                    "Я согласен с условиями",
                    "Политики Конфиденциальности",
                ],
                validate: [
                    "Длина от 10 до 50 символов",
                    "Пароль должен включать:",
                    "Строчную букву (a-z)",
                    "Заглавную букву (A-Z)",
                    "Спецсимвол (!, ?, %, $ и др.)",
                    "Цифру (0-9)",
                ],
                button: "Зарегистрироваться",
                link: ["Уже есть аккаунт?", "Войти"],
            },
        },
        back: "Назад",
        tooltip: {
            hash: "Хешрейт",
            difficulty: "Сложность",
            rejected: "Отклоненный",
            workers: "Активные воркеры",
        },
        header: {
            login_button: "Личный кабинет",
            user_title: "Субаккаунт",
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
                accounts_title: "Субаккаунты",
                acc_admin: {
                    title: "Управление профилем",
                    add: "Добавить субаккаунт",
                    settings: "Настройки",
                    logout: "Выход",
                },
            },
            login: {
                title: "Авторизируйтесь!",
                hash: "Средний хэшрейт / 1ч",
                workers: "Воркеры",
                text: "Войдите или зарегистрируйтесь, чтобы начать майнинг!",
                buttons: {
                    login: "Войти",
                    registration: "Зарегистрироваться",
                },
                menu: {
                    add: "Добавить субаккаунт",
                    logout: "Выйти",
                },
            },
            links: {
                statistic: "Статистика",
                accounts: "Субаккаунты",
                workers: "Воркеры",
                income: "Доходы",
                connecting: "Подключение",
                wallets: "Кошельки",
                home: "Главная",
                own_cabinet: "Личный кабинет",
                complexity: "Сложность",
                hosting: "Хостингам",
                settings: "Настройки",
                referral: "Реф. кабинет",
                buttons: {
                    add: "Добавить сабаккаунт",
                    leave: "Выйти",
                },
            },
        },
        language: {
            ru: "Русский",
            en: "Английский",
        },
        home: {
            title: "Зарабатывайте на майнинге вместе с allbtc pool",
            calculator: {
                title: "Калькулятор",
                text: "Калькулятор доходности майнинга поможет узнать какой доход принесет оборудование с учетом затрат на электроэнергию.",
                placeholder: [
                    "Ваш хэшрейт",
                    "Кол-во воркеров",
                    "Мощность",
                    "Затраты",
                ],
                img_title: ["Доход", "Расходы"],
                button: "Рассчитать",
                notification_calc: "Заполните поле",
            },
            text: ["Высокий доход.", "Надежность.", "Эффективность."],
            button: "Начать майнинг",
            bitcoin_block: {
                network: "Мощность сети",
                next_diff: "Ожидаемая следующая сложность",
                date_diff: [
                    "Дата следующей сложности",
                    "День",
                    "Дня",
                    "Дней",
                    "Час",
                    "Часа",
                    "Часов",
                ],
                button: "Начать майнинг",
            },
            promo_blocks: {
                payment: {
                    title: "Ежедневные выплаты",
                    text: "Оптимизируйте свои доходы с помощью стабильной системы выплат ",
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
            get_block: {
                title: "Откройте дверь в мир VIP-условий",
                text: "Мы гордимся индивидуальным подходом к каждому клиенту, предоставляя высокую доходность <br> и персонализированное сопровождение.  Новый уровень майнинга с привилегиями, созданными специально для вас.",
                button: "Связаться с менеджером",
            },
            profit: {
                title: "Максимизация прибыли \n" + "с нашей платформой",
                text: "Превзойдите свои ожидания по доходности благодаря нашей высокотехнологичной платформе управления хостингом для майнингового оборудования. Начните воспользоваться ею уже сегодня и ощутите, как ваша прибыль растёт, а заботы и риски снижаются. С нами вы сможете добиться максимальной отдачи от вашего оборудования и повысить эффективность вашего бизнеса.",
            },
            control: {
                title:
                    "Безупречный контроль доходов \n" +
                    "в реальном времени в течении ",
                spans: ["дня", "и", "ночи"],
            },
            interface: {
                title: "Интуитивный интерфейс \n" + "для простого управления",
                text: "Мы разработали удобный и простой интерфейс, который позволяет",
                list: [
                    "<b>Управлять параметрами устройства</b> – перезапускать устройство и останавливать/запускать майнинг",
                    "<b>Моментальные уведомления</b> о производительности  системы в Telegram",
                    "<b>Отслеживать состояние</b> оборудования для майнинга ",
                    "<b>Удобный мониторинг пула</b> – процесс контроля всего оборудования клиентов, подключенного к пулу",
                ],
            },
            security: {
                title: "Обеспечивайте стабильность и безопасность дата-центров",
                text:
                    " Мы предоставляем вам набор инструментов, которые позволяют быстро выявлять и устранять любые проблемы\n" +
                    "что минимизирует риски и повышает надежность работы вашего оборудования",
                button: "Начать майнинг",
            },
            eff: {
                title: "Увеличивайте эффективность\n" + "ваших ресурсов",
                text: "Наша платформа  обеспечивает вам максимальную гибкость и эффективность в использовании ваших ресурсов. Мы помогаем вам принимать обоснованные решения о распределении ресурсов, обеспечивая оптимальное использование каждого устройства.",
            },
            consultation: {
                title: "Получите консультацию ",
                text: "о том, как эффективно управлять дата-центрами с помощью нашей платформы управления хостингом",
                button: "Перезвоните мне",
            },
        },
        hosting_info: {
            cards: [
                {
                    title: "Регламент для сотрудников",
                    img: "hosting_info_img-1.webp",
                    text: "Создавайте и контролируйте регламент работы сотрудников",
                },
                {
                    title: "Отслеживание работы ASIC-устройств",
                    img: "hosting_info_img-2.webp",
                    text: "Отслеживайте работу всех  ASIC-устройств в реальном времени",
                },
                {
                    title: "Система управления\n" + "майнинг-хостингом",
                    img: "hosting_info_img-3.webp",
                    text: "Полный контроль над вашими \n" + "ASIC-устройствами",
                },
            ],
        },
        faq: [
            {
                title: "Как начать майнить на Allbtc Pool",
                description: "Найдите ответы на самые волнующие вас вопросы.",
                list: {
                    0: {
                        title: "Что такое Allbtc Pool?",
                        text: `Allbtc Pool - это майнинг-пул, который предоставляет возможность майнить различные криптовалюты совместно с другими майнерами. Майнинг-пул объединяет вычислительные ресурсы майнеров, позволяя им увеличить шансы на нахождение блока и получение награды. <br> <br>

                                                Майнеры, присоединившиеся к Allbtc Pool, могут использовать свои майнинговые устройства для подключения к пулу и совместного выполнения вычислений. Когда пул находит блок, награда делится между всеми майнерами, учитывая их вклад в майнинговую операцию. <br> <br>

                                                Allbtc Pool предлагает различные криптовалюты для майнинга, обеспечивая майнерам выбор и возможность диверсификации их майнинговых операций. Мы также обеспечиваем стабильность работы пула, безопасность аккаунтов и честное распределение награды между участниками. <br> <br>

                                                Присоединяйтесь к Allbtc Pool уже сегодня и начните майнить криптовалюты вместе с нами!
                                                `,
                    },
                    1: {
                        title: "Как работают выплаты в allbtc pool?",
                        text: `Allbtc Pool использует схему выплаты FPPS+ (Full Pay Per Share Plus). С FPPS+ каждый представленный шар мгновенно вознаграждается, что обеспечивает предсказуемую выплату майнерам независимо от того, был найден блок или нет. Расчет выплаты основан на предоставленных шарах и текущей награде за блок. Выплаты происходят автоматически и обычно обрабатываются каждые несколько часов.`,
                    },
                    2: {
                        title: "Что такое фиксация?",
                        text: `Фиксация в майнинге означает удержание определенной суммы криптовалюты на счете майнера или в пуле. Это может быть необходимо для обеспечения стабильности сети, защиты от вредоносных действий или участия в протоколах Proof of Stake (PoS) или Proof of Importance (PoI), где фиксация монет на счете повышает вероятность нахождения следующего блока и получения вознаграждения. Фиксация играет важную роль в стабильности и эффективности майнинга криптовалют.`,
                    },
                    3: {
                        title: "Чем отличается фактический хэшрейт от заявленного?",
                        text: `Фактический хэшрейт - это реальная скорость вычислений, которую достигает майнинговое оборудование в процессе майнинга криптовалюты. Он измеряется в хэшах в секунду (H/s), килохэшах в секунду (kH/s), мегахэшах в секунду (MH/s), гигахэшах в секунду (GH/s), террахэшах в секунду (TH/s) и т. д. <br> <br>

                                                Заявленный хэшрейт - это значение, указанное производителем майнингового оборудования в его спецификациях или рекламных материалах. Он обычно является максимально возможной скоростью вычислений, которую может достичь оборудование в идеальных условиях. <br> <br>

                                                Отличие между фактическим и заявленным хэшрейтом может быть вызвано несколькими факторами. Во-первых, реальные условия майнинга могут отличаться от идеальных, что влияет на производительность оборудования. Вторым фактором является степень эффективности майнингового оборудования, которая может быть ниже заявленной. Наконец, наличие проблем с питанием, охлаждением или программным обеспечением также может влиять на фактический хэшрейт. <br> <br>

                                                Важно понимать, что фактический хэшрейт может отличаться от заявленного, и это нормальное явление. При планировании майнинговых операций рекомендуется учитывать фактический хэшрейт, чтобы получить более реалистичные ожидания от майнинга криптовалюты.
                                                `,
                    },
                },
            },
            {
                title: "Безопасность аккаунта",
                list: {
                    0: {
                        title: "Как обезопасить свой аккаунт в Allbtc Pool?",
                        text: `Как обезопасить свой аккаунт в Allbtc Pool?
                                            Обеспечение безопасности аккаунта в Allbtc Pool является важным аспектом защиты ваших средств и данных. Вот несколько рекомендаций, как обеспечить безопасность вашего аккаунта:
                                            <ul class="list"><li class="list_item">Сильный пароль: Используйте уникальный пароль, состоящий из комбинации букв, цифр и специальных символов. Избегайте использования легко угадываемых паролей и повторного использования пароля на других платформах.</li>
                                            <li class="list_item">Двухфакторная аутентификация (2FA): Включите 2FA для дополнительного слоя защиты. Это позволяет проверить вашу личность с помощью дополнительного кода или приложения, помимо пароля.</li>
                                            <li class="list_item">Аккуратность при публичном Wi-Fi: Избегайте использования общедоступных Wi-Fi сетей для доступа к своему аккаунту. Такие сети могут быть небезопасными и ваши данные могут быть украдены.</li>
                                            <li class="list_item">Обновление программного обеспечения: Регулярно обновляйте программное обеспечение на вашем устройстве, включая операционную систему, антивирусные программы и другие программы, связанные с безопасностью.</li>
                                            <li class="list_item">Осторожность с фишинговыми атаками: Будьте внимательны к подозрительным электронным письмам, сообщениям или веб-сайтам, которые могут пытаться получить ваши учетные данные. Никогда не предоставляйте свои пароли или чувствительную информацию по непроверенным источникам.</li>
                                            <li class="list_item">Мониторинг активности аккаунта: Регулярно проверяйте свою активность аккаунта, чтобы заметить любые подозрительные действия. Если вы заметите необычную активность, немедленно свяжитесь с командой поддержки Allbtc Pool.</li></ul>
                                            Помните, что безопасность аккаунта - это общая ответственность. Следуйте хорошим практикам безопасности и будьте бдительны, чтобы обезопасить свой аккаунт в Allbtc Pool.
                                            `,
                    },
                    1: {
                        title: "Как защитить свой кошелек?",
                        text: `Защита вашего кошелька является ключевым аспектом безопасности в мире криптовалют. Вот несколько простых шагов, которые помогут обеспечить безопасность вашего кошелька:
                                            <ul class="list"><li class="list_item">Резервное копирование кошелька: Регулярно создавайте резервные копии своего кошелька и храните их в надежном и защищенном месте. Это поможет восстановить доступ к вашим средствам в случае потери или повреждения кошелька.</li>
                                            <li class="list_item">Сильный пароль: Установите надежный пароль для доступа к своему кошельку. Используйте сложную комбинацию букв, цифр и специальных символов, чтобы обеспечить высокий уровень защиты.</li>
                                            <li class="list_item">Обновление программного обеспечения: Регулярно обновляйте программное обеспечение вашего кошелька до последней версии. Обновления часто включают исправления уязвимостей и улучшения безопасности.</li>
                                            <li class="list_item">Двухфакторная аутентификация (2FA): Активируйте 2FA для дополнительного слоя защиты вашего кошелька. Это обеспечит дополнительную проверку вашей личности при каждом входе в кошелек.</li>
                                            <li class="list_item">Осторожность в сети: Будьте внимательны при взаимодействии с онлайн-ресурсами, связанными с вашим кошельком. Избегайте нажатия на подозрительные ссылки или скачивания файлов с ненадежных источников.</li>
                                            <li class="list_item">Физическая безопасность: Защитите свой кошелек от физического доступа, храня его в надежном месте, например, в сейфе или на защищенном носителе данных.</li></ul>
                                            Соблюдение этих рекомендаций поможет вам обеспечить безопасность вашего кошелька и защитить ваши криптовалютные средства.
                                            `,
                    },
                    2: {
                        title: "Как защититься от фрода?",
                        text: `Чтобы защитить себя от фрода, рекомендуется принимать следующие меры:
                                            <ul class="list"><li class="list_item">Будьте осторожны при предоставлении личной информации онлайн, особенно в непроверенных источниках.</li>
                                            <li class="list_item">Не раскрывайте пароли или другую конфиденциальную информацию третьим лицам.</li>
                                            <li class="list_item">Используйте надежные платежные системы и сервисы для совершения финансовых операций.</li>
                                            <li class="list_item">Внимательно проверяйте ссылки и веб-сайты, прежде чем вводить личные данные или осуществлять платежи.</li>
                                            <li class="list_item">Регулярно проверяйте свои банковские и финансовые отчеты на наличие подозрительной активности.</li>
                                            <li class="list_item">Если вы столкнулись с подозрительными или незапрашиваемыми сообщениями, свяжитесь с надежным источником поддержки для получения дополнительной информации.</li>
                                            <li class="list_item">Обновляйте программное обеспечение на своих устройствах, чтобы исправить возможные уязвимости, которые могут быть использованы мошенниками.</li>
                                            <li class="list_item">Будьте осторожны при совершении онлайн-покупок и проверяйте репутацию продавца или веб-сайта перед совершением платежа.</li></ul>
                                            Будьте бдительны и следуйте основным правилам безопасности, чтобы защитить себя от фрода и обеспечить безопасность ваших финансовых операций.
                                            `,
                    },
                },
            },
            {
                // support@all-btc.com t.me/allbtc_support
                title: "Техническая поддержка и связь с нами",
                list: {
                    0: {
                        title: "Как связаться с нашей технической поддержкой?",
                        text: `Если у вас возникли вопросы или проблемы, наша техническая поддержка готова помочь вам. Для связи с нами вы можете использовать следующие способы:
                                            <ul class="list"><li class="list_item">Электронная почта: Отправьте нам письмо на нашу электронную почту mail Мы постараемся ответить вам в кратчайшие сроки.</li>
                                            <li class="list_item">Чат на сайте: Посетите наш веб-сайт и воспользуйтесь функцией онлайн-чата для общения с нашей командой поддержки в режиме реального времени.</li>
                                            <li class="list_item">Телеграм: Добавьте нас в Телеграм по ссылке telegram для быстрой связи и получения оперативной поддержки.</li>
                                            <li class="list_item">Форма обратной связи: На нашем веб-сайте вы можете заполнить форму обратной связи, указав свое имя, адрес электронной почты и сообщение. Мы свяжемся с вами в ближайшее время.</li></ul>
                                            Не стесняйтесь обращаться к нам с любыми вопросами или проблемами. Мы готовы помочь вам и обеспечить качественную техническую поддержку.
                                            `,
                    },
                    1: {
                        title: "Как быстро я могу ожидать ответа от нашей команды поддержки?",
                        text: `Как быстро я могу ожидать ответа от нашей команды поддержки? <br>
                                Мы стремимся предоставить нашим клиентам быстрые и эффективные ответы от нашей команды поддержки. Время ожидания зависит от текущей загруженности и сложности вопроса. Однако, обычно мы стараемся отвечать на запросы в течение 24 часов. <br><br>

                                Мы прилагаем все усилия, чтобы обеспечить своевременное и качественное обслуживание наших клиентов. Если у вас срочный вопрос или проблема, рекомендуется использовать функцию онлайн-чата или звонок, чтобы получить быстрый ответ от нашей команды поддержки. <br><br>

                                Мы ценим ваше терпение и сотрудничество и обязуемся предоставить вам высококлассную поддержку в кратчайшие сроки.`,
                    },
                    2: {
                        title: "Какие рекомендации вы даете для быстрого и эффективного решения проблем?",
                        text: `Чтобы быстро и эффективно решать проблемы, мы рекомендуем вам следовать этим рекомендациям: <br>
                                            1. Подробное описание проблемы: При обращении в техническую поддержку, предоставьте подробное описание проблемы. Укажите все важные детали, сообщите о шагах, предшествующих возникновению проблемы и о любых сообщениях об ошибках. Это поможет нам лучше понять суть проблемы и предложить наилучшее решение. <br>
                                            2. Проверьте доступность ресурсов: Убедитесь, что все необходимые ресурсы, такие как интернет-соединение, питание и майнинговое оборудование, работают нормально. Иногда проблема может быть связана с внешними факторами, и их проверка может помочь исключить такие проблемы. <br>
                                            3. Пользуйтесь руководствами и документацией: Используйте наше руководство пользователя, FAQ и другую документацию, предоставленную нами. Она содержит полезные инструкции и ответы на часто задаваемые вопросы, которые могут помочь вам самостоятельно решить некоторые проблемы. <br>
                                            4. Обратитесь в техническую поддержку: Если вы не можете решить проблему самостоятельно, обратитесь в нашу техническую поддержку. Мы готовы помочь вам, провести дополнительные проверки и предложить наилучшее решение проблемы. <br>
                                            Мы нацелены на то, чтобы обеспечить вас быстрым и эффективным решением проблем. Следуя этим рекомендациям, вы повышаете шансы на успешное разрешение вопросов и минимизируете время простоя.
                                            `,
                    },
                },
            },
        ],
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
                    text: "Используя модель FPPS, PPS+, PPS и мгновенные расчеты, вы можете избежать колебаний заработка",
                },
                {
                    title: " Комплексное обслуживание ",
                    text: "Обслуживание направлено на  сокращение разрыва между добычей полезных ископаемых и трейдингом",
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
            accounts: "Субаккаунты",
            workers: "Воркеры",
            income: "Доходы",
            connecting: "Подключение",
            watchers: "Наблюдатели",
            wallets: "Кошельки",
            referral: "Реф. кабинет",
            account: "Аккаунт",
            faq: "FAQ",
            support: "Поддержка",
        },
        days: "Дней",
        hours: "Часа",
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
            placeholder: "Выбрать период",
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
            checkbox: "Общая статистика со всех аккаунтов",
            chart: {
                title: "Общий хешрейт",
                no_workers_title: "Подключиться к allbtc pool",
            },
            info_blocks: {
                title: "Начисления",
                title_clear: "Чистая прибыль",
                text_clear:
                    "Укажите расходы на электроэнергию для расчета чистой прибыли. ",
                button_clear: "Указать",
                payment: {
                    titles: ["Вчера", "Прогноз на сегодня"],
                },
                clear: {
                    titles: ["Сегодня", "За месяц"],
                },
                hash: {
                    titles: ["Текущий хешрейт", "Ср.Хешрейт / 24"],
                },
                hashrate: {
                    title: "Общий хешрейт",
                },
                workers: {
                    title: "Воркеры",
                    types: ["Активные", "Нестабильные", "Неактивные"],
                },
            },
        },
        accounts: {
            title: "Субаккаунты",
            toggle: ["Активный", "Переключить"],
            block: {
                titles: [
                    "Ср.хешрейт / 1ч",
                    "Воркеры",
                    "Прогноз на сегодня",
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
                    button: "Добавить",
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
            statuses: ["Активный", "Нестабильный", "Неактивный"],
            table: {
                thead: [
                    "Имя воркера",
                    "Текущий",
                    "Хешрейт/1ч",
                    "Хешрейт/24ч",
                    "Частота отказов/24ч",
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
            types: ["Реф. доход", "Майнинг"],
            title: "Доходы",
            income_info: {
                title: "Платежи",
                titles: ["Оплачено", "Неоплачено", "Вчерашний доход"],
            },
            table: {
                title: "История транзакций",
                tabs: ["Начисления", "Выплаты"],
                thead: [
                    "Тип операции",
                    "Дата начисления",
                    "Дата вылпаты",
                    "Хешрейт",
                    "Начисления",
                    "Выплаты",
                    "TxID",
                    "Адрес кошелька",
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
            title: "URL-адреса пула",
            note: "При корректном подключении устройство отобразится через 1-10 минут",
            block: {
                title: "Настройте ваше устройство согласно представленным ниже данным:",
            },
        },
        wallets: {
            title:[ "Настройка автовыплаты", "Кошельки"],
            no_info: "Добавить кошелек",
            messages: ["Подождите 5 секунд.", "Удалить кошелек можно через тех поддержку."],
            block: {
                title: "Список кошельков",
                filter: "Скрыть с нулевым балансом",
                wallet_block: {
                    menu: ["Изменить метку", "Удалить"],
                    i_info_titles: ["Процент вывода", "Мин сумма вывода"],
                },
            },
            popups: {
                note: "После добавления кошелька адрес невозможно будет изменить",
                add: {
                    title: "Добавить кошелек",
                    placeholders: {
                        wallet: "Адрес кошелька",
                        name: "Метка кошелька",
                    },
                    labels: {
                        percent: "Процент *",
                        minWithdrawal: "Минимальный вывод",
                    },
                    button: "Добавить",
                },
                change: {
                    title: "Измените метку",
                    placeholders: {
                        wallet: "Введите кошелек *",
                        name: "Введите имя",
                    },
                    labels: {
                        percent: "Процент *",
                        minWithdrawal: "Минимальный вывод",
                    },
                    button: "Сохранить",
                },
                remove:{
                    title: "Удалить кошелек",
                    note: "Вы действительно хотите удалить кошелек?",
                    button: ["Отменить", "Удалить"]
                }
            },
        },
        settings: {
            title: "Настройки аккаунта",
            block: {
                titles: ["Персональные данные", "Безопасность"],
                settings_block: {
                    income: {
                        title: "Расчет чистой прибыли ",
                        text: "Укажите стоимость электроэнергии за месяц",
                        button: "Изменить",
                    },
                    change_link: "Изменить",
                    labels: {
                        login: "Логин",
                        email: "Почту",
                        password: "Пароль",
                        phone: "Телефон",
                    },
                    phone_message: "Добавьте телефон",
                    popup: {
                        title: "Задайте новый",
                        title_email: "Задайте новую",
                        placeholders: {
                            placeholder: "Введите",
                            password_new: "Введите новый",
                            password_confirmation: "Подтвердите",
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
    locale: "en",
    messages,
});
