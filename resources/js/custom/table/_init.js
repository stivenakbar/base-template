$('[data-action-delete]').each(function (element) {
    $(this).on('click', function () {
        const livewireInstance = getLivewireInstance($(this));
        const actionParams = $(this).data('action-params');
        const actionName = $(this).data('action');
        const actionReceiver = $(this).data('action-receiver');
    
        Swal.fire({
            text: 'Are you sure you want to remove?',
            icon: 'warning',
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                livewireInstance.dispatchTo(actionReceiver,actionName,{
                    ...actionParams,
                });
            }
        });
    });
});

$('[data-action-search]').on('change', function(){
    const tableId = $(this).data('table-id');
    window.LaravelDataTables[`${tableId}`].search($(this).val()).draw();
})



