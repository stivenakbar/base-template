<div>
    @php
        $count_menus = count($menus);
    @endphp
    @for ($i = 0; $i < count($menus); $i += 3)
        <div class="row g-5 g-xl-8">
            @if ($count_menus)
                <div class="col-xl-4">
                    <!--begin::Statistics Widget 5-->
                    <div class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <i class="{{ $menus[$i]->icon }} text-white">

                            </i>
                            <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $menus[$i]->name }}</div>
                            <div class="fw-semibold text-white">{{ $menus[$i]->url }}</div>
                            <div class="form-check form-switch pt-4 pb-10">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="{{ $menus[$i]->module }}" wire:model="acces.{{ $menus[$i]->module }}"
                                    value="{{ $menus[$i]->module }}">
                            </div>
                            @php
                                $access = \App\Models\AccessModel::where('menus_id', '=', $menus[$i]->id)->get();
                            @endphp
                            @foreach ($access as $item)
                                <div class="pt-3 form-check">
                                    <input type="checkbox" class="form-check-input" type="checkbox" name=""
                                        id="{{ $item->module }}" wire:model="acces.{{ $item->module }}">
                                    <label class="form-check-label" style="color: white"
                                        for="{{ $item->module }}">{{ $item->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Statistics Widget 5-->
                </div>
            @endif
            @if ($count_menus - 1 > 0)
                <div class="col-xl-4">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <i class="{{ $menus[$i + 1]->icon }} text-white">

                            </i>
                            <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $menus[$i + 1]->name }}</div>
                            <div class="fw-semibold text-white">{{ $menus[$i + 1]->url }}</div>
                            <div class="form-check form-switch pt-4 pb-10">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="{{ $menus[$i + 1]->module }}" wire:model="acces.{{ $menus[$i + 1]->module }}"
                                    value="{{ $menus[$i + 1]->module }}">
                            </div>
                            @php
                                $access = \App\Models\AccessModel::where('menus_id', '=', $menus[$i + 1]->id)->get();
                            @endphp
                            @foreach ($access as $item)
                                <div class="pt-3 form-check">
                                    <input type="checkbox" class="form-check-input" type="checkbox" name=""
                                        id="{{ $item->module }}" wire:model="acces.{{ $item->module }}">
                                    <label class="form-check-label" style="color: white"
                                        for="{{ $item->module }}">{{ $item->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
            @endif
            @if ($count_menus - 2 > 0)
                <div class="col-xl-4">
                    <!--begin::Statistics Widget 5-->
                    <div class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <i class="{{ $menus[$i + 2]->icon }} text-white">

                            </i>
                            <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $menus[$i + 2]->name }}</div>
                            <div class="fw-semibold text-white">{{ $menus[$i + 2]->url }}</div>
                            <div class="form-check form-switch pt-4 pb-10">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="{{ $menus[$i + 2]->module }}" wire:model="acces.{{ $menus[$i + 2]->module }}"
                                    value="{{ $menus[$i + 2]->module }}">
                            </div>
                            @php
                                $access = \App\Models\AccessModel::where('menus_id', '=', $menus[$i + 2]->id)->get();
                            @endphp
                            @foreach ($access as $item)
                                <div class="pt-3 form-check">
                                    <input type="checkbox" class="form-check-input" type="checkbox" name=""
                                        id="{{ $item->module }}" wire:model="acces.{{ $item->module }}">
                                    <label class="form-check-label" style="color: white"
                                        for="{{ $item->module }}">{{ $item->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Statistics Widget 5-->
                </div>
            @endif
        </div>
        @php
            $count_menus -= 3;
        @endphp
    @endfor
    <button wire:click="save" class="btn btn-primary">Save</button>
</div>
@push('css')
    <style>
        .form-check-input:checked {
            background-color: #FAC213;
            /* Change this to the color you want */
            border-color: #FAC213;
            /* Change this to the color you want */
        }
    </style>
@endpush
@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            // let acces = @json($permissions);
            // acces.forEach(function(item) {
            //     $(`#${item}`).prop('checked', true);
            // });

            @this.on('save', () => {
                let acces = [];
                $('input[type="checkbox"]:checked').each(function() {
                    acces.push($(this).val());
                });
                @this.set('permissions', acces);
                Swal.fire({
                    text: "Update success",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Yes",
                    customClass: {
                        confirmButton: "btn btn-danger",
                    },
                });
            });
        })
    </script>
@endpush
