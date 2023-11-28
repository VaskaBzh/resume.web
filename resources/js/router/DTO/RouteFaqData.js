import { RouteNamesMap } from "../map/RouteNamesMap";

export class RouteFaqData {
    constructor(name, component) {
        this.path = `/faq/${name}`;
        this.name = name;
        this.component = () =>
            import(`../../modules/faq/Components/UI/${RouteNamesMap.faq[component]}.vue`);
        // this.meta = {
        //     middleware: [
        //         "LoadLayoutMiddleware",
        //         "AuthCheckProfileMiddleware",
        //         "DropErrorsMiddleware",
        //     ],
        //     layout: "FaqLayoutView",
        // };
    }
}
