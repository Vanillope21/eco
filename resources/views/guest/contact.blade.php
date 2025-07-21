<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contact Us - EcoTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ecogreen-50 text-gray-900 font-sans">
    @include('partials.guest-navbar')
    <main class="max-w-7xl mx-auto py-12 px-4">
        <!-- Hero Section -->
        <section class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3 text-ecogreen">Contact Us</h1>
            <p class="text-lg md:text-xl text-ecoorange font-medium">Have questions, feedback, or need assistance? We're here to help!</p>
        </section>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-ecogreen-100 text-ecogreen px-4 py-3 rounded mb-4 text-center font-semibold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-ecoorange-100 text-ecoorange px-4 py-3 rounded mb-4 text-center font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Contact Form -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow p-8 mb-8 lg:mb-0">
                <h3 class="text-2xl font-bold mb-6 text-ecogreen">Send us a Message</h3>
                <form action="{{ url('/contact') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block font-semibold mb-1">Full Name *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="w-full rounded border border-ecogreen px-4 py-2 focus:ring-2 focus:ring-ecogreen focus:outline-none @error('name') border-ecoorange @enderror">
                            @error('name')<div class="text-ecoorange text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="email" class="block font-semibold mb-1">Email Address *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   class="w-full rounded border border-ecogreen px-4 py-2 focus:ring-2 focus:ring-ecogreen focus:outline-none @error('email') border-ecoorange @enderror">
                            @error('email')<div class="text-ecoorange text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="phone" class="block font-semibold mb-1">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                   class="w-full rounded border border-ecogreen px-4 py-2 focus:ring-2 focus:ring-ecogreen focus:outline-none @error('phone') border-ecoorange @enderror">
                            @error('phone')<div class="text-ecoorange text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="barangay" class="block font-semibold mb-1">Barangay</label>
                            <select id="barangay" name="barangay"
                                    class="w-full rounded border border-ecogreen px-4 py-2 focus:ring-2 focus:ring-ecogreen focus:outline-none @error('barangay') border-ecoorange @enderror">
                                <option value="">Select your barangay</option>
                                @foreach($barangays as $barangay)
                                    <option value="{{ $barangay->id }}" {{ old('barangay') == $barangay->id ? 'selected' : '' }}>
                                        {{ $barangay->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('barangay')<div class="text-ecoorange text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div>
                        <label for="subject" class="block font-semibold mb-1">Subject *</label>
                        <select id="subject" name="subject" required
                                class="w-full rounded border border-ecogreen px-4 py-2 focus:ring-2 focus:ring-ecogreen focus:outline-none @error('subject') border-ecoorange @enderror">
                            <option value="">Select a subject</option>
                            <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                            <option value="Waste Collection Issue" {{ old('subject') == 'Waste Collection Issue' ? 'selected' : '' }}>Waste Collection Issue</option>
                            <option value="Schedule Information" {{ old('subject') == 'Schedule Information' ? 'selected' : '' }}>Schedule Information</option>
                            <option value="Barangay Registration" {{ old('subject') == 'Barangay Registration' ? 'selected' : '' }}>Barangay Registration</option>
                            <option value="Technical Support" {{ old('subject') == 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
                            <option value="Feedback" {{ old('subject') == 'Feedback' ? 'selected' : '' }}>Feedback</option>
                            <option value="Complaint" {{ old('subject') == 'Complaint' ? 'selected' : '' }}>Complaint</option>
                            <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('subject')<div class="text-ecoorange text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label for="message" class="block font-semibold mb-1">Message *</label>
                        <textarea id="message" name="message" rows="5" required
                                  class="w-full rounded border border-ecogreen px-4 py-2 focus:ring-2 focus:ring-ecogreen focus:outline-none @error('message') border-ecoorange @enderror"
                                  placeholder="Please describe your inquiry, issue, or feedback in detail...">{{ old('message') }}</textarea>
                        @error('message')<div class="text-ecoorange text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" id="privacy" name="privacy" required class="rounded border-ecogreen text-ecogreen focus:ring-ecogreen mr-2 @error('privacy') border-ecoorange @enderror">
                            <span>I agree to the <a href="{{ url('/privacy') }}" target="_blank" class="underline text-ecogreen hover:text-ecoorange">Privacy Policy</a> and consent to being contacted regarding my inquiry.</span>
                        </label>
                        @error('privacy')<div class="text-ecoorange text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="w-full md:w-auto px-8 py-3 bg-ecogreen text-white rounded-lg font-semibold shadow hover:bg-ecoorange hover:text-ecogreen transition text-lg">Send Message</button>
                </form>
            </div>
            <!-- Contact Information -->
            <div class="bg-ecogreen rounded-lg shadow p-8 text-white flex flex-col gap-6">
                <h3 class="text-2xl font-bold mb-2">Get in Touch</h3>
                <div>
                    <h6 class="font-semibold">📧 Email</h6>
                    <p class="mb-0"><a href="mailto:contact@ecotrack.com" class="underline">contact@ecotrack.com</a></p>
                    <small>We respond within 24 hours</small>
                </div>
                <div>
                    <h6 class="font-semibold">📞 Phone</h6>
                    <p class="mb-0"><a href="tel:+1234567890" class="underline">+1 (234) 567-890</a></p>
                    <small>Monday - Friday, 8:00 AM - 6:00 PM</small>
                </div>
                <div>
                    <h6 class="font-semibold">📍 Address</h6>
                    <p class="mb-0">123 Green Street<br>Eco City, Earth 12345</p>
                    <small>Main Office</small>
                </div>
                <div>
                    <h6 class="font-semibold">🕒 Emergency</h6>
                    <p class="mb-0"><a href="tel:+1234567891" class="underline">+1 (234) 567-891</a></p>
                    <small>24/7 Emergency Hotline</small>
                </div>
                <div>
                    <h6 class="font-semibold">Follow Us</h6>
                    <div class="flex gap-2 mt-1">
                        <a href="#" class="px-3 py-1 border border-white rounded hover:bg-white hover:text-ecogreen transition">Facebook</a>
                        <a href="#" class="px-3 py-1 border border-white rounded hover:bg-white hover:text-ecogreen transition">Twitter</a>
                        <a href="#" class="px-3 py-1 border border-white rounded hover:bg-white hover:text-ecogreen transition">Instagram</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <section class="mt-12">
            <h3 class="text-2xl font-bold text-center text-ecogreen mb-6">Frequently Asked Questions</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <h6 class="font-semibold mb-2">How do I find my collection schedule?</h6>
                    <p class="mb-0">Visit our <a href="{{ url('/schedules') }}" class="underline text-ecogreen hover:text-ecoorange">Schedules page</a> and search for your barangay to view collection times and days.</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h6 class="font-semibold mb-2">What should I do if my waste wasn't collected?</h6>
                    <p class="mb-0">Contact your barangay office directly or use this contact form to report the issue. Include your address and collection day.</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h6 class="font-semibold mb-2">How do I register my barangay for waste collection?</h6>
                    <p class="mb-0">Contact your barangay captain or use this form to request registration. We'll coordinate with your local officials.</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h6 class="font-semibold mb-2">What types of waste are accepted?</h6>
                    <p class="mb-0">Check our <a href="{{ url('/guidelines') }}" class="underline text-ecogreen hover:text-ecoorange">Waste Management Guidelines</a> for detailed information about waste segregation and accepted materials.</p>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <footer class="bg-ecogreen border-t py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex flex-wrap justify-center gap-8 mb-6 text-white border-b border-ecoyellow pb-4">
                <li><a href="{{ url('/') }}" class="hover:text-ecoyellow transition">Home</a></li>
                <li><a href="{{ url('/schedules') }}" class="hover:text-ecoyellow transition">Schedules</a></li>
                <li><a href="{{ url('/guidelines') }}" class="hover:text-ecoyellow transition">Guidelines</a></li>
                <li><a href="{{ url('/barangays') }}" class="hover:text-ecoyellow transition">Barangay Info</a></li>
                <li><a href="{{ url('/terms') }}" class="hover:text-ecoyellow transition">Terms & Conditions</a></li>
                <li><a href="{{ url('/privacy') }}" class="hover:text-ecoyellow transition">Privacy Policy</a></li>
            </ul>
            <p class="text-center text-ecoyellow">© 2025 EcoTrack</p>
        </div>
    </footer>
</body>
</html> 