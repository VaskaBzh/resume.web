export class FormData {
    constructor(item, type, old_password, password, password_confirmation) {
        this.item = item;
        this.type = type;
        this.old_password = old_password;
        this.password = password;
        this.password_confirmation = password_confirmation;
    }
}
