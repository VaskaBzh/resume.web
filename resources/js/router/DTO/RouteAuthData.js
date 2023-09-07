import { RouteNamesMap } from "../map/RouteNamesMap";

export class RouteAuthData {
    constructor(name, component) {
        this.path = `/${name}`;
        this.name = name;
        this.component = () =>
            import(`../../Pages/${RouteNamesMap.public[component]}`);
        this.meta = {
            middleware: ["LoadLayoutMiddleware", "AuthMiddleware"],
            link: "AuthLayoutView",
        };
    }
}
