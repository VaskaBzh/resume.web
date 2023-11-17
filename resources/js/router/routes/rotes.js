import { RouteServices } from "../services/RouteServices";

const routerServices = new RouteServices();

routerServices.dropRoutes();
routerServices.setRoutes();

export default routerServices.routes;
