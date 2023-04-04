import { createStore } from "vuex";
import btcInfo from "@/store/modules/btcInfo";
import converter from "@/store/modules/converter";
import payment from "@/store/modules/payment";
export default createStore({
    modules: { btcInfo, converter, payment },
});
