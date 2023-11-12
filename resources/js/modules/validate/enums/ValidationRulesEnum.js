export const ValidationRulesEnum = {
    email: /^((?!\.)[\w-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/,
    number: /^[0-9]/,
    string: /^[a-z,A-Z]/,
    upper: /^[A-Z]/,
    lower: /^[a-z]/,
    string_number: /^[a-z,A-Z,0-9]/,
    upper_number: /^[A-Z,0-9]/,
    lower_number: /^[a-z,0-9]/,
}
