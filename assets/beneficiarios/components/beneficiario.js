export default (ben) => ({
    data: ben,

    edit() {
        this.$dispatch(
            "edit-beneficiario", 
            JSON.parse(JSON.stringify(this.data))
        );
    },

    get nombre() {
        return [
            this.data.nom1, 
            this.data.nom2, 
            this.data.ape1, 
            this.data.ape2
        ].filter(n => Boolean(n)).join(" "); 
    }
})