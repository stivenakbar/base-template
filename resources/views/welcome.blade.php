<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/global/plugins.bundle.css') }}">

 
</head>

<body>
    <div>
        @livewire('components.atoms.button', ['text' => 'Submit'])
    </div>
    <div>
        @livewire('components.atoms.input', ['type' => 'text', 'class' => 'bg-transparent', 'placeholder' => 'email', 'name' => 'email'])
    </div>
    <div>
        @livewire('components.logo-button', ['text' => 'Sign in with google', 'logo' => 'assets/media/svg/brand-logos/google-icon.svg', 'href' => '#'])
    </div>
       <!-- Scripts -->

       <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
       <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
       <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
</body>

</html>
