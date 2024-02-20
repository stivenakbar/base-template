<div x-data="fileUpload()" x-init="init()" class="col-sm-8">
  <div class="file-upload" x-on:drop="isDropping = false" x-on:dragover.prevent="isDropping = true">
    <input type="file" id="file-upload" multiple class="d-none" @change="handleFileSelect($event)" />
    <div class="d-flex align-items-center ">
      <span class="file-upload__icon me-5">
        <i class="ki-outline ki-file-up "></i>
      </span>
      <label class="file-upload__guide" for="file-upload">
        <h4 class="text-3xl">Select a file or Drag and Drop Here</h3>
          <p class="italic text-slate-400">JPG, PNG or PDF, file size no more than 5 MB</p>
      </label>
    </div>
    <label class="file-upload__select-btn btn btn-primary" for="file-upload">Select File</label>
    <div class="file-upload__overlay" x-show="isDropping" x-cloak x-on:dragleave.prevent="isDropping = false">
      <span class="fs-6">Release file to upload!</span>
    </div>
  </div>

  <div class="file-upload__previews">
    <template x-for="(file, index) in uploadingFiles">
      <div class="preview-item" :key="index">
        <i class="ki-outline ki-file preview-item__icon"></i>
        <div class="preview-item__body">
          <div class="d-flex w-100 justify-content-between ">
            <div class="preview-item__actions">
              <span x-text="file.parsedName"> </span>
              <a href="javascript:void(0)">Preview</a>
            </div>
            <span x-text="file.size"></span>
          </div>
          <div class="preview-item__bar">
            <div class="preview-item__proggress" :style="`width: ${file.progress+ '%'}`"></div>
          </div>
        </div>
      </div>
    </template>
    @if (count($files))
      @foreach ($files as $file)
        {{-- @dd($file) --}}
        <div class="preview-item">
          <i class="ki-outline ki-file preview-item__icon"></i>
          <div class="preview-item__body">
            <div class="d-flex w-100 justify-content-between ">
              <div class="preview-item__actions">
                <span>{{ humanizeName($file->getFileName()) }}</span>
                <a href="{{ $file->temporaryUrl() }}" target="_blank">Preview</a>
                <a href="javascript:void(0)" @click="removeUpload('{{ $file->getFilename() }}')">Remove</a>
              </div>
              <span>{{ humanizeSize($file->getSize()) }}</span>
            </div>
            <div class="preview-item__proggress" :style="`background-size:${progress}% 100% ;`"></div>
          </div>
        </div>
      @endforeach
    @endif
  </div>

  <script>
    function fileUpload() {
      return {
        isDropping: false,
        isUploading: false,
        uploadingFiles: [],
        dragCounter: 0,
        progress: 0,
        init() {
          this.$watch('isDropping', val => {
            console.log(val)
          })
        },
        handleFileSelect(event) {
          if (event.target.files.length) {
            this.uploadFiles(event.target.files)
          }
        },
        handleDragEnter() {
          this.isDropping = true;
        },
        handleDragLeave() {
          this.dragCounter--;
          if (this.dragCounter === 0) {
            this.isDropping = false;
          }
        },

        handleFileDrop(event) {
          if (event.dataTransfer.files.length > 0) {
            this.uploadFiles(event.dataTransfer.files)
          }
        },
        uploadFiles(files) {
          this.isUploading = true;
          const $this = this;
          Array.from(files).forEach((file, index) => {
            $this.uploadingFiles.push({
              name: file.name,
              parsedName: this.humanizeName(file.name),
              size: this.humanizeSize(file.size),
              progress: 0
            });
            @this.upload('files', file,
              function(success) {
                const index = $this.uploadingFiles.findIndex(f => f.name === file.name);
                if (index !== -1) $this.uploadingFiles.splice(index, 1);
              },
              function(error) {
                console.log('error', error)
              },
              function(event) {
                const index = $this.uploadingFiles.findIndex(f => f.name === file.name);
                if (index !== -1) {
                  $this.uploadingFiles[index].progress = event.detail.progress;
                }
              }
            )
          });
        },
        humanizeSize(size) {
          const i = Math.floor(Math.log(size) / Math.log(1024));
          return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
        },
        humanizeName(name) {
          const extension = name.slice(name.lastIndexOf('.'));
          const baseName = name.slice(0, name.lastIndexOf('.'));
          if (baseName.length <= 20) return name + extension;
          const slicedName = baseName.slice(0, 20);
          return `${slicedName}..${extension}`;
        },
        removeUpload(filename) {
          @this.removeUpload('files', filename)
        },
      }
    }
  </script>
</div>
