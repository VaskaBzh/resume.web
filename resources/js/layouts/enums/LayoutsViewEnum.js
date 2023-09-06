export const LayoutsViewEnum = {
    LayoutView: 'LayoutView.vue',
    AuthLayoutView: 'AuthLayoutView.vue',
    CalculatorLayoutView: 'CalculatorLayoutView.vue',
    ProfileLayoutView: 'ProfileLayoutView.vue',
    ReferralsLayoutView: 'ReferralsLayoutView.vue',

    getLayout: function(layoutName) {
        return this[layoutName] || this.LayoutView
    },
}
