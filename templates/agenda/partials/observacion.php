<div x-data style="grid-column: 1 / -1;" >
  <label 
    for="cita-observacion" 
    class="form-label fw-bold m-0"
    >Observación</label>
    <p id="cita-observacion-desc" class="small mb-2">
      Escribe aquí si tienes algún apunte que realizar o quieres explicar un poco sobre el motivo de tu cita.
    </p>
    <textarea 
    name="cita-observacion" 
    style="height: 100px;"
    id="cita-observacion" 
    aria-labelledby="cita-observacion-desc"
    x-model="$store.agenda.observacion"
    class="form-control form-control-sm"
    placeholder="Opcional"
  ></textarea>
</div>
