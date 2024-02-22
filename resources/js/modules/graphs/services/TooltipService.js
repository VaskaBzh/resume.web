import { Tooltip } from "@/modules/graphs/models/Tooltip";

export class TooltipService {
    constructor() {
        this.tooltip = this.createTooltipModel();
    }

    createTooltipModel() {
        return new Tooltip();
    }
    
    setTooltipContent(key, value) {
        this.tooltip.content = {
            ...this.tooltip.content,
            [key]: value,
        }
        
        return this;
    }
    
    getTargetValue(graphData, nearestIndex) {
        const keysArray = Object.keys(graphData);
        
        graphData.forEach((targetData, i) => {
            this.setTooltipContent(keysArray[i], targetData[nearestIndex]);
        })
    }
}