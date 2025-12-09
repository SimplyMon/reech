<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <title>{{ isset($title) ? $title . ' Management' : 'Management' }}</title>
    @vite(['resources/css/app.css'])
</head>

<body class="text-gray-900 antialiased" style="background-color: #ECECEC; font-family: 'Poppins', sans-serif;">

    <div class="flex min-h-screen">
        @if ($showSidebar ?? true)
            <x-layouts.sidebar />
        @endif

        <main class="{{ $showSidebar ?? true ? 'flex-1 p-6' : 'w-full p-6' }}">
            {{ $slot }}
        </main>
    </div>
    @vite(['resources/js/app.js'])
</body>

</html>
