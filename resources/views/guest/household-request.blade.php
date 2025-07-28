<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Household Account - EcoTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body.eco-bg {
            background: linear-gradient(135deg, #e3fcec 0%, #e0f2fe 100%) !important;
        }
        .eco-card {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 2px solid #059669;
            border-radius: 1.25rem;
            box-shadow: 0 2px 12px 0 rgba(31, 38, 135, 0.08);
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .eco-card:hover {
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            transform: translateY(-2px) scale(1.01);
        }
        .eco-info {
            background: linear-gradient(90deg, #fef9c3 0%, #dcfce7 100%);
            border-left: 6px solid #f59e42;
            border-radius: 1rem;
            box-shadow: 0 2px 8px 0 rgba(251, 146, 60, 0.08);
            padding: 1.5rem 1.5rem 1.5rem 2.5rem;
            margin-bottom: 2rem;
        }
        .eco-info h5 {
            color: #f59e42;
            font-size: 1.1rem;
            font-weight: 700;
        }
        .eco-section-title {
            color: #059669;
            font-size: 1.2rem;
            font-weight: 700;
        }
        @media (max-width: 640px) {
            .eco-card { padding: 0.5rem; }
            .eco-info { padding: 1rem 1rem 1rem 1.5rem; }
        }
    </style>
</head>
<body class="eco-bg text-gray-900 font-sans">
    <!-- Navigation -->
    @include('partials.guest-navbar')

    <!-- Main Content -->
    <div class="max-w-3xl mx-auto px-2 sm:px-4 py-10">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-ecoorange mb-4 drop-shadow">Request Household Account</h1>
            <p class="text-lg text-gray-700">Submit a request for an official household account. Your barangay officials will review and create your account.</p>
        </div>

        <!-- Info Box -->
        <div class="eco-info">
            <h5 class="mb-2 flex items-center gap-2"><span>📋</span> How it works:</h5>
            <ol class="text-gray-800 space-y-1 list-decimal list-inside ml-2">
                <li>Fill out the form below with your household information</li>
                <li>Your barangay officials will review your request</li>
                <li>If approved, officials will create your account and provide login credentials</li>
                <li>You'll receive notification about your request status</li>
            </ol>
        </div>

        <!-- Request Form -->
        <div class="eco-card p-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('household.request') }}" method="POST">
                @csrf
                <!-- Household Information -->
                <div class="border-b border-gray-200 pb-6 mb-6">
                    <h4 class="eco-section-title mb-4 flex items-center gap-2">🏠 Household Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="household_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Household Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-ecogreen @error('household_name') border-red-500 @enderror" 
                                   id="household_name" name="household_name" 
                                   value="{{ old('household_name') }}" 
                                   placeholder="e.g., Santos Family, Garcia Household">
                            @error('household_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="household_head" class="block text-sm font-medium text-gray-700 mb-2">
                                Household Head <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-ecogreen @error('household_head') border-red-500 @enderror" 
                                   id="household_head" name="household_head" 
                                   value="{{ old('household_head') }}" 
                                   placeholder="Full name of household head">
                            @error('household_head')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="border-b border-gray-200 pb-6 mb-6">
                    <h4 class="eco-section-title mb-4 flex items-center gap-2">📞 Contact Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Contact Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-ecogreen @error('contact_number') border-red-500 @enderror" 
                                   id="contact_number" name="contact_number" 
                                   value="{{ old('contact_number') }}" 
                                   placeholder="e.g., 09123456789">
                            @error('contact_number')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address (Optional)
                            </label>
                            <input type="email" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-ecogreen @error('email') border-red-500 @enderror" 
                                   id="email" name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="your.email@example.com">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="border-b border-gray-200 pb-6 mb-6">
                    <h4 class="eco-section-title mb-4 flex items-center gap-2">📍 Address Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="barangay_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Barangay <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-ecogreen @error('barangay_id') border-red-500 @enderror" 
                                    id="barangay_id" name="barangay_id">
                                <option value="">Select your barangay</option>
                                @foreach($barangays as $barangay)
                                    <option value="{{ $barangay->id }}" 
                                            {{ old('barangay_id') == $barangay->id ? 'selected' : '' }}>
                                        {{ $barangay->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('barangay_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="address_description" class="block text-sm font-medium text-gray-700 mb-2">
                            Address Description <span class="text-red-500">*</span>
                        </label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-ecogreen @error('address_description') border-red-500 @enderror" 
                                  id="address_description" name="address_description" 
                                  rows="3" 
                                  placeholder="Describe your address in detail. For example:\n- House number and street name\n- Landmark or nearby establishment\n- Zone/Purok number\n- Building name and unit number (if applicable)">{{ old('address_description') }}</textarea>
                        @error('address_description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-600 mt-1">
                            Be as specific as possible to help officials locate your household.
                        </p>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="mb-6">
                    <h4 class="eco-section-title mb-4 flex items-center gap-2">📋 Terms and Conditions</h4>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <input type="checkbox" 
                                   class="mt-1 h-4 w-4 text-ecogreen focus:ring-ecogreen border-gray-300 rounded @error('terms') border-red-500 @enderror" 
                                   id="terms" name="terms" 
                                   {{ old('terms') ? 'checked' : '' }}>
                            <label for="terms" class="ml-2 text-sm text-gray-700">
                                I agree to the <a href="{{ url('/terms') }}" target="_blank" class="text-ecogreen hover:underline">Terms and Conditions</a> 
                                and <a href="{{ url('/privacy') }}" target="_blank" class="text-ecogreen hover:underline">Privacy Policy</a>
                            </label>
                        </div>
                        @error('terms')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                        <div class="flex items-start">
                            <input type="checkbox" 
                                   class="mt-1 h-4 w-4 text-ecogreen focus:ring-ecogreen border-gray-300 rounded @error('privacy') border-red-500 @enderror" 
                                   id="privacy" name="privacy" 
                                   {{ old('privacy') ? 'checked' : '' }}>
                            <label for="privacy" class="ml-2 text-sm text-gray-700">
                                I consent to the processing of my personal information for account creation and waste management purposes
                            </label>
                        </div>
                        @error('privacy')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="bg-ecogreen hover:bg-ecoorange text-gray-900 font-bold py-3 px-8 rounded-lg text-lg transition duration-200">
                        📝 Submit Household Request
                    </button>
                </div>
            </form>
        </div>

        <!-- Additional Information -->
        <div class="text-center mt-8">
            <p class="text-gray-600">
                Questions about the request process? 
                <a href="{{ url('/contact') }}" class="text-ecogreen hover:underline">Contact your barangay office</a> or 
                <a href="{{ url('/faq') }}" class="text-ecogreen hover:underline">check our FAQ</a>.
            </p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-ecogreen text-gray-900 py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h5 class="text-lg font-semibold mb-2">EcoTrack</h5>
                    <p class="text-ecoyellow-100">Smarter Waste Management, Greener Communities</p>
                </div>
                <div class="text-right">
                    <p class="text-ecoyellow-100">&copy; 2024 EcoTrack. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html> 