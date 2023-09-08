import { RouteNamesMap } from "../map/RouteNamesMap";

export class RouteReferralData {
    constructor(name, component) {
        this.path = `/profile/referral?page=:page`;
        this.name = name;
        this.params = { page: name, errors: {} };
        this.component = () =>
            import(`../../Pages/${RouteNamesMap.profile.referral[component]}`);
        this.meta = {
            middleware: ["LoadLayoutMiddleware", "DropErrorsMiddleware"],
            link: "ProfileLayoutView",
        };
    }
}
