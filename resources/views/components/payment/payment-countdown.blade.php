@props([
    'seconds' => 3600,
])

<div
    class="overflow-hidden bg-blue-600 shadow-lg rounded-2xl"
    data-countdown="{{ $seconds }}"
>
    <div class="flex flex-col gap-4 p-6 md:flex-row md:items-center md:justify-between">

        <div>

            <h3 class="text-lg font-semibold text-white">
                We're holding this booking for you
            </h3>

            <p class="mt-1 text-sm text-blue-100">
                Complete your payment before the countdown ends.
            </p>

        </div>

        <div class="flex items-center gap-3 px-5 py-3 rounded-xl bg-white/20 backdrop-blur">

            <i class="text-xl text-yellow-300 fa-regular fa-clock"></i>

            <span
                class="text-2xl font-bold tracking-widest text-yellow-300"
                data-countdown-display
            >
                01:00:00
            </span>

        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const countdown = document.querySelector('[data-countdown]');
        const display = countdown?.querySelector('[data-countdown-display]');

        if (!countdown || !display) {
            return;
        }

        let seconds = parseInt(countdown.dataset.countdown, 10);

        function updateCountdown() {

            const hour = String(Math.floor(seconds / 3600)).padStart(2, '0');

            const minute = String(
                Math.floor((seconds % 3600) / 60)
            ).padStart(2, '0');

            const second = String(seconds % 60).padStart(2, '0');

            display.textContent = `${hour}:${minute}:${second}`;

        }

        updateCountdown();

        const timer = setInterval(function () {

            if (seconds <= 0) {
                seconds = 0;
                updateCountdown();
                clearInterval(timer);
                return;
            }

            seconds--;

            updateCountdown();

        }, 1000);

    });
</script>