export const run = ()=> {
    if(document.querySelector('.connect-withus')) {
        runString()
    }
}

function runString() {
    let oQuotes = document.querySelector('.connect-withus');
    /* Функция дублирования пунктов */
        let nElem = oQuotes.children.length;
        for (let i = 0; i < nElem; i++) {
            oQuotes.appendChild(oQuotes.children[i].cloneNode(true));
        }
        oQuotes.style.animationDuration = '10s,' + (nElem*2) + 's';

}
