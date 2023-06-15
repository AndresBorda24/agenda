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
    loader: document.getElementById('calendar-days-loader'),

    init() {
        this.ctrl.setDate(1);
        this.setUp();
    },

    /**
     * Organiza la info necesaria teniendo en cuenta el valor de `ctrl`
    */
    setUp() {
        Alpine.store("ctrlDate", this.ctrl);

        this.blankSpaces = this.ctrl.getDay() % 7;
        this.totalSpaces = new Date(
            this.getYear(), this.getMonth() + 1, 0
        ).getDate();

        const _ = this.blankSpaces + this.totalSpaces;
        this.blankSpacesBtm = Math.ceil(_ / 7 ) * 7 - _;

        this.$nextTick(() => {
            this.$dispatch("date-has-changed");
        });
    },

    /** Carga mes anterior */
    previous() {
        this.loader.style.display = 'block';
        this.loader.animate([
            {left: '0', opacity: '100%'},
            {left:'100%', opacity: '70%'}
        ], {duration: 300, easing: 'ease-in'});
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
        this.loader.style.display = 'block';
        this.loader.animate([
            {left: '0', opacity: '100%'},
            {left:'100%', opacity: '70%'}
        ], {duration: 300, easing: 'ease-in'})
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
