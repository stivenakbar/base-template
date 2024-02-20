<div>
  <x-mollecules.modal id="add-menu_modal" action="store" wire:ignore.self>
    <x-slot:title>Add Menu</x-slot:title>
    <div class="">
      <div class="mb-6">
        <x-atoms.form-label required>Name</x-atoms.form-label>
        <x-atoms.input name="name" wire:model='name' />
      </div>
      <div class="mb-6">
        <x-atoms.form-label required>Modul</x-atoms.form-label>
        <x-atoms.input name="module" wire:model='module' />
      </div>
      <div class="mb-6">
        <x-atoms.form-label required>Url</x-atoms.form-label>
        <x-atoms.input name="url" wire:model='url' />
      </div>
      <div class="mb-6">
        <x-atoms.form-label required>Icon</x-atoms.form-label>
        <div class="dropdown">
          @if ($icon != '')
            <button id="icon" class="form-select w-100" type="button" data-bs-toggle="dropdown"
              aria-expanded="false" style="text-align:left;">
              <i class="{{ $icon }}"></i>
              <span class="ml-1">
                {{ $icon }}
              </span>
            </button>
          @else
            <button id="icon" class="form-select w-100" type="button" data-bs-toggle="dropdown"
              aria-expanded="false" style="text-align:left;">
              Select Icon
            </button>
          @endif
          <ul class="dropdown-menu w-100 overflow-auto" style="height: 200px;">
            @foreach ($icons as $ic)
              <li><a id="{{ $ic->class }}"
                  class="dropdown-item icons @if ($icon == $ic->class) bg-light @endif"
                  style='cursor :pointer;'><span class="menu-icon"><i class="{{ $ic->class }}"></i>
                    {{ $ic->class }}</span></a></li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="mb-6">
        <x-atoms.form-label required>Role</x-atoms.form-label>
        <select wire:model="role" class="form-select " data-control="select2" data-hide-search="true"
          data-placeholder="Select Parent" name="target_assign">
          <option value="all">All</option>
          @foreach ($roles as $role)
            <option value="{{ $role->name }}">{{ $role->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-6">
        <x-atoms.form-label required>Order</x-atoms.form-label>
        <x-atoms.input name="order" type="number" wire:model='order' />
      </div>
      <div class="mb-6">
        <x-atoms.form-label>Parent</x-atoms.form-label>
        <select wire:model="parent_id" class="form-select " data-control="select2" data-hide-search="true"
          data-placeholder="Select Parent" name="target_assign">
          <option value="0">No Parent</option>
          @foreach ($parents as $parent)
            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-6">
        <x-atoms.form-label required>Location</x-atoms.form-label>
        <x-atoms.radio-group>
          <x-atoms.radio id="locat-1" name="locat" value="sidebar" wire:model='location'>Sidebar</x-atoms.radio>
          <x-atoms.radio id="locat-0" name="locat" value="topbar" wire:model='location'>Topbar</x-atoms.radio>
        </x-atoms.radio-group>
      </div>
      <div class="mmb-6">
        <x-atoms.form-label required>Status</x-atoms.form-label>
        <x-atoms.radio-group>
          <x-atoms.radio id="status-1" name="status" value="1" wire:model='is_active'>Active</x-atoms.radio>
          <x-atoms.radio id="status-0" name="status" value="0" wire:model='is_active'>Process</x-atoms.radio>
        </x-atoms.radio-group>
      </div>
      <x-slot:footer>
        <button class="btn-primary btn" type="submit">Submit</button>
      </x-slot:footer>
    </div>
  </x-mollecules.modal>
  <x-mollecules.modal id="edit-menu_modal" action="update" wire:ignore.self>
    <x-slot:title>Edit Menu</x-slot:title>
    <div class="">
      <div class="mb-6">
        <x-atoms.form-label required>Name</x-atoms.form-label>
        <x-atoms.input name="name" wire:model='name' />
      </div>
      <div class="mb-6">
        <x-atoms.form-label required>Modul</x-atoms.form-label>
        <x-atoms.input name="module" wire:model='module' />
      </div>
      <div class="mb-6">
        <x-atoms.form-label required>Url</x-atoms.form-label>
        <x-atoms.input name="url" wire:model='url' />
      </div>
      <div class="mb-6">
        <x-atoms.form-label required>Icon</x-atoms.form-label>
        <div class="dropdown">
          @if ($icon != '')
            <button id="icon" class="form-select w-100" type="button" data-bs-toggle="dropdown"
              aria-expanded="false" style="text-align:left;">
              <i class="{{ $icon }}"></i>
              <span class="ml-1">
                {{ $icon }}
              </span>
            </button>
          @else
            <button id="icon" class="form-select w-100" type="button" data-bs-toggle="dropdown"
              aria-expanded="false" style="text-align:left;">
              Select Icon
            </button>
          @endif
          <ul class="dropdown-menu w-100 overflow-auto" style="height: 200px;">
            @foreach ($icons as $ic)
            
              <li ><a id="{{ $ic->class }}" class="dropdown-item icons @if(str_replace("  fs-2","",$icon) == $ic->class) bg-light @endif" style='cursor :pointer;'><span class="menu-icon"><i
                      class="{{ $ic->class }}"></i>
                    {{ $ic->class }}</span></a></li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="mb-6">
        <x-atoms.form-label required>Role</x-atoms.form-label>
        <select wire:model="role" class="form-select " data-control="select2" data-hide-search="true"
          data-placeholder="Select Parent" name="target_assign">
          <option value="all">All</option>
          @foreach ($roles as $role)
            <option value="{{ $role->name }}">{{ $role->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-6">
        <x-atoms.form-label required>Order</x-atoms.form-label>
        <x-atoms.input name="order" type="number" wire:model='order' />
      </div>
      <div class="mb-6">
        <x-atoms.form-label>Parent</x-atoms.form-label>
        <select wire:model="parent_id" class="form-select " data-control="select2" data-hide-search="true"
          data-placeholder="Select Parent" name="target_assign">
          <option value="">No Parent</option>
          @foreach ($parents as $parent)
            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-6">
        <x-atoms.form-label required>Location</x-atoms.form-label>
        <x-atoms.radio-group>
          <x-atoms.radio id="locat-1" name="locat" value="sidebar" wire:model='location'>Sidebar</x-atoms.radio>
          <x-atoms.radio id="locat-0" name="locat" value="topbar" wire:model='location'>Topbar</x-atoms.radio>
        </x-atoms.radio-group>
      </div>
      <div class="mb-6">
        <x-atoms.form-label required>Status</x-atoms.form-label>
        <x-atoms.radio-group>
          <x-atoms.radio id="status-1" name="status" value="1" wire:model='is_active'>Active</x-atoms.radio>
          <x-atoms.radio id="status-0" name="status" value="0" wire:model='is_active'>Process</x-atoms.radio>
        </x-atoms.radio-group>
      </div>
      <x-slot:footer>
        <button class="btn-primary btn" type="submit">Submit</button>
      </x-slot:footer>
    </div>
  </x-mollecules.modal>
</div>

@push('scripts')
  <script>
    document.addEventListener('livewire:initialized', () => {
      function refreshTable() {
        window.LaravelDataTables['menus-table'].ajax.reload();
      };
      @this.on('menu-added', () => {
        $('#add-menu_modal').modal('hide');
        refreshTable();
        location.reload();
      });
      @this.on('menu-deleted', () => {
        refreshTable();
        location.reload();
      });
      @this.on('menu-edit', () => {
        $('#edit-menu_modal').modal('show');
        refreshTable();
      });
      @this.on('menu-updated', () => {
        $('#edit-menu_modal').modal('hide');
        refreshTable();
        location.reload();
      });
      $('.icons').click(function(e) {
        e.preventDefault();
        var teks = $(this).attr('id');
        @this.set('icon', teks);
      });
    });
  </script>
@endpush
