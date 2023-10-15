// If using a module system (e.g. via vue-cli), import Vue and VueI18n and then call Vue.use(VueI18n).
import { createI18n } from "vue-i18n";

// Ready translated locale messages
const messages = {
    en: {
        hash: "Hashrate",
        currency: "BTC Rate",
        miners_title: ["transparent", "and efficient", "mining", "of bitcoin"],
        miners_offer: {
            title: "what we offer",
            text: "Efficient and stable mining pool with personal commission, optimized for Bitcoin mining. As well as a set of tools for a transparent and convenient analysis of your assets.",
        },
        hosting_title: ["by", "50%", "per each kwt", "increase", "your income"],
        hosting_button: "get consultation",
        who_are_we: {
            button: "who we are",
            title: [
                "Efficient pool",
                "for mining Bitcoin",
                "optimized",
                "for data centers",
            ],
            column: {
                num: [">3", "5", ">1.7"],
                gray_text: [
                    "years",
                    "the largest data centers in Russia",
                    "EH /s",
                ],
                main_text: [
                    "We work in the",
                    "crypto industry",
                    "Work successfully",
                    "with us",
                    "Total hashrate",
                    "of our pool",
                ],
            },
        },
        offer: {
            button: "what we offer",
            title: ["we'll increase", "your income", "per each kWt", "by 50%"],
            cards: {
                title: [
                    "up to 4%",
                    "personal commission for your clients",
                    "up to 75%",
                    "your affiliate program rewards",
                ],
                text: [
                    "The commission of our pool is customizable. We give you a choice: give a discount to your clients and provide an advantageous offer or increase your profits through the affiliate program. Contact to the manager for more details. ",
                    "You receive a large reward through the affiliate program, which will allow you to earn more from each of your clients. The reward percentage depends on the connected hashrate.",
                ],
            },
        },
        pluse: {
            button: "more advantages",
            text: "We offer a set of tools to optimize the work and increase profits of data centers. Personal support resolves all issues without the participationof your specialists.",
        },
        system_monitoring: {
            title: ["hosting", "management", "system"],
            text: "The hosting monitoring and management system allows you to optimize the operation of your data center. You can track your devices, monitor movements and repairs. It also includes statistics on all devices and timely actions when problems are identified.",
            button: "get consultation",
        },
        support: {
            title: "premium customer support",
            text: "We are creating a separate private chat with dedicated support just for your clients. The chat contains your elements such as name and logo to support your brand. ",
        },
        for_clients: {
            button: "Your customers are going to get",
            text: "Your clients will receive a set of tools for stable and transparent earnings. Plus access to premium support and guarantees of safety and reliability.",
        },
        hosting_personal_account: {
            title: "user-friendly personal account",
            text: "User friendly personal account with all the necessary statistics and intuitive navigation. Only the necessary functions for the user. ",
            button: "try personal account",
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
        },
        hosting_mobile_app: {
            title: "mobile application",
            text: "Optimized and intuitive mobile application. Hashrate monitoring notifications and access to income information at any time on your phone.",
            button: "coming soon to the appstore",
        },
        guarantees: {
            title: "Guarantees of reliability and safety",
            text: "A personal manager will work with you who will help resolve any issues, including questions from your clients. We value our clients and strive to provide the best experience with allbtc pool",
            list: {
                title: [
                    "FPPS+",
                    "security guarantee",
                    "automatic payments",
                    "prompt technical support",
                    "timely notifications",
                ],
                text: [
                    "The most advanced reward method with the highest payout as it combines block reward and transaction fee payments into one value. The pool pays rewards regardless of whether a block is found.",
                    "We provide maximum protection for your crypto assets and user data. Using physical security, data encryption, protection against DDoS attacks, the use of 2FA and VPN tunnels. As well as regular security audits, including penetration testing.",
                    "We have automated payouts to improve security and simplify the process. You configure the minimum amount of funds for withdrawal and the payment occurs automatically when the required numbers are reached.",
                ],
            },
        },
        connect: {
            title: "interested in working with us?",
            text: "Leave your phone number, the client manager will contact you and answer all your questions.",
            button: "contact us",
            form: {
                placeholder: "Enter a name",
                button: ["request a call", "TELEGRAM", "what’s app"],
                text: "or",
            },
        },
        history_pool: {
            texts: [
                "We create sites for data centers, hosting, and mining hotels placement. We collaborate with contractors in Russia and the CIS. We create turnkey mining zones: from rent to commissioning the farm.",
                "Halving occurred, mining difficulty increased. A team of developers appeared. Our goal is to create relevant solutions for the optimization of industrial miners and data centers.",
                "Bitcoin has significantly increased in price. We expanded our staff manifold and established a monitoring system for data centers. In the same year, we signed the first custom integration contracts.",
                "Officially registered a cryptocurrency mining pool. The first data centers connected to the system. We increased their profit by 50% for every kilowatt-hour spent.",
                "We ceased to operate only as a closed pool for data centers and entered the international market. By the end of 2023, we have ambitious plans.",
            ],
        },
        /* */
        title: ["Exp", "ert", "approach", "to min", "ing", "Bitcoin"],
        text: "We use advanced technologies for efficient Bitcoin mining. Maximum transparency of mining in a couple of clicks.",
        button: "try demo version",
        who_we_are: {
            button: "who we are",
            card_private: {
                title: ["private pool for data-centers"],
                num: ["7", "1.7", "30", "75%"],
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
            text: "Allows you to evaluate possible approximate income for a certain period. Actual earnings may vary slightly.",
            form_calculator: {
                title: "Calculator Light",
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
                    "The advanced technology we created, Stratum 3.0, allows us to reduce the time of synchronization of mining equipment with the pool. Advanced security system, both physical and virtual.",
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
                text: "Encrypting data transmitted between users and the pool server helps prevent eavesdropping or interception by attackers. Using secure channels such as SSL/ TLS, Allbtc Pool ensures that data remains private and secure during transmission and protected from unauthorized access.",
            },
            updates: {
                title: "Regular software updates",
                text: "Regular updates improve the security system: detect vulnerabilities, close them, and, as a result, increase reliability. Also, regular updates of the pool software ensure compatibility with the latest changes caused by the dynamics of the crypto industry.",
            },
            DDoS: {
                title: "DDoS attacks protection",
                text: "When a mining pool is subject to DDoS attacks, it can lead to disruptions in mining operations, resulting in reduced payouts to the pool's clients. DDoS protection ensures that Allbtc Pool is always up and running and provides continuous reliable service to its users ",
            },
        },
        mobile_app: {
            button: "mobile application",
            title: "User-friendly app with updated data",
            text: "Our team, being experts and practicing miners, specializes in Bitcoin, knows all the intricacies of cryptocurrency mining and introduces new ideas and mechanisms into the development of the pool. All implemented tools help you earn more.",
            note: "coming soon in appstore",
            slides: [
                "Good monitoring and effective management",
                "Clear monitoring and effective management",
                "Excellent monitoring and effective management",
                "Awesome monitoring and effective management",
            ],
        },
        payments: {
            button: "payouts",
            title: ["FPPS+", "autopayouts", "free funds transfer"],
            text: [
                "A modernized reward system that eliminates the risk of reduced miner income due to fluctuations in transaction fees by combining the block reward and transaction fee payments into one value. It also guarantees a fair distribution of rewards among pool participants.",
                "Automatic payments are made without any action on the part of the miner. Since payments are possible when predetermined conditions are met (reaching a given minimum threshold), funds are received without delay. Moreover, the possibility of an error (incorrectly entered wallet address or transaction amount) caused by a human factor is eliminated.",
                "Automatic withdrawal of funds is completely free, no commission is charged. Moreover, withdrawals to any wallets are also made without commission.",
            ],
        },
        main: {
            button: "main things",
            title: ["Values", "mission", "goals"],
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
        footer_home: {
            button: "Personal account",
            list: ["Home", "Data centers", "Miners", "FAQ", "News", "Contacts"],
            text: "Privacy Policy",
        },
        validate_messages: {
            watcher_message: "Watcher created successfully",
            verify_message: "Email verified successfully",
            two_fa_message:
                "Two-factor authentication has been successfully linked",
        },
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
            workers: "Workers",
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
                watchers: "Watchers links",
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
            subs_group: "Subaccounts",
            settings_group: "Settings",
            statistic: "Statistics",
            accounts: "Subaccounts",
            workers: "Workers",
            income: "Earnings",
            connecting: "Connection",
            watchers: "Watcher's links",
            wallets: "Wallets",
            referral: "Ref. cabinet",
            faq: "FAQ",
            support: "Support",
            settings: "Account",
        },
        days: "Days",
        hours: "Hours",
        month: "Month",
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
            graph: ["Monthly income graph", "Mining", "Accrued"],
            info_blocks: {
                title: "Earnings",
                title_clear: "Net income",
                text_clear:
                    "Specify the cost of electricity to calculate net income.",
                button_clear: "Specify",
                payment: {
                    titles: [
                        "Forecast for today",
                        "Yesterday's income",
                        "Forecast for the month",
                    ],
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
                tooltip: [
                    "On your subaccount",
                    "Autopayment occurs when the balance is >",
                ],
            },
        },
        accounts: {
            title: "Subaccounts",
            toggle: ["Active", "Toggle"],
            block: {
                titles: [
                    "Current hashrate",
                    ,
                    "Worker",
                    "Hashrate / 24h",
                    "Total paid out",
                ],
                workers_status: ["Active", "All"],
                menu: ["Change name", "Linked wallets"],
            },
            popups: {
                add: {
                    title: "Add subaccount",
                    text: "The subaccount name cannot be changed in the future.",
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
                card: [
                    "Accrued for all time",
                    "Accrued",
                    "Income for the month",
                ],
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
                    error: "An error occurred while processing the payment. Please check the accuracy of your wallet address and the network for receiving the transaction (It should be bitcoin).",
                    error_payout: "An error occurred while making the payout.",
                    completed: "Payout successfully completed.",
                    ready_to_payout: "Ready to payout.",
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
            title: ["Setting up auto payout", "Wallets"],
            no_info: {
                description:
                    "To enable automatic payouts, add your wallet address",
                message: "To add a wallet, you need to verify your email",
                verify_text: "Verify email",
                button_text: "Add",
            },
            tooltip:
                "As soon as the accrual amount increases the specified value will be automatically paid out to your active wallet",
            messages: [
                "Wait 5 seconds.",
                "You can delete your wallet through tech support.",
            ],
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
                remove: {
                    title: "Delete wallet",
                    note: "Are you sure you want to delete your wallet?",
                    button: ["Cancel", "Delete"],
                },
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
        preloader: {
            text: "Nothing was found for your request",
        },
    },
    ru: {
        miners_title: ["прозрачный", "и эффективный", "майнинг", "bitcoin"],
        hash: "Хешрейт",
        currency: "Курст BTC",
        miners_offer: {
            title: "что мы предлагаем",
            text: "Эффективный и стабильный майнинг-пул с персональной комиссией, оптимизированный под добычу Bitcoin. А также комплекс инструментов для прозрачного и удобного анализа ваших активов.",
        },
        hosting_title: ["на", "50%", "Увеличьте", "ваш доход", "за каждый квт"],
        hosting_button: "получить консультацию",
        who_are_we: {
            button: "кто мы",
            title: [
                "Эффективный пул",
                "для добычи Bitcoin,",
                "оптимизированный",
                "для работы",
                "дата-центров",
            ],
            column: {
                num: [">3", "5", ">1,7"],
                gray_text: ["лет", "крупнейших дата-центров РФ", "EH /s"],
                main_text: [
                    "Работаем на рынке",
                    "цифровых активов",
                    "Успешно работают ",
                    "с нами",
                    "Общий хешрейт",
                    "Allbtc Pool",
                ],
            },
        },
        offer: {
            button: "что мы предлагаем",
            title: ["увеличим", "ваш доход", "за каждый квт", "на 50%"],
            cards: {
                title: [
                    "до 4%",
                    "персональная комиссия для ваших клиентов",
                    "до 75%",
                    "ваши вознаграждения по партнерской программе",
                ],
                text: [
                    "Комиссия нашего пула настраивается кастомно. Мы предоставляем вам выбор: дать скидку вашим клиента и предоставить выгодное предложение или увеличить вашу прибыль по партнёрской программе. Подробнее уточняйте у менеджера. ",
                    "Вы получаете большое вознаграждение по партнёрской программе, которое позволит зарабатывать больше от каждого вашего клиента. Процент вознаграждения зависит от подключенного хешрейта.",
                ],
            },
        },
        pluse: {
            button: "плюсы работы с нами",
            text: "С вами будет работать персональный менеджер, который поможет решить любые вопросы, в том числе вопросы ваших клиентов мы ценим наших клиентов и стремимся обеспечить лучший опыт работы с allbtc pool",
        },
        system_monitoring: {
            title: ["Представляем", "систему", "мониторинга"],
            text: "Система мониторинга и управления хостингом позволяет оптимизировать работу вашего дата центра. Вы можете отслеживать ваши устройства, следить за перемещениями и ремонтами. Также это статистика по всем устройствам и своевременные действия при выявлении проблем.",
            button: "получить консультацию",
        },
        support: {
            title: "премиальная кастомная поддержка",
            text: "Мы создаем отдельный закрытый чат с выделенной поддержкой только для ваших клиентов. Чат содержит ваши элементы, такие как название и лого для поддержки вашего бренда. ",
        },
        for_clients: {
            button: "Что получат ваши клиенты",
            text: "С вами будет работать персональный менеджер, который поможет решить любые вопросы, в том числе вопросы ваших клиентов мы ценим наших клиентов и стремимся обеспечить лучший опыт работы с allbtc pool",
        },
        hosting_personal_account: {
            title: "удобный личный кабинет",
            text: "Удобный личный кабинет со всей необходимой статистикой с интуитивно понятной навигацией. Только нужные функции для конечного пользователя. ",
            button: "попробовать личный кабинет",
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
        },
        hosting_mobile_app: {
            title: "мобильное приложение",
            text: "Оптимизированное и интуитивно понятное мобильное приложение. Мониторинг хэшрейта,  уведомления и доступ к инфо о доходах в любой момент в вашем телефоне.",
            button: "скоро в appstore",
        },
        guarantees: {
            title: "Гарантии надежности и безопасности",
            text: "С вами будет работать персональный менеджер, который поможет решить любые вопросы, в том числе вопросы ваших клиентов мы ценим наших клиентов и стремимся обеспечить лучший опыт работы с allbtc pool",
            list: {
                title: [
                    "система выплаты FPPS+",
                    "гарантия безопасности",
                    "автовыплаты",
                    "оперативная техподдержка",
                    "своевременные уведомления",
                ],
                text: [
                    "Самый современный метод вознаграждения с наибольшей выплатой, поскольку объединяет вознаграждение за блок и выплаты комиссий за транзакции в одно значение. Пул выплачивает вознаграждение независимо от нахождения блока.",
                    "Мы обеспечиваем максимальную защиту ваших крипто активов и данных пользователя. При помощи физической безопасности, шифрования данных, защиты от DDoS-атак, использования 2FA и VPN-туннелей. А также регулярных аудитов безопасности, включая тестирование на проникновение.",
                    "Мы автоматизировали выплаты для улучшения безопасности и упрощения процесса. Вы настраиваете минимальную сумму средств для вывода и выплата происходит автоматически при достижении нужных цифр. ",
                ],
            },
        },
        connect: {
            title: "интересно поработать с нами?",
            text: "Оставьте ваш номер телефона, клиентский менеджер свяжется с вами и ответит на все возникшие вопросы.",
            button: "свяжитесь с нами",
            form: {
                placeholder: "Введите имя",
                button: ["заказать звонок", "TELEGRAM", "what’s app"],
                text: "или",
            },
        },
        history_pool: {
            texts: [
                "Создаем площадки под размещение дата-центов, хостингов и майнинг-отелей. Сотрудничаем с подрядчиками в РФ и СНГ. Создаем зоны для майнинга «под ключ»: от аренды до введения фермы в эксплуатацию.",
                "Произошел халвинг, сложность майнинга выросла. Появилась команда разработчиков. Наша цель – создание актуальных решений для оптимизации работы промышленных майнеров и дата-центров.",
                "Биткоин значительно подорожал. Мы кратно расширили штат и сформировали систему мониторинга для дата-центров. В этом же году заключили первые договоры на кастомную интеграцию.",
                "Официально зарегистрировали пул для майнинга криптовалют. К системе подключились первые дата-центры. На 50% увеличили их прибыль за каждый потраченный киловатт энергии.",
                "Перестали работать только лишь как закрытый пул для дата-центров, вышли на международный рынок. К концу 2023 года у нас амбициозные планы.",
            ],
        },
        title: ["Экспер", "тный", "подход", "к майн", "ингу", "Bitcoin "],
        text: "Используем передовые технологии для эффективного майнинга биткоина. Максимальная прозрачность майнинга в пару кликов. ",
        button: "попробовать демо кабинет",
        who_we_are: {
            button: "кто мы",
            card_private: {
                title: ["приватный пул для дата- центров"],
                num: ["7", "1.7", "30", "75%"],
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
            text: "Позволяет оценить и спрогнозировать возможный приблизательный доход и прибыль за определенный период. Фактические доходы могут незначительно отличаться. ",
            form_calculator: {
                title: "Калькулятор Light",
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
                    "Продвинутая созданная нами Stratum 3.0 технология, позволяющая сократить время синхронизации майнинг оборудования с пулом. Передовая система безопасности как физической так и виртуальной.",
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
                text: "Шифрование данных, передаваемых между пользователями и сервером пула, помогает предотвратить подслушивание или перехват злоумышленниками. Используя безопасные каналы, такие как SSL/TLS, Allbtc Pool гарантирует, что данные остаются конфиденциальными и безопасными во время передачи и защищенными от несанкционированного доступа.",
            },
            updates: {
                title: "регулярные обновления по",
                text: "Регулярные обновления обеспечивают улучшение системы безопасности: обнаружение уязвимостей, их закрытие, и, как следствие, повышение надежности. Также регулярные обновления программного обеспечения пула обеспечивают совместимость с последними изменениями, вызванными динамикой развития криптоиндустрии.",
            },
            DDoS: {
                title: "защита от DDoS-атак",
                text: "Когда майнинг-пул подвержен DDoS-атакам, это может привести к перебоям в майнинг операциях, что приводит к снижению выплат клиентам пула. Защита от DDoS-атак гарантирует, что Allbtc Pool всегда будет работоспособным и обеспечит непрерывное надежное обслуживание своих пользователей.",
            },
        },
        mobile_app: {
            button: "мобильное приложение",
            title: "Прозрачный мониторинг и эффективное управление",
            text: "Наша команда, будучи экспертами и практикующими майнерами, специализируется на биткоине, знает все тонкости добычи криптовалюты и внедряет новые идеи и механизмы в развитие пула. Все внедренные инструменты помогают зарабатывать больше.",
            note: "скоро в appstore",
            slides: [
                "Хороший мониторинг и эффективное управление",
                "Четкий мониторинг и эффективное управление",
                "Прекрасный мониторинг и эффективное управление",
                "Офигенный мониторинг и эффективное управление",
            ],
        },
        payments: {
            button: "выплаты",
            title: [
                "метод вознаграждения",
                "автовыплаты",
                "средняя дневная выплата",
            ],
            text: [
                "Модернизированная система вознаграждений, которая исключает риск снижения доходов майнеров из-за колебаний комиссий за транзакции, поскольку объединяет вознаграждение за блок и выплаты комиссий за транзакции в одно значение. Также гарантирует справедливое распределение вознаграждений между участниками пула.",
                "Автоматические выплаты осуществляются без каких-либо действий со стороны майнера. \n" +
                    "Так как выплаты возможны при выполнении заранее заданных условий (достижение заданного минимального порога), поступление средств производится без задержек. Более того, исключается возможность допущения ошибки (неправильно введенный адрес кошелька или сумма транзакции), вызванной человеческим фактором.",
                "Автовывод средств полностью бесплатный, никакая комиссия не начисляется. Более того, вывод на любые кошельки также производится без комиссии.",
            ],
        },
        main: {
            button: "главное",
            title: ["Ценности миссия цели"],
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
        footer_home: {
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
        validate_messages: {
            watcher_message: "Вотчер успешно создан",
            verify_message: "Почта успешно подтверждена",
            two_fa_message: "Двухфакторная аутентификация успешно привязана",
        },
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
            workers: "Воркеры",
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
                watchers: "Наблюдатели",
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
            subs_group: "Субаккаунты",
            settings_group: "Настройки",
            statistic: "Статистика",
            accounts: "Субаккаунты",
            workers: "Воркеры",
            income: "Доходы",
            connecting: "Подключение",
            watchers: "Наблюдатели",
            wallets: "Кошельки",
            referral: "Реф. кабинет",
            settings: "Аккаунт",
            faq: "FAQ",
            support: "Поддержка",
        },
        days: "Дней",
        hours: "Часа",
        month: "Месяц",
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
                title: "График хешрейта",
                no_workers_title: "Подключиться к allbtc pool",
            },
            graph: ["График дохода за месяц", "Майнинг", "Начислено"],
            info_blocks: {
                title: "Начисления",
                title_clear: "Чистая прибыль",
                text_clear:
                    "Укажите расходы на электроэнергию для расчета чистой прибыли. ",
                button_clear: "Указать",
                payment: {
                    titles: [
                        "Прогноз на сегодня",
                        "Вчерашний доход",
                        "Прогноз на месяц",
                    ],
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
                tooltip: [
                    "На вашем субаккаунте ",
                    "Автовыплата происходит при  балансе >",
                ],
            },
        },
        accounts: {
            title: "Субаккаунты",
            toggle: ["Активный", "Переключить"],
            block: {
                titles: [
                    "Текущий хешрейт",
                    "Воркеры",
                    "Хешрейт / 24ч",
                    "Всего выплачено",
                ],
                workers_status: ["Активные", "Все"],
                menu: ["Изменить название", "Привязанные кошельки"],
            },
            popups: {
                add: {
                    title: "Добавить субаккаунт",
                    text: "В дальнейшем имя субаккаунта невозможно изменить",
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
                card: ["Начислено за все время", "Начислено", "Доход за месяц"],
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
                    error: "Произошла ошибка при выполнении выплаты. Проверьте правильность адреса вашего кошелька и сети для получения транзакции (Должна быть bitcoin).",
                    error_payout: "Произошла ошибка при выполнении выплаты.",
                    completed: "Выплата успешно выполнена.",
                    ready_to_payout: "Ready to payout.",
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
            title: ["Настройка автовыплаты", "Кошельки"],
            no_info: {
                description:
                    "Для автовыплаты начислений добавьте адрес вашего кошелька",
                message:
                    "Чтобы добавить кошелек вам необходимо подтвердить почту",
                verify_text: "Подтвердить почту",
                button_text: "Добавить",
            },
            tooltip:
                "Как только сумма начислений станет больше указанного значения произойдет автовыплата на ваш активный кошелек",
            messages: [
                "Подождите 5 секунд.",
                "Удалить кошелек можно через тех поддержку.",
            ],
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
                remove: {
                    title: "Удалить кошелек",
                    note: "Вы действительно хотите удалить кошелек?",
                    button: ["Отменить", "Удалить"],
                },
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
        preloader: {
            text: "По вашему запросу ничего не найдено",
        },
    },
};

const i18n = createI18n({
    locale: "ru",
    messages,
});

// Create VueI18n instance with options
export default i18n;
