export const LayoutsViewEnum = {
    LayoutView: "LayoutView",
    AuthLayoutView: "AuthLayoutView",
    CalculatorLayoutView: "CalculatorLayoutView",
    ProfileLayoutView: "ProfileLayoutView",
    ReferralsLayoutView: "ReferralsLayoutView",
    FaqLayoutView: 'FaqLayoutView',

    getLayout: function (layoutName) {
        return this[layoutName] || this.LayoutView;
    },
};
