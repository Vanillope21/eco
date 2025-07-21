<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions - EcoTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-ecogreen-50 text-gray-900 font-sans">
    @include('partials.guest-navbar')
    <main class="max-w-3xl mx-auto py-12 px-4">
        <!-- Hero Section -->
        <section class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3 text-ecogreen">Frequently Asked Questions</h1>
            <p class="text-lg md:text-xl text-ecoorange font-medium">Find answers to common questions about waste management and the EcoTrack system</p>
        </section>

        <div 
            x-data="faqData()"
            class="space-y-6"
        >
            <!-- Search Box -->
            <div class="mb-6 flex items-center gap-2">
                <input type="text" x-model="search" placeholder="Search questions..." class="w-full rounded border border-ecogreen px-4 py-2 focus:ring-2 focus:ring-ecogreen focus:outline-none">
            </div>

            <!-- Category Filter -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Categories:</h3>
                <div class="flex flex-wrap gap-2">
                    <button class="px-3 py-1 border border-ecogreen text-ecogreen rounded hover:bg-ecogreen hover:text-white transition text-sm" :class="{ 'bg-ecogreen text-white': category === 'all' }" @click="category = 'all'">All</button>
                    <button class="px-3 py-1 border border-ecogreen text-ecogreen rounded hover:bg-ecogreen hover:text-white transition text-sm" :class="{ 'bg-ecogreen text-white': category === 'schedule' }" @click="category = 'schedule'">Schedules</button>
                    <button class="px-3 py-1 border border-ecogreen text-ecogreen rounded hover:bg-ecogreen hover:text-white transition text-sm" :class="{ 'bg-ecogreen text-white': category === 'waste' }" @click="category = 'waste'">Waste Management</button>
                    <button class="px-3 py-1 border border-ecogreen text-ecogreen rounded hover:bg-ecogreen hover:text-white transition text-sm" :class="{ 'bg-ecogreen text-white': category === 'system' }" @click="category = 'system'">System</button>
                    <button class="px-3 py-1 border border-ecogreen text-ecogreen rounded hover:bg-ecogreen hover:text-white transition text-sm" :class="{ 'bg-ecogreen text-white': category === 'account' }" @click="category = 'account'">Accounts</button>
                </div>
            </div>

            <!-- FAQ Items -->
            <div id="faqContainer">
                <template x-for="(faq, i) in filteredFaqs" :key="i">
                    <div class="mb-4 border border-ecogreen-100 rounded-lg overflow-hidden">
                        <button
                            class="w-full text-left px-4 py-3 bg-ecogreen-100 font-semibold text-ecogreen flex justify-between items-center focus:outline-none"
                            @click="open === i ? open = null : open = i"
                            :aria-expanded="open === i"
                        >
                            <span>
                                <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold mr-2"
                                    :class="{
                                        'bg-ecogreen-100 text-ecogreen': faq.cat === 'schedule',
                                        'bg-ecoyellow-100 text-ecoyellow': faq.cat === 'waste',
                                        'bg-ecoorange-100 text-ecoorange': faq.cat === 'system',
                                        'bg-red-100 text-red-600': faq.cat === 'account',
                                    }">
                                    <template x-if="faq.cat === 'schedule'">Schedule</template>
                                    <template x-if="faq.cat === 'waste'">Waste</template>
                                    <template x-if="faq.cat === 'system'">System</template>
                                    <template x-if="faq.cat === 'account'">Account</template>
                                </span>
                                <span x-text="faq.q"></span>
                            </span>
                            <svg :class="{'transform rotate-180': open === i}" class="h-5 w-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="faq-answer px-4 py-3 bg-white border-t border-ecogreen-100" x-show="open === i" x-transition>
                            <span x-html="faq.a"></span>
                        </div>
                    </div>
                </template>
                <template x-if="filteredFaqs.length === 0">
                    <div class="text-center text-ecoorange py-8">No questions found for your search or category.</div>
                </template>
            </div>
        </div>

        <!-- Contact Section -->
        <section class="mt-10 text-center">
            <h3 class="text-2xl font-bold text-ecogreen mb-2">Still have questions?</h3>
            <p class="mb-3">If you couldn't find the answer you're looking for, don't hesitate to contact us:</p>
            <div class="flex flex-wrap gap-2 justify-center">
                <a href="{{ url('/contact') }}" class="px-6 py-2 bg-ecogreen text-white rounded font-semibold hover:bg-ecoorange hover:text-ecogreen transition">Contact Your Barangay</a>
                <a href="{{ route('login') }}" class="px-6 py-2 border border-ecogreen text-ecogreen rounded font-semibold hover:bg-ecogreen hover:text-white transition">Login for Support</a>
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
                <li><a href="{{ url('/contact') }}" class="hover:text-ecoyellow transition">Contact Us</a></li>
            </ul>
            <p class="text-center text-ecoyellow">© 2025 EcoTrack</p>
        </div>
    </footer>

    <script>
        function faqData() {
            return {
                search: '',
                category: 'all',
                open: null,
                faqs: [
                    { 
                        q: 'How do I find my barangay\'s waste collection schedule?', 
                        a: 'You can view your barangay\'s waste collection schedule by visiting the <a href="{{ url("/schedules") }}" class="underline text-ecogreen hover:text-ecoorange">Schedules page</a>. Simply select your barangay from the dropdown menu to see the collection days and times for your area.', 
                        cat: 'schedule' 
                    },
                    { 
                        q: 'What happens if collection is missed on my scheduled day?', 
                        a: 'If collection is missed, please contact your barangay office or use the contact form on our website. The collection team will usually return the following day or as soon as possible. You can also check for any schedule changes or announcements on the schedules page.', 
                        cat: 'schedule' 
                    },
                    { 
                        q: 'Are there different schedules for different types of waste?', 
                        a: 'Yes, some barangays have separate collection schedules for different types of waste (biodegradable, recyclable, non-recyclable). Check your specific barangay\'s schedule for details, and refer to our <a href="{{ url("/guidelines") }}" class="underline text-ecogreen hover:text-ecoorange">Waste Guidelines</a> for proper segregation instructions.', 
                        cat: 'schedule' 
                    },
                    { 
                        q: 'How should I segregate my waste properly?', 
                        a: 'Proper waste segregation involves separating waste into three main categories: biodegradable (food waste, garden waste), recyclable (paper, plastic, metal, glass), and non-recyclable (mixed waste). Visit our <a href="{{ url("/guidelines") }}" class="underline text-ecogreen hover:text-ecoorange">Waste Guidelines</a> page for detailed instructions and best practices.', 
                        cat: 'waste' 
                    },
                    { 
                        q: 'Can I dispose of hazardous waste through regular collection?', 
                        a: 'No, hazardous waste (batteries, electronics, chemicals, medical waste) should not be disposed of through regular collection. Contact your barangay office for proper disposal methods or special collection events for hazardous materials.', 
                        cat: 'waste' 
                    },
                    { 
                        q: 'What should I do with large items like furniture or appliances?', 
                        a: 'Large items require special collection arrangements. Contact your barangay office to schedule a special pickup. Some barangays have designated days for bulky waste collection, while others require advance notice.', 
                        cat: 'waste' 
                    },
                    { 
                        q: 'What is EcoTrack and how does it work?', 
                        a: 'EcoTrack is a comprehensive waste management system that helps barangays and residents manage waste collection more efficiently. It provides real-time scheduling, GPS tracking of collection vehicles, and communication tools between residents and barangay officials. Learn more on our <a href="{{ url("/about") }}" class="underline text-ecogreen hover:text-ecoorange">About EcoTrack</a> page.', 
                        cat: 'system' 
                    },
                    { 
                        q: 'How accurate is the real-time tracking feature?', 
                        a: 'Our GPS tracking system provides real-time location updates with high accuracy. Collection vehicles are equipped with GPS devices that update their position every few minutes, allowing residents to track when collection trucks will arrive in their area.', 
                        cat: 'system' 
                    },
                    { 
                        q: 'Can I get notifications about schedule changes?', 
                        a: 'Yes! Residents with accounts can receive notifications about schedule changes, delays, or special announcements. You can choose to receive notifications via email or SMS. Contact your barangay office to set up notification preferences.', 
                        cat: 'system' 
                    },
                    { 
                        q: 'Do I need an account to view schedules?', 
                        a: 'No, you can view schedules and guidelines without an account. However, creating a resident account gives you access to personalized features like notifications, request submission, and detailed tracking information.', 
                        cat: 'account' 
                    },
                    { 
                        q: 'How do I request a resident account?', 
                        a: 'You can request a resident account by clicking "Request Resident Account" on our homepage. Your request will be reviewed by your barangay officials for approval. Make sure to provide accurate information including your address and barangay.', 
                        cat: 'account' 
                    },
                    { 
                        q: 'What information do I need to provide for account approval?', 
                        a: 'You\'ll need to provide your full name, address, barangay, contact information, and proof of residency. This helps barangay officials verify your identity and ensure you\'re eligible for an account in your area.', 
                        cat: 'account' 
                    },
                    { 
                        q: 'How long does account approval take?', 
                        a: 'Account approval typically takes 1-3 business days, depending on your barangay office\'s processing time. You\'ll receive an email notification once your account is approved or if additional information is needed.', 
                        cat: 'account' 
                    },
                ],
                get filteredFaqs() {
                    return this.faqs.filter(faq => {
                        const matchesCategory = this.category === 'all' || faq.cat === this.category;
                        const matchesSearch = this.search === '' || faq.q.toLowerCase().includes(this.search.toLowerCase()) || faq.a.toLowerCase().includes(this.search.toLowerCase());
                        return matchesCategory && matchesSearch;
                    });
                }
            }
        }
    </script>
</body>
</html> 