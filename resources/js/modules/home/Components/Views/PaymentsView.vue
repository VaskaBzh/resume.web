<template>
	<div class="payments-view">
	    <div class="payments-view__container">
	        <head-line class="payments-view_title">{{ $t("payments.button") }}</head-line>
	        <div class="payments-view__items">
	            <div class="payments-view__item payments-view__item-one " @click="isOpen = !isOpen">
	                <div class="payments-view__item_title">{{ $t("payments.title[0]") }}</div>
	                <div class="payments-view__item_info">fPPS+</div>
	                <div class="payments-view__item_text" :class="{opened: isOpen}">{{ $t("payments.text[0]") }}</div>
	            </div>
	            <div class="payments-view__item payments-view__item-two">
	                <div class="payments-view__item_title">{{ $t("payments.title[1]") }}</div>
	                <div class="payments-view__item_info"><span>(msk)</span> 12:00-13:00</div>
	                <div class="payments-view__item_text">{{ $t("payments.text[0]") }}</div>
	            </div>
	            <div class="payments-view__item payments-view__item-three">
	                <div class="payments-view__item_title">{{ $t("payments.title[2]") }}</div>
	                <div class="payments-view__item_info">0.8 BTC</div>
	                <div class="payments-view__item_text">{{ $t("payments.text[0]") }}</div>
	            </div>
	        </div>
	    </div>
	</div>
</template>



<script>
import HeadLine from "@/modules/common/Components/UI/HeadLine.vue";
import { HomeMessage } from "@/modules/home/lang/HomeMessage";
import { animatePayView } from "@/modules/home/Services/AnimatePaymentsView";

export default {
    name: "payments-view",
    components: {
		HeadLine
    },
    i18n: {
        sharedMessages: HomeMessage,
    },
    data() {
        return {
            isOpen: false
        }
    },

    mounted() {
        animatePayView()
    }

}
</script>

<style scoped lang="scss">
.payments-view {
    display: flex;
    height: 100vh;
    flex-flow: column nowrap;
    align-items: center;
    justify-content: center;

    &__items {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-flow: column nowrap;
        gap: 32px;
    }

    &__item {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        align-items: center;
        justify-content: space-between;
        padding: 32px 0;
        overflow: hidden;
        cursor: pointer;
        transition: all .3s ease-in;


        &_title {
            color: #F5FAFF;
            font-family: Unbounded, serif;
            font-size: 24px;
            font-style: normal;
            font-weight: 400;
            line-height: 120%;
            text-transform: uppercase;
        }

        &:nth-child(1) {
            border-top: .5px solid rgba(228, 231, 236, 0.40);
            border-bottom: .5px solid rgba(228, 231, 236, 0.40);
        }

        &:nth-child(2) {
            border-bottom: .5px solid rgba(228, 231, 236, 0.40);
        }

        &:nth-child(3) {
            border-bottom: .5px solid rgba(228, 231, 236, 0.40);
        }

        &_info {
            color: #F5FAFF;
            text-align: right;
            font-family: Unbounded, serif;
            font-size: 65px;
            font-style: normal;
            font-weight: 600;
            line-height: 120%;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 20px;

            span {
                color: #F5FAFF;
                font-family: Unbounded, serif;
                font-size: 20px;
                font-style: normal;
                font-weight: 600;
                line-height: 120%;
                text-transform: uppercase;
            }

        }


        &:nth-child(2) &_info {
            color: #F39C19;
        }


        &:nth-child(3) &_info {
            color: #F39C19;
        }



        &_text {
            color: rgba(245, 250, 255, 0.70);
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: NunitoSans, serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 110%;
            max-height: 0;
            overflow: hidden;
            transition: max-height .3s ease-in;
        }

    }
}

.opened {
    display: grid;
    grid-template-rows: repeat(1, 1fr);
    max-height: 100%;
}
</style>
