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
    
    /* tooltip params setters end */
    
    
}