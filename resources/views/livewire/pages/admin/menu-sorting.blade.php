<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid gap-10"
    id="kt_create_account_stepper">
    <!--begin::Aside-->
    <div class="card d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px w-xxl-400px">
        <!--begin::Wrapper-->
        <div class="card-body px-6 px-lg-10 px-xxl-15 py-20">
            <!--begin::Nav-->
            <h3 class="card-title align-items-start flex-column mb-10">
                Sidebar Sorting
            </h3>
            <div class="stepper-nav" wire:sortable="updateMenuOrder">
                @foreach ($sidebarItem as $item)
                    <div wire:sortable.item="{{ $item->id }}" class="stepper-item" data-kt-stepper-element="nav">
                        <!--begin::Wrapper-->
                        <div wire:sortable.handle class="stepper-wrapper">
                            <!--begin::Icon-->
                            <div class="stepper-icon w-40px h-40px">
                                <i class="ki-duotone ki-check fs-2 stepper-check"></i>
                                <span class="stepper-number"><i class="{{ $item->icon }}"></i></span>
                            </div>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">{{ $item->name }}</h3>
                                {{-- <div class="stepper-desc fw-semibold">Setup Your Account Settings</div> --}}
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                @endforeach
                <!--begin::Step 2-->
            </div>
            <!--end::Nav-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--begin::Aside-->
    <!--begin::Content-->
    <div class="card d-flex flex-row-fluid flex-center">
        <h3 class="card-title align-items-start flex-column mb-10">
            Topbar Sorting
        </h3>
        <ul wire:sortable="updateMenuOrder" class="nav nav-pills nav-pills-custom mb-3">
            @foreach ($topbarItem as $item)
                <!--begin::Item-->
                <li wire:sortable.item="{{ $item->id }}" class="nav-item mb-3 me-3 me-lg-6">
                    <!--begin::Link-->
                    <a wire:sortable.handle
                        class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                        id="kt_stats_widget_16_tab_link_2" data-bs-toggle="pill" href="#kt_stats_widget_16_tab_2">
                        <!--begin::Icon-->
                        <div class="nav-icon mb-3">
                            <i class="{{ $item->icon }}">
                            </i>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Title-->
                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{ $item->name }}</span>
                        <!--end::Title-->
                        <!--begin::Bullet-->
                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                        <!--end::Bullet-->
                    </a>
                    <!--end::Link-->
                </li>
            @endforeach
        </ul>
    </div>
    <!--end::Content-->
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('update', () => {
                location.reload();
            })
        })
    </script>
@endpush
