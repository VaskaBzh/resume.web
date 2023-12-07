export class ObjectTrait {
    keyToFind = null;

    findValueByKey(objectData, keyToFind) {
        if (!this.keyToFind) {
            this.keyToFind = keyToFind;
        }

        if (objectData && objectData[this.keyToFind] !== undefined) {
            return objectData[this.keyToFind];
        }

        for (let key in objectData) {
            if (
                typeof objectData[key] === "object" &&
                !Array.isArray(objectData[key]) &&
                objectData[key] !== null
            ) {
                const result = this.findValueByKey(objectData[key]);

                if (result) {
                    return result;
                }
            }
        }
    }
}3
