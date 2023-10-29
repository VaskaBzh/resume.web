export class WalletFormData {
    constructor(wallet_address, group_id, name, confirmation_code) {
        this.wallet_address = wallet_address;
        this.group_id = group_id;
        this.name = name;
        this.confirmation_code = confirmation_code;
    }
}
