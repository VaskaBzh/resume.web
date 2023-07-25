import axios from "axios";

const currency = async () => {
    let result;
    await axios.get("https://www.cbr-xml-daily.ru/latest.js").then((res) => {
        result = res;
    });
    return result;
};

export default currency;
