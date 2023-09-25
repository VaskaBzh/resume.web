import { RouteNamesMap } from "../map/RouteNamesMap";

export class RouteAuthData {
    constructor(name, component) {
        this.path = `/${name}`;
        this.name = name;
        this.component = () =>
            import(`../../Pages/${RouteNamesMap.public[component]}.vue`);
        this.query = {
            referral_code: "",
        };
        this.meta = {
            middleware: [
                "LoadLayoutMiddleware",
                name === "confirm" ? "" : "AuthMiddleware",
                "DropErrorsMiddleware",
            ],
            layout: "AuthLayoutView",
        };
    }
}
