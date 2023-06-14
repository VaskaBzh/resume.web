import { createStore } from "vuex";
import converter from "@/store/modules/converter";
import globalMessages from "@/store/modules/globalMessages";
import btcInfo from "@/store/modules/btcInfo";
import theme from "@/store/modules/theme";
export default createStore({
    modules: { globalMessages, converter, btcInfo, theme },
});
