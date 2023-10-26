export default () => ({
    images: [],
    loader: null,
    current: 0,
    sliceTime: 15,
    timeout: undefined,

    init() {
        this.images = this.$el.dataset.images
            ?.split(";")
            .map(e => e.trim())
            .filter(e => e !== "");

        if (this.areThereImages) {
            this.$nextTick(() => {
                this.loader = this.$el.querySelector('[progress-bar-slider]')
                this.resetTimeout()
            });
        }
    },

    next() {
        this.current = (this.current + 1) % this.total;
        this.resetTimeout()
    },

    prev() {
        this.current = (this.current === 0)
            ? this.total - 1
            : (this.current - 1) % this.total;
        this.resetTimeout();
    },

    setCurrent( i ) {
        this.current = i;
        this.resetTimeout();
    },

    resetTimeout() {
        if (this.timeout !== undefined)
            window.clearTimeout(this.timeout);

        this.setTimeoutAnimation()
        this.timeout = window.setInterval(() => {
            this.setTimeoutAnimation()
            this.next()
        }, this.sliceTime * 1000 );
    },

    setTimeoutAnimation() {
        this.loader?.animate([
                { width: "100%" },
                { width: "0%" }
            ], { duration: this.sliceTime * 1000 });
    },

    get visible() {
        return this.images.slice(this.current, this.current + this.max);
    },

    get total() {
        return this.images.length;
    },

    get areThereImages() {
        return this.total > 0;
    }
});
