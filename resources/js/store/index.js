import difficulty from "@/store/modules/difficulty";
import globalMessages from "@/store/modules/globalMessages";
import btcInfo from "@/store/modules/btcInfo";
import theme from "@/store/modules/theme";
import UserMain from "@/store/modules/UserMain";
import ErrorsMain from "@/store/modules/ErrorsMain";
import ViewportWidth from "@/store/modules/ViewportWidth";
import CurrencyModule from "@/store/modules/CurrencyModule";
import NotificationModule from "@/store/modules/NotificationModule";

import { createStore } from "vuex";

export default createStore({
    modules: {
        globalMessages,
        difficulty,
        btcInfo,
        theme,
        UserMain,
        ErrorsMain,
        ViewportWidth,
        CurrencyModule,
        NotificationModule,
    },
});
