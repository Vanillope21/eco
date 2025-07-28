<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions - EcoTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body.eco-bg {
            background: linear-gradient(135deg, #e3fcec 0%, #e0f2fe 100%) !important;
        }
        .eco-card {
            background: linear-gradient(135deg, #fff 60%, #f0fdf4 100%);
            border: 2px solid #dcfce7;
            border-radius: 1.25rem;
            box-shadow: 0 2px 12px 0 rgba(31, 38, 135, 0.08);
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .eco-card:hover {
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            transform: translateY(-2px) scale(1.01);
        }
        @media (max-width: 640px) {
            .eco-card { padding: 0.5rem; }
        }
    </style>
</head>
<body class="eco-bg text-gray-900 font-sans">
    @include('partials.guest-navbar')
    <main class="max-w-3xl mx-auto py-12 px-4">
        <div class="eco-card p-8">
            <!-- Hero Section -->
            <section class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-3 text-ecogreen">Frequently Asked Questions</h1>
                <p class="text-lg md:text-xl text-ecoorange font-medium">Find answers to common questions about waste management and the EcoTrack system</p>
            </section>

            <!-- FAQ Accordion -->
            <livewire:guest.faq-accordion />

            <!-- Contact Section -->
            <section class="mt-10 text-center">
                <h3 class="text-2xl font-bold text-ecogreen mb-2">Still have questions?</h3>
                <p class="mb-3">If you couldn't find the answer you're looking for, don't hesitate to contact us:</p>
                <div class="flex flex-wrap gap-2 justify-center">
                    <a href="{{ url('/contact') }}" class="px-6 py-2 bg-ecogreen text-gray-900 rounded font-semibold hover:bg-ecoorange hover:text-ecogreen transition">Contact Your Barangay</a>
                    <a href="{{ route('login') }}" class="px-6 py-2 border border-ecogreen text-ecogreen rounded font-semibold hover:bg-ecogreen hover:text-white transition">Login for Support</a>
                </div>
            </section>
        </div>
    </main>
    <!-- Footer -->
    <footer class="bg-ecogreen border-t py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex flex-wrap justify-center gap-8 mb-6 text-gray-900 border-b border-ecoyellow pb-4">
                <li><a href="{{ url('/') }}" class="hover:text-ecoyellow transition">Home</a></li>
                <li><a href="{{ url('/schedules') }}" class="hover:text-ecoyellow transition">Schedules</a></li>
                <li><a href="{{ url('/guidelines') }}" class="hover:text-ecoyellow transition">Guidelines</a></li>
                <li><a href="{{ url('/barangays') }}" class="hover:text-ecoyellow transition">Barangay Info</a></li>
                <li><a href="{{ url('/contact') }}" class="hover:text-ecoyellow transition">Contact Us</a></li>
            </ul>
            <p class="text-center text-ecoyellow">© 2025 EcoTrack</p>
        </div>
    </footer>
</body>
</html> 