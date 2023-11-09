export class Injectable {
    constructor(...dependensies) {
        const depsRegistry = Injectable.depsRegistry || (Injectable.depsRegistry = {});
        const className = this.constructor.name;

        let depNames = depsRegistry[className];

        if (!depNames) {
            depNames = this.constructor
                .toString()
                .replace(/\s|['"]/g, '')
                .replace(/.*(super\((?:\w+,?)+\)).*/g, '$1')
                .replace(/super\((.*)\)/, '$1')
                .split(',');
        }

        dependensies.forEach((dependense, index) => {
            const depName = depNames[index];
            try {
                this[depName] = new dependense();
            } catch (err) {
                this[depName] = dependense;
            }
        })
    }
}
