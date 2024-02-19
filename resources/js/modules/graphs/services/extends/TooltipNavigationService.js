export class TooltipNavigationService {
    left = 0;
    top = 0;
    opacity = 0;
    width = 0;

    tooltipHtml = null;

    /* tooltip params setters start */

    setTooltipHtml(newTooltipHtml) {
        this.tooltipHtml = newTooltipHtml;

        return this;
    }

    setWidth() {
        this.width = this.tooltipHtml.offsetWidth;

        return this;
    }

    setLeft(leftParam) {
        this.left = leftParam;

        return this;
    }

    setTop(topParam) {
        this.top = topParam;

        return this;
    }

    /* tooltip params setters end */
    
    checkPosition() {
        const isLeft = this.mouseX < tooltipWidth;
        const isRight = this.mouseX > this.containerWidth - tooltipWidth;

        
    }

    hideTooltip() {
        this.opacity = 0;

        return this;
    }

    showTooltip() {
        this.opacity = 1;

        return this;
    }
}
