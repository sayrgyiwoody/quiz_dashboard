<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- bootstrap icon cdn  --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        {{-- font awesome 6 cdn  --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Styles -->
        @livewireStyles

        <style>
            input:valid ~ label  {
                z-index: 10;
                background-color: #fff;
                font-weight: 600;
            }

            p svg {
                transition: .5s;
            }

            p:hover svg {
                transform: translateX(4px);
            }
        </style>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts

         {{-- jquery cdn  --}}
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function(){
                $('.eye-icon').click(function(){
                    $parentNode = $(this).parents('.input-gp');
                    $pwType = $parentNode.find('input').attr('type');

                    if($pwType == "password"){
                        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
                        $parentNode.find('input').attr('type','text');
                    }else if($pwType == "text"){
                        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
                        $parentNode.find('input').attr('type','password');
                    }

                })
            })
    </script>
    </body>
</html>
