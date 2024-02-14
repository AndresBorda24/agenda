export default () => ({
    file: undefined,

    onChange( file ) {
        this.$dispath("new-file", file);
    }
});
