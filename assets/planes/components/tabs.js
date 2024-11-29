export default ( initialTab ) => ({
    tab: initialTab,
    events: {
        ["@next-tab"]: "next",
        ["@prev-tab"]: "prev"
    },

    init() {
        this.$watch('tab', () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        })
    },

    next() {
        this.tab++;
    },

    prev() {
        this.tab--;
    }
});
