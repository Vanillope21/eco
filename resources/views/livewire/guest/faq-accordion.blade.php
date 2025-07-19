<div class="max-w-2xl mx-auto my-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Frequently Asked Questions</h2>
    <div class="space-y-4">
        @foreach($faqs as $i => $faq)
            <div class="border rounded-lg overflow-hidden shadow-sm">
                <button type="button" wire:click="toggle({{ $i }})" class="w-full flex justify-between items-center px-4 py-3 bg-gray-100 hover:bg-gray-200 focus:outline-none">
                    <span class="font-medium text-left">{{ $faq['question'] }}</span>
                    <svg class="w-5 h-5 transform transition-transform duration-200" :class="{'rotate-180': $openIndex === $i}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                @if($openIndex === $i)
                    <div class="px-4 py-3 bg-white border-t animate-fade-in">
                        <p class="text-gray-700">{{ $faq['answer'] }}</p>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    <style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-8px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fade-in 0.2s ease;
}
</style> 
</div>

