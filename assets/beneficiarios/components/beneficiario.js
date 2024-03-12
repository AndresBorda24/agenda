export default (ben) => ({
    data: ben,

    edit() {
        const [nom1, nom2, ape1, ape2] = this.data.nombre.split(/\s+/);
        const detail = {
            nom1,
            nom2,
            ape1,
            ape2,
            id: this.data.id,
            sexo: this.data.sexo,
            tipo_doc: this.data.tipo_doc,
            documento: this.data.documento,
            parentesco: this.data.parentesco,
            fecha_nac:  this.data.fecha_nac,
        };

        this.$dispatch("edit-beneficiario", detail);
    }
})