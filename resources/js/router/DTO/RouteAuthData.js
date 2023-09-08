import { RouteNamesMap } from "../map/RouteNamesMap";

export class RouteAuthData {
    constructor(name, component) {
        this.path = `/${name}`;
        this.name = name;
        this.component = () =>
            import(`../../Pages/${RouteNamesMap.public[component]}`);
        this.query = {
            referral_code: "",
        };
        this.meta = {
            middleware: [
                "LoadLayoutMiddleware",
                "AuthMiddleware",
                "DropErrorsMiddleware",
            ],
            link: "AuthLayoutView",
        };
    }
}
