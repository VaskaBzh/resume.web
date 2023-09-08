import { RouteNamesMap } from "../map/RouteNamesMap";

export class RouteReferralData {
    constructor(name, component) {
        this.path = `/profile/referral/${name}`;
        this.name = name;
        this.query = { page: name };
        this.component = () =>
            import(`../../Pages/${RouteNamesMap.profile.referral[component]}`);
        this.meta = {
            middleware: ["LoadLayoutMiddleware", "DropErrorsMiddleware"],
            link: "ProfileLayoutView",
        };
    }
}
