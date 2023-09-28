import { RouteNamesMap } from "../map/RouteNamesMap";

export class RoutePublicData {
    constructor(name, component) {
        this.path = `/${name}`;
        this.name = name;
        this.component = () =>
            import(`../../Pages/${RouteNamesMap.public[component]}.vue`);
        this.meta = {
            middleware: [
                "LoadLayoutMiddleware",
                "DropErrorsMiddleware",
                "DropSubsMiddleware",
                ],
            layout: "LayoutView",
        };
    }
}
