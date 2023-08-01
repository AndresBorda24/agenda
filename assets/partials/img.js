export default () => ({
    show: false,
    bindings: {
        ["@load"]: "showOn",
        ["x-show"]: "show",
        ["x-transition"]: "",
    },

    init() {
        const src = this.$el.dataset.src || null;
        if (src) this.$el.src = src;
    },

    showOn() {
        this.show = true;
    }
});
