<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to AssetsTnt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Optional custom keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 1s ease-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-yellow-300 via-yellow-600 to-yellow-900 min-h-screen flex flex-col justify-between text-white">

    <!-- Content Wrapper -->
    <div class="flex-grow flex items-center justify-center px-6">
        <div class="text-center space-y-8 animate-fadeInUp">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-24 w-24 rounded-full shadow-lg border-4 border-white animate-bounce">
            
            <h1 class="text-4xl font-extrabold drop-shadow-lg">Welcome to <span class="text-yellow-100">AssetsTnt</span></h1>
            
            <p class="text-lg max-w-xl mx-auto text-yellow-100">Your go-to platform for managing assets efficiently with Laravel + Livewire.</p>
            
            <a href="{{ route('login') }}" class="inline-block bg-white text-yellow-900 hover:bg-yellow-100 font-semibold py-3 px-6 rounded-full transition-all shadow-lg">
                Login to Get Started
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 text-sm text-yellow-100 bg-yellow-800">
        &copy; {{ date('Y') }} <strong>AssetsTnt</strong>. All rights reserved. <br>
        Powered by <strong>Laravel + Livewire</strong>.

   <!-- Footer -->
<footer class="bg-gray-900 text-white text-center py-6">
    <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
</footer>






</body>
</html>
