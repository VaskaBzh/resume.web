import { Tooltip } from "@/modules/graphs/models/Tooltip";

export class TooltipService {
    constructor() {
        this.tooltip = this.createTooltipModel();
    }

    createTooltipModel() {
        return new Tooltip();
    }

    showTooltip() {
        this.tooltip.opacity = 1;

        return this;
    }

    hideTooltip() {
        this.tooltip.opacity = 0;

        return this;
    }

    setTooltipHtml(newTooltipHtml) {
        this.tooltip.html = newTooltipHtml;

        return this;
    }

    setTooltipPosition(newLeftPosition, newTopPosition) {
        this.tooltip.position = {
            ...this.tooltip.position,
            left: newLeftPosition,
            top: newTopPosition,
        };

        return this;
    }

    setTooltipContent(key, value) {
        this.tooltip.content = {
            ...this.tooltip.content,
            [key]: value,
        };

        return this;
    }

    getTargetValue(graphData, nearestIndex) {
        const keysArray = Object.keys(graphData);

        keysArray.forEach((targetData, i) => {
            if (targetData === "values") {
                return this;
            }

            this.setTooltipContent(
                keysArray[i],
                graphData[keysArray[i]][nearestIndex]
            );
        });

        return this;
    }
}
