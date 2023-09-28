import { ApiService } from "./services/ApiService";

const apiService = new ApiService();
const mainApiService = new ApiService();

apiService
    .setInstance()
    .setHeaders()
    .authorizationControl()
    .setController();

mainApiService
    .setInstance()
    .setHeaders()
    .authorizationControl()
    .setController();

export const ProfileApi = apiService.instance;
export const MainApi = mainApiService.instance;
export { apiService, mainApiService };
