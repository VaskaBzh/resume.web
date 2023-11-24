export class ResponseTrait {
    getResponseData(response) {
        if (!response?.data) {
            return response;
        }

        for (let responseKey in response) {
            if (
                typeof response[responseKey] === "object" &&
                !Array.isArray(response[responseKey]) &&
                response[responseKey] !== null
            ) {
                return this.getResponseData(response[responseKey]);
            }
        }
    }

    checkResponseLength(responseData) {
        return responseData.length === 0;
    }
}
