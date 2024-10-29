<div id="loader"
class="h-screen w-screen hidden fixed-top bg-black/60"
style="z-index: 3000;">
    <div class="grid place-content-center h-full w-full">
        <div class="m-auto text-bg-dark bg-opacity-100 rounded p-2 flex flex-column justify-center items-center">
            <img src="<?= $this->asset("/img/logo-color.png") ?>" alt="loader" width="50">
            <span class="text-light d-block">Cargando...</span>
        </div>
    </div>
</div>
