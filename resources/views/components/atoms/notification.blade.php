<?php
$isReaded = isset($notifData['read_at']);
?>

<div class="notification {{ $isReaded ? 'notification--readed' : 'notification--unreaded' }}"
  @if (!$isReaded) wire:click="markAsRead('{{ $notifData['id'] }}')" wire:loading.class='notification--marking' wire:target="markAsRead('{{ $notifData['id'] }}')" @endif
  title="{{ !$isReaded ? 'Mark As Read' : '' }}">
  <!--begin::Section-->
  <div class="d-flex align-items-center">
    <!--begin::Symbol-->
    <div class="symbol symbol-35px me-4">
      <span class="symbol-label bg-light-primary">
        <i class="ki-outline ki-abstract-28 fs-2 text-primary"></i>
      </span>
    </div>
    <!--end::Symbol-->
    <!--begin::Title-->
    <div class="mb-0 me-2">
      <a href="{{ $notifData['cta'] }}"
        class="fs-6 text-gray-800 text-hover-primary fw-bold">{{ $notifData['title'] }}</a>
      <div class="text-gray-400 fs-7">
        {{ $notifData['desc'] }}
      </div>
    </div>
    <!--end::Title-->
  </div>
  <!--end::Section-->
  <!--begin::Label-->
  <span class="badge badge-light fs-8">1 hr</span>
  <!--end::Label-->
</div>
