import axios from "axios";

const currency = async () => {
    return axios.get("https://www.cbr-xml-daily.ru/latest.js");
};

export default currency;
