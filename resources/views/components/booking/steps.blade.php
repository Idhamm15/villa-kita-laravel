@props([
    'currentStep' => 0,
])

@php
    $steps = [
        [
            'title' => 'Book',
            'icon' => 'fa-calendar-check',
            'href' => '/booking',
        ],
        [
            'title' => 'Process',
            'icon' => 'fa-box',
            'href' => '/booking/process',
        ],
        [
            'title' => 'Pay',
            'icon' => 'fa-credit-card',
            'href' => '/booking/payment',
        ],
        // [
        //     'title' => 'Finish',
        //     'icon' => 'fa-circle-check',
        //     'href' => '/booking/success',
        // ],
    ];
@endphp

<div class="mb-10">
    <div class="flex items-center justify-between">

        @foreach ($steps as $index => $step)

            @php
                $completed = $index < $currentStep;
                $active = $index === $currentStep;
            @endphp

            <div class="flex flex-1 items-center">

                {{-- Step --}}
                <a
                    href="{{ url($step['href']) }}"
                    class="flex flex-col items-center"
                >
                    <div
                        class="
                            flex h-14 w-14 items-center justify-center
                            rounded-full border-2 transition
                            @if ($completed)
                                border-green-500 bg-green-500 text-white
                            @elseif ($active)
                                border-blue-600 bg-blue-600 text-white
                            @else
                                border-gray-300 bg-white text-gray-400
                            @endif
                        "
                    >
                        <i class="fa-solid {{ $step['icon'] }} text-xl"></i>
                    </div>

                    <span
                        class="
                            mt-3 text-sm font-semibold
                            @if ($active)
                                text-blue-600
                            @elseif ($completed)
                                text-green-600
                            @else
                                text-gray-500
                            @endif
                        "
                    >
                        {{ $step['title'] }}
                    </span>
                </a>

                {{-- Connector --}}
                @if ($index !== count($steps) - 1)
                    <div
                        class="
                            mx-4 h-1 flex-1 rounded-full
                            {{ $completed ? 'bg-green-500' : 'bg-gray-200' }}
                        "
                    ></div>
                @endif

            </div>

        @endforeach

    </div>
</div>