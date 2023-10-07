import { NotificationClassEnum } from "@/modules/notification/enums/NotificationClassEnum";
import { NotificationIconEnum } from "@/modules/notification/enums/NotificationIconEnum";

export default {
    actions: {
        setNotification({ commit, state }, notificationData) {
            const notification_data = {
                class: NotificationClassEnum[notificationData.status],
                icon: NotificationIconEnum[notificationData.status],
                title: notificationData.title,
                text: notificationData.text,
            }

            commit("setNotification", notification_data);

            setTimeout(() => commit("dropNotification"), 6000);
        },
        dropNotification({ commit }) {
            commit("dropFullNotification");
        },
    },
    mutations: {
        setNotification(state, notification_data) {
            state.notification_list.push(notification_data);
        },
        dropNotification(state) {
            state.notification_list.shift();
        },
        dropFullNotification(state) {
            state.notification_list.length = 0;
        },
    },
    state: {
        notification_list: [],
    },
    getters: {
        notifications(state) {
            return state.notification_list;
        },
    },
};
