<div class="bg-green-50 min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h1 class="text-3xl font-bold text-green-800 mb-4 sm:mb-0">Barangay Collection Calendar</h1>
            <div class="flex items-center space-x-2">
                <button wire:click="prevMonth" class="px-3 py-1 bg-green-100 hover:bg-green-200 rounded">&lt;</button>
                <span class="text-lg font-bold text-green-700">{{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}</span>
                <button wire:click="nextMonth" class="px-3 py-1 bg-green-100 hover:bg-green-200 rounded">&gt;</button>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 overflow-x-auto">
            <div class="grid grid-cols-7 gap-1 text-center mb-2">
                @foreach ($days as $day)
                    <div class="font-semibold text-green-700">{{ $day }}</div>
                @endforeach
            </div>
            <div class="grid grid-cols-7 gap-1 text-center">
                @for ($i = 0; $i < $firstDayOfWeek; $i++)
                    <div></div>
                @endfor
                @for ($d = 1; $d <= $daysInMonth; $d++)
                    @php
                        $date = \Carbon\Carbon::create($year, $month, $d)->toDateString();
                        $hasSchedule = isset($calendarSchedules[$date]);
                    @endphp
                    <button wire:click="showDetails('{{ $date }}')"
                        class="rounded-lg p-2 h-16 w-full flex flex-col items-center justify-center relative focus:outline-none focus:ring-2 focus:ring-green-400 {{ $hasSchedule ? 'bg-green-200 hover:bg-green-300 cursor-pointer' : 'bg-gray-100' }}"
                        @if(!$hasSchedule) disabled @endif>
                        <span class="font-bold text-green-900">{{ $d }}</span>
                        @if ($hasSchedule)
                            <span class="absolute top-1 right-1 w-2 h-2 bg-green-600 rounded-full"></span>
                        @endif
                    </button>
                @endfor
            </div>
        </div>

        <!-- Modal -->
        @if ($modalOpen)
            <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
                    <button wire:click="closeModal" class="absolute top-2 right-2 text-gray-400 hover:text-red-500 text-2xl">&times;</button>
                    <h3 class="text-xl font-bold text-green-800 mb-4">Schedule Details for {{ \Carbon\Carbon::parse($selectedDate)->format('F d, Y') }}</h3>
                    @if (count($selectedSchedules))
                        <ul class="space-y-4">
                            @foreach ($selectedSchedules as $sched)
                                <li class="border-l-4 border-green-500 pl-4">
                                    <div class="font-semibold text-green-700">{{ $sched['title'] }}</div>
                                    <div class="text-gray-700 text-sm">{{ $sched['description'] }}</div>
                                    @if ($sched['pickup_time'])
                                        <div class="text-gray-500 text-xs mt-1">Pickup Time: {{ $sched['pickup_time'] }}</div>
                                    @endif
                                    @if ($sched['waste_type'])
                                        <div class="text-gray-500 text-xs mt-1">Waste Type: {{ $sched['waste_type'] }}</div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-gray-500">No schedules for this day.</div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
