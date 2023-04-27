export default () => ({
    /** Fecha que se emplea como Referencia para hacer los calculos*/
    ctrl: new Date(),
    /**
     * Determina el numero de celdas vacias al principio de cada
     * mes.
    */
    blankSpaces: 0,
    /**
     * Determina el numero de celdas vacias al final de cada
     * mes.
    */
    blankSpacesBtm: 0,
    /**
     * El numero total de dias que tiene el mes.
    */
    totalSpaces: 0,
    /** Eventos que escucha este componenete */
    events: {
        ["@next-month.document"]: "next",
        ["@previous-month.document"]: "previous"
    },
    init() {
        this.ctrl.setDate(1);
        this.setUp();
    },
    /**
     * Organiza la info necesaria teniendo en cuenta el valor de `ctrl`
    */
    setUp() {
        this.blankSpaces = this.ctrl.getDay() % 7;
        this.totalSpaces = new Date(
            this.getYear(), this.getMonth() + 1, 0
        ).getDate();

        const _ = this.blankSpaces + this.totalSpaces;
        this.blankSpacesBtm = Math.ceil(_ / 7 ) * 7 - _;

        this.$nextTick(() => {
            this.$dispatch("date-has-changed", new Date( this.ctrl.getTime() ));
        });
    },
    /** Carga mes anterior */
    previous() {
        const m = this.getMonth();

        if (m == 0) {
            this.ctrl.setMonth(11);
        } else {
            this.ctrl.setMonth(m - 1);
        }
        this.setUp();
    },
    /** Carga siguiente mes */
    next() {
        const m = this.getMonth();

        if (m == 11) {
            this.ctrl.setMonth(0);
        } else {
            this.ctrl.setMonth(m + 1)
        }
        this.setUp();
    },
    /** Retorna el anio de ctrl */
    getYear() {
        return this.ctrl.getFullYear();
    },
    /** Retorna el mes de ctrl */
    getMonth() {
        return this.ctrl.getMonth();
    }
});
