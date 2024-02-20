<div>
  <div>
    <h2 class="mb-3">Ck editor</h2>
    <x-atoms.ckeditor></x-atoms.ckeditor>
  </div>
  <div class="mt-5">
    <h2 class="mb-3">Select 2</h2>
    <x-atoms.select2>
      <option selected disabled></option>
      <option value="a">ASFSD</option>
      <option value="b">asdfs</option>
      <option value="c">asdfs</option>
      <option value="n">asdfs</option>
      <option value="m">asdfs</option>
    </x-atoms.select2>
  </div>
  <div class="mt-5">
    <h2 class="mb-3">Dropdown</h2>
    <x-mollecules.dropdown>
      <x-slot:button>Click Me</x-slot:button>
      <x-slot:body> 
        <div class="menu-item">
          <a href="#" class="menu-link px-5 py-3">
            <span class="menu-title">Example Link</span>
          </a>
        </div>
        <div class="menu-item">
          <a href="#" class="menu-link px-5 py-3">
            <span class="menu-title">Example Link</span>
          </a>
        </div>
        <div class="menu-item">
          <a href="#" class="menu-link px-5 py-3">
            <span class="menu-title">Example Link</span>
          </a>
        </div>
      </x-slot:body>
    </x-mollecules.dropdown>
  </div>
  <div class="mt-5">
    <h2 class="mb-3">Textarea</h2>
    <x-atoms.textarea></x-atoms.textarea>
  </div>
  <div class="mt-5">
    <h2 class="mb-3">Dropzone</h2>
    <x-atoms.dropzone />
  </div>
  <div class="mt-5">
    <h2 class="mb-3">Custom File Upload</h2>
    <livewire:components.atoms.file-upload />
  </div>
</div>

@push('css')
  <link rel="stylesheet" href="{{ asset('assets/plugins/custom/select2/select2.bundle.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/custom/dropzone/dropzone.bundle.css') }}">
@endpush

@push('script-plugins')
  <script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
  <script src="{{ asset('assets/plugins/custom/select2/select2.bundle.js') }}"></script>
  <script src="{{ asset('assets/plugins/custom/dropzone/dropzone.bundle.js') }}"></script>
@endpush
