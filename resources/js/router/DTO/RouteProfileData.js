import { RouteNamesMap } from "../map/RouteNamesMap";
import { LoadLayoutMiddleware } from "../middlewares/LoadLayoutMiddleware";

export class RouteProfileData {
    constructor(name, component) {
        this.path = `/profile/${name}`;
        this.name = name;
        this.component = () => import(`../../Pages/${RouteNamesMap.profile[component]}`);
        this.meta = {
            middleware: [ 'LoadLayoutMiddleware' ],
            link: 'ProfileLayoutView',
        }
    }
}
