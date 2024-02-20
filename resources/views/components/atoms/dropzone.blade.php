@props([
    'name',
    'id',
    'accept' => 'image/*',
    'multiple' => false,
    'disabled' => false,
    'maxFiles' => 1,
    'maxFileSize' => 2,
    'value' => null,
    'required' => false,
    'options' => [
        'unique' => false,
        'deleteOnChange' => false,
        'initializable' => false,
        'direct' => false,
        'filename' => 'image',
        'folder' => 'media',
    ],
])

<div class="col-lg-10">
  <div class="dropzone dropzone-queue mb-2" id="kt_dropzonejs_example_3">
    <div class="dropzone-panel mb-lg-0 mb-2">
      <a class="dropzone-select btn btn-sm btn-primary me-2">Attach files</a>
      <a class="dropzone-remove-all btn btn-sm btn-light-primary">Remove All</a>
    </div>

    <!--begin::Items-->
    <div class="dropzone-items wm-200px">
      <div class="dropzone-item" style="display:none">
        <!--begin::File-->
        <div class="dropzone-file">
          <div class="dropzone-filename" title="some_image_file_name.jpg">
            <span data-dz-name>some_image_file_name.jpg</span>
            <strong>(<span data-dz-size>340kb</span>)</strong>
          </div>

          <div class="dropzone-error" data-dz-errormessage></div>
        </div>
        <!--end::File-->

        <!--begin::Progress-->
        <div class="dropzone-progress">
          <div class="progress">
            <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100"
              aria-valuenow="0" data-dz-uploadprogress>
            </div>
          </div>
        </div>
        <!--end::Progress-->

        <!--begin::Toolbar-->
        <div class="dropzone-toolbar">
          <span class="dropzone-delete" data-dz-remove><i class="bi bi-x fs-1"></i></span>
        </div>
        <!--end::Toolbar-->
      </div>
    </div>
    <!--end::Items-->
  </div>
  <!--end::Dropzone-->

  <!--begin::Hint-->
  <span class="form-text text-muted">Max file size is 1MB and max number of files is 5.</span>
  <!--end::Hint-->
</div>


@push('scripts')
  <script>
    const id = "#kt_dropzonejs_example_3";
    const dropzone = document.querySelector(id);

    // set the preview element template
    var previewNode = dropzone.querySelector(".dropzone-item");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var myDropzone = new Dropzone(id, { // Make the whole body a dropzone
      url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
      parallelUploads: 20,
      maxFilesize: 1, // Max filesize in MB
      previewTemplate: previewTemplate,
      previewsContainer: id + " .dropzone-items", // Define the container to display the previews
      clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
    });

    myDropzone.on("addedfile", function(file) {
      const dropzoneItems = dropzone.querySelectorAll('.dropzone-item');
      dropzoneItems.forEach(dropzoneItem => {
        dropzoneItem.style.display = '';
      });
    });

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
      const progressBars = dropzone.querySelectorAll('.progress-bar');
      progressBars.forEach(progressBar => {
        progressBar.style.width = progress + "%";
      });
    });

    myDropzone.on("sending", function(file) {
      // Show the total progress bar when upload starts
      const progressBars = dropzone.querySelectorAll('.progress-bar');
      progressBars.forEach(progressBar => {
        progressBar.style.opacity = "1";
      });
    });

    // Hide the total progress bar when nothing"s uploading anymore
    myDropzone.on("complete", function(progress) {
      const progressBars = dropzone.querySelectorAll('.dz-complete');

      setTimeout(function() {
        progressBars.forEach(progressBar => {
          progressBar.querySelector('.progress-bar').style.opacity = "0";
          progressBar.querySelector('.progress').style.opacity = "0";
        });
      }, 300);
    });
  </script>
@endpush
