import { RouteNamesMap } from "../map/RouteNamesMap";

export class RoutePublicData {
    constructor(name, component) {
        this.path = `/${name}`;
        this.name = name;
        this.component = () => import(`../../Pages/${RouteNamesMap.public[component]}`);
        this.params = {
            errors: {},
        };
        this.meta = {
            middleware: [ 'LoadLayoutMiddleware' ],
            link: 'LayoutView',
        }
    }
}
