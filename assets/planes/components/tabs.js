export default () => ({
    tab: 1,
    events: {
        ["@next-tab"]: "next",
        ["@prev-tab"]: "prev"
    },

    next() {
        this.tab++;
    },

    prev() {
        this.tab--;
    }
});
