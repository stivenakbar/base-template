const ckeditorInstance = $("[data-control='ckeditor']");
if(ckeditorInstance.length > 0 && typeof ClassicEditor === 'undefined') {
    throw new Error("Please include ckeditor script");
}
ckeditorInstance.each(function () {
    const componentId = $(this).attr('id');
    const editorType = $(this).data('editor-type')?.toLowerCase() ?? "classic";
    window.ArkatamaCkeditor = window.ArkatamaCkeditor ?? {};
    if (!componentId) {
        throw new Error("Please define the id of editor");
    }
    switch (editorType) {
        case "classic":
            ClassicEditor.create($(this).get(0)).then(editor => {
                window.ArkatamaCkeditor[componentId] = editor;
                $(this).parent().prev('.ckeditor-skeleton').fadeOut(200, function () {
                    $(this).next('[data-at-editor]').removeClass('d-none');
                    $(this).prev('.ckeditor-skeleton').remove();
                });
            }).catch(err => {
                throw new Error(err);
            })
        break;
    }   
});


