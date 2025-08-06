<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to AssetsTnt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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

        @media (min-width: 768px) {
            .footer-block {
                flex: 1 0 0;
                border-right: 3px solid transparent;
                position: relative;
            }
            .footer-block:not(:last-child)::after {
                content: "";
                position: absolute;
                right: -1.5px;
                top: 0;
                bottom: 0;
                width: 3px;
                background: repeating-linear-gradient(
                    to bottom,
                    #000  0%     20%,
                    #fff  20%    25%,
                    #bd0034 25%  60%,
                    #fff  60%    65%,
                    #006400 65% 100%
                );
            }
            .footer-block:last-child { border-right: none; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-yellow-300 via-yellow-600 to-yellow-900 min-h-screen flex flex-col text-white">

    <!-- Navbar -->
<div class="flex items-center justify-between px-6 py-4 bg-[#7c4404]">
    <!-- Logo on the left -->
    <div class="bg-white rounded-lg p-3 shadow-lg inline-block">
        <img src="{{ asset('images/logo2.png') }}" alt="Kenyan Flag" class="h-16 w-auto">
    </div>

    <!-- Text on the right -->
    <span class="font-bold text-white text-lg">ASSETS</span>
</div>

<!-- Top Green Line After Navbar -->
<div style="height: 7px; background-color: #161716ff;"></div>


        <button class="md:hidden text-white focus:outline-none" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
            &#9776;
        </button>
        <nav id="mobileMenu" class="hidden md:flex gap-6">
            <!--<a href="#" class="text-white hover:underline">Home</a>
            <a href="#" class="text-white hover:underline">About</a>
            <a href="#" class="text-white hover:underline">Contact</a> -->
        </nav>
    </header>

    <!-- Hero Section -->
    <div class="flex-grow flex items-center justify-center px-6">
        <div class="text-center space-y-8 animate-fadeInUp">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-24 w-24 rounded-full shadow-lg border-4 border-white animate-bounce">

            <h1 class="text-4xl font-extrabold drop-shadow-lg">Welcome to <span class="text-yellow-100">Assets Dashboard</span></h1>

            <p class="text-lg max-w-xl mx-auto text-yellow-100">Your go-to platform for managing assets efficiently.</p>

            <a href="{{ route('login') }}" class="inline-block bg-white text-yellow-900 hover:bg-yellow-100 font-semibold py-3 px-6 rounded-full transition-all shadow-lg">
                Login to Get Started
            </a>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="py-6 px-6" style="background-color: #7c4404; color: #eef1f1;">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row gap-8 md:gap-4 justify-between text-left text-sm">
                <!-- Block 1 -->
                <div class="footer-block">
                    <h5 class="text-lg font-semibold mb-2">Assets Management</h5>
                    <p>
                        A system ensuring Searchability, Organization, Traceability, Retrieval, Maintenance, and
                        Accountability of National Treasury assets.
                    </p>
                </div>

                <!-- Block 2 -->
                <div class="footer-block">
                    <h5 class="text-lg font-semibold mb-2">The National Treasury</h5>
                    <p>
                        Excellence in Economic and Public Financial Management, and Development Planning.
                    </p>
                </div>

                <!-- Block 3 -->
                <div class="footer-block">
                    <h5 class="text-lg font-semibold mb-2">Contact</h5>
                    <p>
                        pstnt@treasury.go.ke<br>
                        +254 20 2252299<br>
                        Nairobi, Kenya
                    </p>
                </div>

            </div>
        </div>
    </footer>

    <!-- Copyright -->
    <div class="text-center text-xs mt-6 pt-4" style="background-color: #003d1f; color: #eef1f1; border-top: 1px solid #7c4404;">
        &copy; {{ date('Y') }} <strong>Copyright. The National Treasury.</strong> All rights reserved.<br>
        <!-- Powered by <strong>Laravel + Livewire</strong>. -->
    </div>

</body>
</html>
