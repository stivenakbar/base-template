<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\{state, form, layout};
layout('components.layouts.guest');
form(LoginForm::class, 'form');

$login = function () {
    $this->validate();
    $this->form->authenticate();
    Session::regenerate();
    $this->redirect(session('url.intended', RouteServiceProvider::HOME));
};

?>

<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-100 mw-sm-500px p-10">
                    <form class="form w-100" id="kt_sign_in_form" wire:submit.prevent="login">
                        <div class="text-center mb-11">
                            <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div>
                        </div>
                        <div class="mb-9">
                            @livewire('components.logo-button', ['text' => 'Sign in with Google', 'logo' => 'assets/media/svg/brand-logos/google-icon.svg', 'href' => route('redirect')])
                        </div>
                        @livewire('components.atoms.separator', ['text' => 'or sign in with'])
                        <div class="fv-row mb-8">
                            <x-atoms.input name="email" type="email" wire:model='form.email' placeholder="Email" />
                        </div>
                        <div class="fv-row mb-3">
                            <x-atoms.input name="password" type="password" wire:model='form.password'
                                placeholder="Password" />
                        </div>
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>
                            <a href="../../demo1/dist/authentication/layouts/corporate/reset-password.html"
                                class="link-primary">Forgot Password ?</a>
                        </div>
                        <div class="d-grid mb-10">
                            <x-atoms.button action="login" type="submit">Sign In</x-atoms.button>
                        </div>
                        <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                            <a href="/register" wire:navigate class="link-primary">Sign up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Body-->
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
            style="background-image: url(assets/media/misc/auth-bg.png)">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <!--begin::Lo-->
                <a href="../../demo1/dist/index.html" class="mb-0 mb-lg-12">
                    <img alt="Logo" src="assets/media/logos/custom-1.png" class="h-60px h-lg-75px" />
                </a>
                <!--end::Logo-->
                <!--begin::Image-->
                <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                    src="assets/media/misc/auth-screens.png" alt="" />
                <!--end::Image-->
                <!--begin::Title-->
                <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and
                    Productive</h1>
                <!--end::Title-->
                <!--begin::Text-->
                <div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,
                    <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>introduces a
                    person they’ve interviewed
                    <br />and provides some background information about
                    <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>and their
                    <br />work following this is a transcript of the interview.
                </div>
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Aside-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
