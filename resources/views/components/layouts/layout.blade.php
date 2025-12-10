<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <title>{{ isset($title) ? $title . ' Management' : 'Management' }}</title>
    @vite(['resources/css/app.css'])
</head>

<body class="text-gray-900 antialiased" style="background-color: #ECECEC; font-family: 'Montserrat', sans-serif;">

    <div class="flex min-h-screen">

        @if ($showSidebar ?? true)
            <x-layouts.sidebar />
        @endif

        <main class="{{ $showSidebar ?? true ? 'flex-1 p-6' : 'w-full p-6' }} transition-all duration-300">
            {{ $slot }}
        </main>
    </div>

    @vite(['resources/js/app.js'])


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('login_success'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: '{{ session('login_success') }}'
                });
            @endif
        });
    </script>
</body>

</html>
