<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cineflix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-develobe-900 text-white">
    <!-- Header -->
    <div class="landing-header">
        <div class="w-1/3 flex items-center justify-center">
            <a href="/" class="font-bold text-5xl font-quicksand text-develobe-400">CINEFLIX</a>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero-section" style="background-image: url('https://assets.nflxext.com/ffe/siteui/vlv3/e3e9c31f-aa15-4a8f-8059-04f01e6b8629/web/ID-en-20250113-TRIFECTA-perspective_10a4e24c-e93f-4d38-9ffa-82737a56e1ad_large.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="hero-content">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                Unlimited movies, TV shows, and more.
            </h1>
            <h2 class="text-xl md:text-2xl mt-4">
                Watch anywhere. Cancel anytime.
            </h2>
            <p class="text-lg md:text-xl mt-6">
                Ready to watch? Enter your email to create or restart your membership.
            </p>
            <form action="{{ route('register') }}" method="get" class="mt-8 flex flex-col md:flex-row items-center justify-center gap-4">
                <input type="email" placeholder="Email address" required
                    class="px-4 py-3 rounded-md text-black w-full md:w-96 focus:ring-2 focus:ring-develobe-400 focus:outline-none">
                <button type="submit"
                    class="px-6 py-3 bg-develobe-700 text-white rounded-md hover:bg-develobe-900 transition duration-300">
                    Get Started
                </button>
            </form>
            <a href="{{ route('login') }}" class="inline-block mt-6 text-develobe-600 hover:text-develobe-700 text-lg font-medium">
                Already have an account? Login
            </a>
        </div>
    </div>

    <!-- Frequently Asked Questions Section -->
    <section class="py-12 bg-develobe-900 text-white">
        <div class="faq-container">
            <h2 class="text-3xl font-bold text-center mb-8">Frequently Asked Questions</h2>
            <div class="space-y-4">
                <!-- Question 1 -->
                <div class="faq-item">
                    <button class="w-full text-left font-medium flex justify-between items-center focus:outline-none">
                        <span>What is Cineflix?</span>
                        <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="mt-4 hidden">
                        <p class="text-sm">
                            Cineflix is a streaming platform that offers a wide variety of TV shows, movies, anime, documentaries, and more on thousands of internet-connected devices.
                        </p>
                    </div>
                </div>
                <!-- Question 2 -->
                <div class="faq-item">
                    <button class="w-full text-left font-medium flex justify-between items-center focus:outline-none">
                        <span>How much does it cost?</span>
                        <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="mt-4 hidden">
                        <p class="text-sm">
                             No extra costs, no contracts, ITS FREE! because this web is only for study purpose
                        </p>
                    </div>
                </div>
                <!-- Question 3 -->
                <div class="faq-item">
                    <button class="w-full text-left font-medium flex justify-between items-center focus:outline-none">
                        <span>Where can I watch?</span>
                        <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="mt-4 hidden">
                        <p class="text-sm">
                            Watch anywhere, anytime. Sign in with your account to watch on any device with internet.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('footer')

    <script>
        // FAQ Dropdown Functionality
        document.querySelectorAll('section button').forEach((button) => {
            button.addEventListener('click', () => {
                const answer = button.nextElementSibling;
                answer.classList.toggle('hidden');
                button.querySelector('svg').classList.toggle('rotate-180');
            });
        });
    </script>
</body>
</html>
