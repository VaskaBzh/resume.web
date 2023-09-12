export const LayoutsViewEnum = {
    LayoutView: "LayoutView",
    AuthLayoutView: "AuthLayoutView",
    CalculatorLayoutView: "CalculatorLayoutView",
    ProfileLayoutView: "ProfileLayoutView",
    ReferralsLayoutView: "ReferralsLayoutView",

    getLayout: function (layoutName) {
        return this[layoutName] || this.LayoutView;
    },
};
