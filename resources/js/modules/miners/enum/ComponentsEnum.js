import HeroView from "../Components/HeroView.vue";
import PersonalAreaCard from "../../hosting/Components/PersonalAreaCard.vue";
import MobileAppCard from "../../hosting/Components/MobileAppCard.vue";
import GuaranteeCard from "../../hosting/Components/GuaranteeCard.vue";
import ConnectCard from "../../hosting/Components/ConnectCard.vue";
import CommunityCard from "../Components/CommunityCard.vue";
import ourOffer from "../Components/OurOffer.vue";
import AboutMinersView from "../Components/AboutMinersView.vue";


export const ComponentsEnum = {
    'hero':HeroView,
    'about':AboutMinersView,
    'our-offer':ourOffer,
    'personal-card':PersonalAreaCard,
    'mobile-card':MobileAppCard,
    'guarante':GuaranteeCard,
    'community':CommunityCard,
    'connect-card':ConnectCard,

}
