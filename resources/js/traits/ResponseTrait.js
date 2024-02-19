export class ResponseTrait {
    static getResponseData(response) {
        if (!response?.data) {
            return response;
        }

        if (response?.data) {
            return this.getResponseData(response.data);
        }
    }

    static isEmptyResponse(responseData) {
        return responseData.length === 0;
    }
}
