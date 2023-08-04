import axios from "axios";

export default {
    async fetch(data) {
        let response = null;
        let error = null;
        await axios
            .get(
                '/api/chart',
            )
            .then(async (res) => {
                response = res.data;
            })
            .catch((err) => (error = err.response ?? err));
        return response ?? error;
    },
};
