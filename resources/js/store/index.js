import { createStore } from "vuex";
import difficulty from "@/store/modules/difficulty";
import globalMessages from "@/store/modules/globalMessages";
import btcInfo from "@/store/modules/btcInfo";
import theme from "@/store/modules/theme";
import UserMain from "@/store/modules/UserMain";
import ErrorsMain from "@/store/modules/ErrorsMain";

export default createStore({
    modules: {
        globalMessages,
        difficulty,
        btcInfo,
        theme,
        UserMain,
        ErrorsMain,
    },
});
