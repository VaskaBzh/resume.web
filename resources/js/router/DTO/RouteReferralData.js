import { RouteNamesMap } from "../map/RouteNamesMap";

export class RouteReferralData {
    constructor(name, component) {
        this.path = `/profile/referral`;
        this.name = name;
        this.params = { errors: {} };
        this.query = { page: name };
        this.component = () =>
            import(`../../Pages/${RouteNamesMap.profile.referral[component]}`);
        this.meta = {
            middleware: ["LoadLayoutMiddleware", "DropErrorsMiddleware"],
            link: "ProfileLayoutView",
        };
    }
}
