import { RouteNamesMap } from "../map/RouteNamesMap";

export class RouteProfileData {
    constructor(name, component) {
        this.path = `/profile/${name}`;
        this.name = name;
        this.component = () =>
            import(`../../Pages/Profile/${RouteNamesMap.profile[component]}.vue`);
        this.meta = {
            middleware: [
                "LoadLayoutMiddleware",
                "AuthCheckProfileMiddleware",
                "DropErrorsMiddleware",
            ],
            layout: "ProfileLayoutView",
        };
    }
}
