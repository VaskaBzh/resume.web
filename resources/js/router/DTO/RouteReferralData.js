import { RouteNamesMap } from "../map/RouteNamesMap";
import { LoadLayoutMiddleware } from "../middlewares/LoadLayoutMiddleware";

export class RouteReferralData {
    constructor(name, component) {
        this.path = `/profile/referral`;
        this.name = name;
        this.params = { page: name };
        this.component = () =>
            import(`../../Pages/${RouteNamesMap.profile.referral[component]}`);
        this.params = {
            errors: {},
        };
        this.meta = {
            middleware: ["LoadLayoutMiddleware"],
            link: "ProfileLayoutView",
        };
    }
}
