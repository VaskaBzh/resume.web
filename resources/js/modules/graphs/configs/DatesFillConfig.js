import { TimeFormatter } from "@/formatters/TimeFormatter";

export const DatesFillConfig = {
    dayAt: (timeStamp) => TimeFormatter.formatTime("dd.mm.yy", timeStamp),
    hourAt: (timeStamp) => TimeFormatter.formatTime("hh:ii", timeStamp),
    dates: (timeStamp) => new Date(timeStamp),
};
