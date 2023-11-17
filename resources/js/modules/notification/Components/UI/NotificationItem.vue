<template>
	<div class="notification" :class="notification.class">
		<div class="notification__head">
			<component
				class="notification_icon"
				:is="icon"
			/>
			<span class="notification_title">
				{{ $t(notification.title) }}
			</span>
		</div>
		<span class="notification_text">
			{{ $t(notification.text ?? "") }}
		</span>
	</div>
</template>

<script>
import { NotificationMessage } from "@/modules/notification/lang/NotificationMessage";

export default {
	name: "notification-item",
	props: {
		notification: Object,
	},
	i18n: {
		sharedMessages: NotificationMessage,
	},
	data() {
		return {
			icon: null,
		};
	},
	mounted() {
		this.notification.icon.then((icon) => {
			this.icon = icon.default;
		})
	}
}
</script>

<style scoped>
.notification {
	display: flex;
	flex-direction: column;
	gap: 8px;
	border-radius: 12px;
	max-width: 600px;
	width: fit-content;
	padding: 16px;
}
.notification-success {
	background: var(--background-success, #E9F8F1);
}
.notification-warning {
	background: var(--background-waiting, #FFF8F0);
}
.notification-error {
	background: var(--background-failed, #FEECED);
}
.notification-success .notification_title,
.notification-success .notification_text {
	color: var(--status-succesfull, #1FB96C);
}
.notification-warning .notification_title,
.notification-warning .notification_text {
	color: var(--status-waiting, #FFB868);
}
.notification-error .notification_title,
.notification-error .notification_text {
	color: var(--status-failed, #F1404A);
}
.notification__head {
	min-height: 24px;
	display: flex;
	align-items: center;
	gap: 12px;
}
.notification_icon {
	width: 24px;
	height: 24px;
}
.notification_title {
	font-family: Unbounded, serif;
	font-size: 14px;
	font-weight: 400;
	line-height: 20px;
}
.notification_text {
	font-family: NunitoSans, serif;
	font-size: 14px;
	font-weight: 400;
	line-height: 20px;
}
</style>
