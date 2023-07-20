import axios from "axios";

const currency = async () => {
    return await axios
        .get("https://www.cbr-xml-daily.ru/latest.js")
        .then((res) => {
            return res;
        });
};

export default currency;
