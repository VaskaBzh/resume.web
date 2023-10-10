import { RouteNamesMap } from "../map/RouteNamesMap";

export class RouteConfirmData {
    constructor(name, component) {
        this.path = `/${name}`;
        this.name = name;
        this.component = () =>
                    import(`../../Pages/${RouteNamesMap.public[component]}.vue`);
        this.props = {
            email: "",
        };
        this.meta = {
            middleware: [
                "LoadLayoutMiddleware",
                "DropErrorsMiddleware",
            ],
            layout: "AuthLayoutView",
        };
    }
}
