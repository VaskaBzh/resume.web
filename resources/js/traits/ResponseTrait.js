export class ResponseTrait {
    getResponseData(response) {
        if (!response?.data) {
            return response;
        }

        if (response?.data) {
            return this.getResponseData(response.data);
        }
    }

    isEmptyResponse(responseData) {
        return responseData.length === 0;
    }
}
