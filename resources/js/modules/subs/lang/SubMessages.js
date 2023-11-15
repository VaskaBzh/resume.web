export const SubMessages = {
    en: {
        title: "Subaccounts",
        search_placeholder: "Search by name",
        table: {
            titles: [
                "Subaccount name",
                "Workers",
                "Current hashrate",
                "Hashrate / 24h",
                "Total paid out",
            ],
        },
        no_information: "No results found for your query",
        info_blocks: {
            hash: {
                titles: ["Current Hashrate", "Avg. Hashrate / 24h"],
                hints: [
                    "The total current hashrate from all your sub-accounts.",
                    "The total hashrate over the last 24 hours from all your sub-accounts.",
                ],
            },
            workers: {
                title: "Workers",
                types: ["Active", "Unstable", "Inactive"],
                hints: {
                    active: "The sum of active workers from all your sub-accounts.",
                    inactive:
                        "The sum of inactive workers from all your sub-accounts.",
                },
            },
        },
    },
    ru: {
        title: "Субаккаунты",
        search_placeholder: "Поиск по имени",
        table: {
            titles: [
                "Имя субаккаунта",
                "Воркеры",
                "Текущий хешрейт",
                "Хешрейт / 24ч",
                "Выплачено всего",
            ],
        },
        no_information: "По вашему запросу ничего не найдено",
        info_blocks: {
            hash: {
                titles: ["Текущий хешрейт", "Ср.Хешрейт / 24"],
                hints: [
                    "Общий текущий хешрейт со всех ваших субаккаунтов.",
                    "Общий хешрейт за 24 часа со всех ваших субаккаунтов.",
                ],
            },
            workers: {
                title: "Воркеры",
                types: ["Активные", "Нестабильные", "Неактивные"],
                hints: {
                    active: "Сумма активных воркеров со всех ваших субаккаунтов.",
                    inactive:
                        "Сумма неактивных воркеров со всех ваших субаккаунтов.",
                },
            },
        },
    },
};
