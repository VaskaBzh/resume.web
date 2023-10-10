<template>
	<div class="notification__list" ref="list">
		<transition-group name="notification">
			<notification-item
				v-for="(notification, i) in notifications"
				:notification="notification"
				:key="i"
			/>
		</transition-group>
	</div>
</template>

<script>
import NotificationItem from "@/modules/notification/Components/UI/NotificationItem.vue";

import { mapGetters } from "vuex";

export default {
	name: "notification-list",
	components: {
		NotificationItem
	},
	computed: {
		...mapGetters(["notifications"])
	},
	// watch: {
	// 	notifications() {
	// 		setTimeout(() => {
	// 			this.$refs.list.style.height = `${this.$refs.list.scrollHeight}px`;
	// 		}, 500);
	// 	}
	// }
}
</script>

<style scoped>
.notification-enter-active,
.notification-leave-active {
	transition: all 0.5s ease 0s;
}
.notification-enter-from,
.notification-leave-to {
	transform: translateX(calc(100% + 36px));
}
.notification__list {
	display: flex;
	flex-direction: column;
	gap: 8px;
	position: absolute;
	top: 90px;
	right: 32px;
	align-items: flex-end;
	transition: all 0.5s ease 0s;
    z-index: 1000;
}
</style>
