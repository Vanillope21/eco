<?php

namespace App\Livewire\Guest;

use Livewire\Component;

class FaqAccordion extends Component
{
    public $openIndex = null;

    // Example FAQ data; replace with DB or config as needed
    public $faqs = [
        [
            'question' => 'How does the waste collection schedule work?',
            'answer' => 'Each barangay has a set schedule for bio and non-bio waste collection. Check the schedule page for details.'
        ],
        [
            'question' => 'How do I request a special pickup?',
            'answer' => 'You can request a special pickup through your barangay office or the online request form.'
        ],
        [
            'question' => 'What types of waste are considered bio and non-bio?',
            'answer' => 'Bio waste includes food scraps and yard waste. Non-bio includes plastics, metals, and other recyclables.'
        ],
    ];

    public function toggle($index)
    {
        $this->openIndex = $this->openIndex === $index ? null : $index;
    }

    public function render()
    {
        return view('livewire.guest.faq-accordion');
    }
} 