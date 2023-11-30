<template>
    <footer class="footer-land">
        <div class="footer-land__container">
            <div class="footer-land_info">
                <button-blue class="footer-land_btn">{{
                        $t("footer.button")
                    }}
                </button-blue>
                <nav-links class="footer-land__links"></nav-links>
                <div class="footer-land_contacts">
                    <div class="footer-land_contacts_support">
                        support@all-btc.com
                    </div>
                    <div class="footer-land_contacts_adress">
                        BDubai Silicon Oasis, DDP, Building A2<br/>
                        Dubai, United Arab Eirates
                    </div>
                    <div class="footer-land__massagers">
                        <button-blue class="footer-land_contacts_btn"
                        >telegram
                        </button-blue
                        >
                        <button-blue class="footer-land_contacts_btn"
                        >instagram
                        </button-blue
                        >
                        <button-blue class="footer-land_contacts_btn"
                        >youtube
                        </button-blue
                        >
                    </div>
                </div>
            </div>
            <h2 class="footer-land_name">Allbtc Pool</h2>
            <div class="footer-land_confidential">
                <router-link to="#">{{ $t("footer.text") }}</router-link>
                <router-link to="#">© 2023 Allbtc Pool</router-link>
            </div>
        </div>
    </footer>
</template>

<script>
import ButtonBlue from "./UI/ButtonBlue.vue";
import NavLinks from "../../navs/Components/NavLinks.vue";
import {HomeMessage} from "@/modules/home/lang/HomeMessage";

export default {
    name: "FooterComponentLand",
    components: {NavLinks, ButtonBlue},
    i18n: {
        sharedMessages: HomeMessage,
    },
};
</script>

<style scoped lang="scss">
.footer-land {
    background: black;
    padding: 100px 0 72px;
    border-top-left-radius: 70px;
    border-top-right-radius: 70px;

    &__container {
        margin: 0 auto;
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        justify-content: center;
    }

    &__links {
        color: rgba(245, 250, 255, 0.7);
        text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
        font-family: NunitoSans, serif;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%;
    }

    &_info {
        width: 100%;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 100px;
    }

    &_contacts {
        display: flex;
        flex-flow: column nowrap;
        gap: 20px;

        &_support,
        &_adress {
            color: rgba(245, 250, 255, 0.7);
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: NunitoSans, serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 110%;
        }
    }

    &__massagers {
        display: flex;
        flex-flow: row nowrap;
        gap: 10px;
    }

    &_name {
        font-family: Unbounded, serif;
        font-size: clamp(80px, 12vw, 203px);
        font-style: normal;
        font-weight: 600;
        line-height: 105%;
        -webkit-text-fill-color: transparent;
        -webkit-background-clip: text;
        color: transparent;
        -webkit-text-stroke: 0.5px rgb(255, 255, 255, 0.5);
    }

    &_confidential {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: rgba(245, 250, 255, 0.2);
        text-align: right;
        text-shadow: 0px 4.87313985824585px 8.527995109558105px rgba(14, 14, 14, 0.05);
        font-family: NunitoSans, serif;
        font-size: 18px;
        font-style: normal;
        font-weight: 400;
        line-height: 120%;
    }
}
</style>
