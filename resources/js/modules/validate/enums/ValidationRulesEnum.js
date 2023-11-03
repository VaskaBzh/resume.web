export const ValidationRulesEnum = {
    EMAIL_VALIDATION: "/^(([^<>()[\\]\\\\.,;:\\s@\"]+(\\.[^<>()[\\]\\\\.,;:\\s@\"]+)*)|.(\".+\"))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))$/",
    ONLY_NUMBERS: "/^[0-9]/",
    ONLY_LETTERS: "/^[a-z,A-Z]/",
    ONLY_UPPER_LETTERS: "/^[A-Z]/",
    ONLY_LOWER_LETTERS: "/^[a-z]/",
    LETTERS_AND_NUMBERS: "/^[a-z,A-Z,0-9]/",
    UPPER_LETTERS_AND_NUMBERS: "/^[A-Z,0-9]/",
    LOWER_LETTERS_AND_NUMBERS: "/^[a-z,0-9]/",
    // MAX_LENGTH: ">=",
    // MIN_LENGTH: "<=",
    // EQUAL: "===",
}
