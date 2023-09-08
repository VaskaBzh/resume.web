export class FormData {
    constructor(
        email,
        name,
        password,
        password_confirmation,
        referral
    ) {
        this.email = email;
        this.name = name;
        this.password = password;
        this.password_confirmation = password_confirmation;
        this.referral_code = referral;
    }
}
