import './plugins/_init';

window.getLivewireInstance = (element) => {
    const livewireId = $(element).closest("[wire\\:id]").attr("wire:id");
    return window.Livewire.find(livewireId);
}


$('.modal').on('hidden.bs.modal', function () {
    const livewireInstance = getLivewireInstance(this);
    if (livewireInstance) {
        livewireInstance.dispatch('reset');
    }
})

document.addEventListener("swal", function (e) {
    const swalParam = e?.__livewire?.params[0];
    let icon, buttonStyle ;
    switch (swalParam?.type) {
        case "success":
            icon = "success";
            buttonStyle = "btn btn-success";
            break;
        default:
            icon = "info";
            break;
    }
    Swal.fire({
        text: swalParam?.text ,
        icon: icon,
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
            confirmButton: buttonStyle,
        }
    });
})

