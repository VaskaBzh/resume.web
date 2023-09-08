import { RouteNamesMap } from "../map/RouteNamesMap";

export class RouteProfileData {
    constructor(name, component) {
        this.path = `/profile/${name}`;
        this.name = name;
        this.component = () =>
            import(`../../Pages/${RouteNamesMap.profile[component]}`);
        this.params = {
            user: null,
            errors: {},
        };
        this.meta = {
            middleware: [
                "LoadLayoutMiddleware",
                "AuthCheckProfileMiddleware",
                "DropErrorsMiddleware",
            ],
            link: "ProfileLayoutView",
        };
    }
}
