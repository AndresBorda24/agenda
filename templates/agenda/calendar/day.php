<div
x-data="calendarDay( day )"
@click="showHours"
x-bind="events"
class="small text-center calendar-days position-relative bg-white"
:class="{'has-dates': hasDate}">
    <div class="d-block small p-1 border-bottom border-dasshed-light mb-1">
        <span
        today="<?= date("Y-m-d")?>"
        x-text="day"
        :class="{
            'px-2 rounded-bottom text-bg-primary': date == $el.getAttribute('today')
        }"></span>
    </div>
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
