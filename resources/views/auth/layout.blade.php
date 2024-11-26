<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Authentication' }}</title>
    <link rel="icon" type="image/png" href="storage/img/CommonImg/blacklogo.png">
    @vite('resources/css/app.css')

</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md space-y-6 z-10">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('/storage/img/CommonImg/BrandLogo.png') }}" alt="App Logo" class="h-16 w-auto">
            </div>

            @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
            @endif

            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
                <strong class="font-bold">Error!</strong>
                <ul class="mt-1 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <div id="particles-js" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
    <script src="{{ mix('resources/js/particles-config.js') }}"></script>
</body>

</html>