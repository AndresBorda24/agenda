import Alpine from "alpinejs";

export default () => ({
    months: [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ],
    visualMonth: "",
    visualYear: "",
    isItToday: true,
    /** Fecha que se emplea como Referencia para hacer los calculos*/
    ctrl: new Date(),
    totalSpaces: 0,
    blankSpaces: 0,
    blankSpacesBtm: 0,
    loader: document.getElementById('calendar-days-loader'),

    init() {
        this.ctrl.setDate(1);
        this.setUp();
    },

    /** Organiza la info necesaria teniendo en cuenta el valor de `ctrl` */
    setUp() {
        Alpine.store("ctrlDate", this.ctrl);

        this.blankSpaces = this.ctrl.getDay() % 7;
        this.totalSpaces = new Date(
            this.getYear(), this.getMonth() + 1, 0
        ).getDate();

        const _ = this.blankSpaces + this.totalSpaces;
        this.blankSpacesBtm = Math.ceil(_ / 7 ) * 7 - _;

        this.setVisualMonth();
        this.setVisualYear();
        this.setIsItToday();
    },

    /** Carga mes anterior */
    change(next = true) {
        this.animate();
        const m = this.getMonth();
        this.ctrl.setMonth(m - (next ? -1 : 1));
        this.setUp();
    },

    goToday() {
        this.animate();
        this.ctrl = new Date();
        this.ctrl.setDate(1);
        this.setUp();
    },

    /** Pelicula que se muestra al cambiar de mes */
    animate() {
        this.loader.style.display = 'block';
        this.loader.animate([
            {left: '0', opacity: '50%'},
            {left:'100%', opacity: '40%'}
        ], {duration: 250, easing: 'ease-in-out'});
    },

    /** Retorna el anio de ctrl */
    getYear() {
        return this.ctrl.getFullYear();
    },

    /** Retorna el mes de ctrl */
    getMonth() {
        return this.ctrl.getMonth();
    },

    setVisualMonth() {
        this.visualMonth = this.months[ this.getMonth() ];
    },

    setVisualYear() {
        this.visualYear = this.ctrl.getFullYear();
    },

    getFullDate( day ){
        return this.getYear() + '-'
            + (this.getMonth() + 1).toString().padStart(2, '0') + '-'
            + day.toString().padStart(2, '0');
    },

    setIsItToday() {
        this.isItToday = this.ctrl.getMonth() === (new Date()).getMonth();
    }
});
