import { createStore } from "vuex";
import converter from "@/store/modules/converter";
import globalMessages from "@/store/modules/globalMessages";
import btcInfo from "@/store/modules/btcInfo";
export default createStore({
    modules: { globalMessages, converter, btcInfo },
});
