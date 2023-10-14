import MonitoringSystemCard from "@/modules/hosting/Components/MonitoringSystemCard.vue";
import SupportSystemCard from "@/modules/hosting/Components/SupportSystemCard.vue";
import ForClientsCard from "@/modules/hosting/Components/ForClientsCard.vue";
import PersonalAreaCard from "@/modules/hosting/Components/PersonalAreaCard.vue";
import MobileAppCard from "@/modules/hosting/Components/MobileAppCard.vue";
import GuaranteeCard from "@/modules/hosting/Components/GuaranteeCard.vue";
import ConnectCard from "@/modules/hosting/Components/ConnectCard.vue";
import AboutView from "@/modules/hosting/Components/AboutView.vue";
import HeroView from "@/modules/hosting/Components/HeroView.vue";
import WorkingView from "@/modules/hosting/Components/WorkingView.vue";
import ClientsView from "@/modules/hosting/Components/ClientsView.vue";
import OfferView from "@/modules/hosting/Components/OfferView.vue";

export const ComponentsEnum = {
    monitoring: MonitoringSystemCard,
    support: SupportSystemCard,
    for_clients: ForClientsCard,
    personal: PersonalAreaCard,
    mobile: MobileAppCard,
    guarantee: GuaranteeCard,
    connect: ConnectCard,
    about: AboutView,
    clients: ClientsView,
    working: WorkingView,
    hero: HeroView,
    offer: OfferView,
};
