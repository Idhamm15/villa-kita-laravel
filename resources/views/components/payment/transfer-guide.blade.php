@php
    $items = [
        'BNI Mobile Banking',
        'BNI ATM',
        'Internet Banking',
    ];
@endphp

<div class="p-6 bg-white shadow-lg rounded-2xl">

    <h2 class="mb-6 text-2xl font-bold">
        How to Transfer
    </h2>

    <div class="space-y-4">

        @foreach ($items as $item)

            <details class="border rounded-xl group">

                <summary
                    class="flex items-center justify-between p-5 font-semibold list-none cursor-pointer"
                >

                    <span>
                        {{ $item }}
                    </span>

                    <i
                        class="text-gray-600 transition-transform duration-300 fa-solid fa-chevron-down group-open:rotate-180"
                    ></i>

                </summary>

                <div class="p-5 leading-8 text-gray-600 border-t">

                    <ol class="pl-5 space-y-2 list-decimal">

                        <li>
                            Login ke aplikasi.
                        </li>

                        <li>
                            Pilih Virtual Account.
                        </li>

                        <li>
                            Masukkan nomor VA.
                        </li>

                        <li>
                            Pastikan nominal benar.
                        </li>

                        <li>
                            Konfirmasi pembayaran.
                        </li>

                    </ol>

                </div>

            </details>

        @endforeach

    </div>

</div>