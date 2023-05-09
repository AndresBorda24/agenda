<div
x-data="calendarDay( day )"
@click="showHours"
x-bind="events"
class="small text-center calendar-days position-relative bg-white"
:class="{'has-dates': hasDate}">
    <span
    x-text="day"
    class="d-block small p-1 border-bottom border-dasshed-light mb-1"></span>
    <!-- Si el dia corresponde a alguna fecha de la agenda -->
    <template x-if="hasDate">
        <div class="d-flex gap-1 flex-wrap calendar-days-medicos-wrapper justify-content-center">
            <template x-for="med in medicos">
                <div
                class="border p-2 rounded-bottom"
                :class="getStyles( med )"></div>
            </template>
        </div>
    </template>
</div>
