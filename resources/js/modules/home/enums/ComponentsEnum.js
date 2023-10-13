import HomeTitle from "@/modules/home/Components/Views/HeroView.vue";
import WhoWeAre from "@/modules/home/Components/Views/AboutView.vue";
import CalculatorLand from "@/modules/home/Components/Views/CalculatorLand.vue";
import MinersInfoView from "@/modules/home/Components/Views/MinersInfoView.vue";
import MakeUpCab from "@/modules/home/Components/Views/CabinetView.vue";
import SecurityView from "@/modules/home/Components/Views/SecurityView.vue";
import AppMobileView from "@/modules/home/Components/Views/AppMobileView.vue";
import PaymentsView from "@/modules/home/Components/Views/PaymentsView.vue";
import MissionView from "@/modules/home/Components/Views/MissionView.vue";
import HistoryPoolView from "@/modules/home/Components/Views/HistoryPoolView.vue";

export const ComponentsEnum = {
    history: HistoryPoolView,
    mission: MissionView,
    payments: PaymentsView,
    mobile: AppMobileView,
    security: SecurityView,
    cabinet: MakeUpCab,
    miners: MinersInfoView,
    calculator: CalculatorLand,
    about: WhoWeAre,
    home: HomeTitle,
};
