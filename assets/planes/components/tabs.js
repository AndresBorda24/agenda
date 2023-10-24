export default ( initialTab ) => ({
    tab: initialTab,
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
