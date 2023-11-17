<template>
	<div
        class="sub cabinet__block cabinet__block-card cabinet__block-light"
        :class="{
            'sub-active': subData.group_id === getActive,
        }"
        @click="$store.dispatch('set_active_in_list', { index: subData.group_id })"
    >
		<div class="sub__head">
			<span class="sub_name">
				{{ subData.name }}
			</span>
		</div>
		<div class="sub__content">
			<info-block :label="$t('table.titles[2]')">
				<template v-slot:value>
					{{ subData.hash_per_min }} {{ subData.hash_per_min_unit }}H/s
				</template>
			</info-block>
			<info-block :label="$t('table.titles[3]')">
				<template v-slot:value>
					{{ subData.hash_per_day }} {{ subData.hash_per_day_unit }}H/s
				</template>
			</info-block>
			<info-block :label="$t('table.titles[1]')">
				<template v-slot:value>
                    <span class="sub_worker sub_worker-active">
                        {{ subData.workers_count_active }}
                    </span>
                    <span class="sub_worker">
                        /
                    </span>
<!--                    <span class="sub_worker sub_worker-in-active">-->
<!--                        {{ subData.workers_count_in_active }}-->
<!--                    </span>-->
                    <span class="sub_worker sub_worker-unstable">
                        {{ subData.workers_count_in_active }}
                    </span>
				</template>
			</info-block>
			<info-block :label="$t('table.titles[4]')">
				<template v-slot:value>
					{{ subData.total_payout }} BTC
				</template>
			</info-block>
		</div>
	</div>
</template>

<script>
import InfoBlock from "@/modules/subs/Components/UI/InfoBlock.vue";
import { SubMessages } from "@/modules/subs/lang/SubMessages";
import { mapGetters } from "vuex";

export default {
	name: "sub-block",
	props: {
		subData: Object,
	},
	components: {
		InfoBlock,
	},
    i18n: {
        sharedMessages: SubMessages,
    },
    computed: {
        ...mapGetters(["getActive"]),
    }
}
</script>

<style scoped>
.sub {
	position: relative;
	width: 100%;
	display: flex;
	flex-direction: column;
	gap: 12px;
    cursor: pointer;
}
.sub::before {
    content: '';
	border-radius: 0 4px 4px 0;
	background: var(--primary-500, #2E90FA);
    position: absolute;
	top: 50%;
	left: 0;
	transform: translateY(-50%);
	min-height: 88px;
	width: 3px;
    opacity: 0;
    transition: all 0.5s ease 0s;
}
.sub-active:before {
    opacity: 1;
}
.sub-active .sub_name {
    color: var(--text-focus, var(--primary-500, #2E90FA));
}
.sub__head {
	display: flex;
	justify-content: space-between;
}
.sub_name {
    color: var(--text-teritary-night, #6F7682);
	font-family: Unbounded, serif;
	font-size: 16px;
	font-weight: 400;
	line-height: 24px;
    transition: all 0.5s ease 0s;
}
.sub__content {
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	grid-template-rows: repeat(2, 1fr);
	gap: 16px 0;
}
.sub_worker {
    color: var(--text-secondary, #C5C8CD);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
}
.sub_worker-active {
    color: var(--status-succesfull, #1FB96C);
}
.sub_worker-unstable {
    color: var(--status-failed, #F1404A);
}
.sub_worker-in-active {
    color: var(--text-teritary, #6F7682);
}
.sub_worker:not(:last-child) {
    margin-right: 4px;
}
</style>
