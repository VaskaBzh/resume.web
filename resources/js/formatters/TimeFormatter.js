import { TimeFormatEnum } from "@/enums/TimeFormatEnum";

export class TimeFormatter {
    static formatTime(format, timestamp) {
        const dateTime = new Date(timestamp);
        let formattedDateArray = format;

        Object.keys(TimeFormatEnum).forEach((splitValue) => {
            const splitedFormat = formattedDateArray.split(splitValue);

            if (splitedFormat.length > 1) {
                let timeChapter = dateTime[TimeFormatEnum[splitValue]]();

                if (splitValue === "mm") {
                    timeChapter = timeChapter + 1;
                }

                formattedDateArray = splitedFormat.join(
                    String(timeChapter).length === 1
                        ? `0${timeChapter}`
                        : timeChapter
                );
            }
        });

        return formattedDateArray;
    }
}
