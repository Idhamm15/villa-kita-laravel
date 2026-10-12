<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Booking;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LandingPageController extends Controller
{
    public function index()
    {
        $data = Product::with('owner')->paginate(5);
        return view(
            'pages.Home',
            get_defined_vars()
        );
    }

    public function rent_villa()
    {
        $data = Product::where('type', 'VILLA')->with('owner')->paginate(10);
        return view(
            'pages.sewa-villla.index',
            get_defined_vars()
        );
    }

    public function detail_rent_villa($id)
    {
        $data = Product::with([
            'owner',
            'items',
            'images',
            'createdBy'
        ])->findOrFail($id);
        return view(
            'pages.sewa-villla.detail',
            get_defined_vars()
        );
    }

    public function saved()
    {
        return view('pages.Saved');
    }

    public function trip()
    {
        $data = Product::where('type', 'TRIP')->with('owner')->paginate(10);
        return view(
            'pages.trip.index',
            get_defined_vars()
        );
    }

    public function detail_trip()
    {
        return view('pages.trip.detail');
    }

    public function blog()
    {
        $data = Blog::paginate(10);
        return view(
            'pages.blog.index', 
            get_defined_vars()
        );
    }

    public function detailBlog($slug)
    {
        $data = Blog::where('slug', $slug)->firstOrFail();
        $relatedBlogs = Blog::where('id', '!=', $data->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        return view(
            'pages.blog.detail',
            get_defined_vars()
        );
    }

    public function contact()
    {
        return view('pages.Contact');
    }

    public function booking($id)
    {
        $data = Product::with([
            'owner',
            'items',
            'images',
            'createdBy'
        ])->findOrFail($id);
        return view(
            'pages.booking.index',
            get_defined_vars()
        );
    }

    public function bookingStore(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name_guest' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'check_in' => ['required', 'date'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'total_guest' => ['required', 'integer', 'min:1'],
            'visitor_type' => ['required', 'in:SELF,SOMEONE_ELSE'],
            'note' => ['nullable', 'string'],
            'voucherCode' => ['nullable', 'string'],
        ]);

        $product = Product::findOrFail($id);

        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);

        // Validasi tanggal
        if ($checkOut->lessThanOrEqualTo($checkIn)) {
            return back()
                ->withInput()
                ->withErrors([
                    'check_out' => 'Tanggal check-out harus setelah check-in.',
                ]);
        }

        // Validasi kapasitas tamu
        if ((int) $request->guest_count > (int) $product->capacity) {
            return back()
                ->withInput()
                ->withErrors([
                    'guest_count' => "Maksimal tamu {$product->capacity} orang.",
                ]);
        }

        // Cek bentrok booking
        $overlap = Booking::where('product_id', $product->id)
            ->whereIn('payment_status', ['unpaid', 'paid'])
            ->where('status', '!=', 'cancelled')
            ->where('check_in', '<', $checkOut)
            ->where('check_out', '>', $checkIn)
            ->exists();

        if ($overlap) {
            return back()
                ->withInput()
                ->withErrors([
                    'check_in' => 'Villa sudah dibooking pada tanggal tersebut.',
                ]);
        }

        // Hitung durasi booking
        $nights = max(
            1,
            (int) ceil($checkIn->diffInSeconds($checkOut) / 86400)
        );

        // Formula harga
        $price = (float) $product->price;
        $serviceFee = 5000;
        $subtotal = $price * $nights;
        $discount = 0;

        // Validasi ulang voucher
        $voucherCode = trim((string) $request->input('voucherCode', ''));

        if ($voucherCode !== '') {
            $voucher = Voucher::where('code', $voucherCode)
                ->where('status', 1)
                ->first();

            if (!$voucher) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'voucherCode' => 'Kode voucher tidak ditemukan atau tidak aktif.',
                    ]);
            }

            if (
                $voucher->date_expired &&
                now()->gt($voucher->date_expired)
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'voucherCode' => 'Voucher sudah kedaluwarsa.',
                    ]);
            }

            $minimumPurchase = (float) ($voucher->mi_purchase ?? 0);

            if ($subtotal < $minimumPurchase) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'voucherCode' => 'Minimum pembelian voucher adalah Rp '
                            . number_format($minimumPurchase, 0, ',', '.') . '.',
                    ]);
            }

            $discount = min(
                (float) ($voucher->discount ?? 0),
                $subtotal
            );
        }

        $totalPrice = max(
            0,
            $subtotal + $serviceFee - $discount
        );

        // Simpan booking
        $booking = DB::transaction(function () use (
            $request,
            $product,
            $checkIn,
            $checkOut,
            $discount,
            $subtotal, $totalPrice
        ) {
            return Booking::create([
                'booking_code' => 'BK' . now()->format('YmdHis') . Str::upper(Str::random(4)),
                'order_id' => 'ORDER-' . Str::uuid(),

                'product_id' => $product->id,
                'user_id' => auth()->id(),

                'name_guest' => $request->name_guest,
                'email' => $request->email,
                'phone' => $request->phone,

                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_guest' => (int) $request->total_guest,

                'discount' => $discount,
                'sub_total' => $subtotal,
                'total_price' => $totalPrice,

                'status' => 'pending',
                'visitor_type' => $request->visitor_type,
                'payment_method' => null,
                'payment_status' => 'PENDING',

                'payment_token' => null,
                'payment_url' => null,
                'paid_at' => null,
                'expired_at' => now()->addHours(24),

                'note' => $request->input('note'),
            ]);
        });

        return redirect()
            ->route('booking-process', [
                'orderId' => $booking->order_id,
            ])
            ->with('success', 'Booking berhasil disimpan. Silakan lanjutkan ke pembayaran.');
    }

    public function bookingProcess($orderId)
    {
        $data = Booking::with('product')->where('order_id', $orderId)->firstOrFail();

        return view(
            'pages.booking.Process',
            get_defined_vars()
        );
    }


    public function bookingPaymentProcess(Request $request, $orderId)
    {
        $request->validate([
            'payment_method' => [
                'required',
                'in:bca,bni,bri,mandiri,permata,cimb,danamon,shopeepay,ovo,dana',
            ],
        ]);

        $booking = Booking::with('product')
            ->where('order_id', $orderId)
            ->firstOrFail();

        // Cek status pembayaran
        if ($booking->payment_status === 'PAID') {
            return redirect()
                ->route('booking-payment', ['id' => $booking->id])
                ->with('info', 'Booking sudah dibayar.');
        }

        // Cek konfigurasi Midtrans
        $serverKey = config('services.midtrans.server_key')
            ?: env('MIDTRANS_SERVER_KEY');

        if (!$serverKey) {
            Log::error('MIDTRANS_SERVER_KEY belum dikonfigurasi.');

            return back()->with(
                'error',
                'Konfigurasi pembayaran belum tersedia.'
            );
        }

        // Metode pembayaran
        $bank = $request->input('payment_method');

        // $bank = strtolower(
        //     str_replace('_VA', '', $paymentMethod)
        // );

        // Endpoint Midtrans
        $isProduction = filter_var(
            env('MIDTRANS_IS_PRODUCTION', false),
            FILTER_VALIDATE_BOOLEAN
        );

        $midtransUrl = $isProduction
            ? 'https://api.midtrans.com/v2/charge'
            : 'https://api.sandbox.midtrans.com/v2/charge';

        // Payload pembayaran
        $payload = [
            'payment_type' => 'bank_transfer',

            'transaction_details' => [
                'order_id' => $booking->order_id,
                'gross_amount' => (int) $booking->total_price,
            ],

            'bank_transfer' => [
                'bank' => $bank,
            ],
        ];

        try {
            // Request ke Midtrans
            $response = Http::withBasicAuth($serverKey, '')
                ->acceptJson()
                ->timeout(30)
                ->post($midtransUrl, $payload);

            $transaction = $response->json();

            // dd([
            //     'http_status' => $response->status(),
            //     'response' => $transaction,
            // ]);
            // Gagal membuat transaksi
            if (!$response->successful()) {
                Log::error('MIDTRANS ERROR', [
                    'order_id' => $booking->order_id,
                    'response' => $transaction,
                ]);

                return back()->with(
                    'error',
                    data_get(
                        $transaction,
                        'status_message',
                        'Gagal membuat pembayaran Midtrans.'
                    )
                );
            }

            // dd($transaction);

            // Ambil nomor virtual account
            $paymentToken = data_get($transaction, 'va_numbers.0.va_number');

            // Simpan transaksi, jangan tandai sebagai PAID
            DB::transaction(function () use (
                $booking,
                $bank,
                $transaction,
                $paymentToken
            ) {
                $booking->update([
                    'payment_method' => $bank,

                    'transaction_id' =>
                        $transaction['transaction_id'] ?? null,

                    'payment_token' => $paymentToken,

                    'payment_status' => 'PENDING',

                    'expired_at' => !empty($transaction['expiry_time'])
                        ? Carbon::parse($transaction['expiry_time'])
                        : null,
                ]);
            });

            return redirect()
                ->route('booking-payment', ['orderId' => $booking->order_id])
                ->with('success', 'Pembayaran berhasil dibuat. Silakan selesaikan pembayaran Anda.');
                

        } catch (\Throwable $e) {
            Log::error('PAYMENT ERROR', [
                'order_id' => $booking->order_id,
                'message' => $e->getMessage(),
            ]);

            return back()->with(
                'error',
                'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.'
            );
        }
    }
    public function bookingPayment($orderId)
    {
        $data = Booking::with('product')
            ->where('order_id', $orderId)
            ->firstOrFail();
        return view(
            'pages.booking.Payment',
            get_defined_vars()
        );
    }

    public function validateVoucher(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string'],
            'product_id' => ['nullable'],
            'purchase_amount' => ['required', 'numeric', 'min:0'],
        ]);

        $voucher = Voucher::where('code', $request->code)
            ->where('status', 1)
            ->first();

        if (!$voucher) {
            return response()->json([
                'valid' => false,
                'message' => 'Kode voucher tidak ditemukan atau tidak aktif.',
            ], 422);
        }

        $now = now();

        if ($voucher->date_expired && $now->gt($voucher->date_expired)) {
            return response()->json([
                'valid' => false,
                'message' => 'Voucher sudah kedaluwarsa.',
            ], 422);
        }

        // Validasi minimum pembelian
        $purchaseAmount = (float) $request->purchase_amount;
        $minimumPurchase = (float) ($voucher->mi_purchase ?? 0);

        if ($purchaseAmount < $minimumPurchase) {
            return response()->json([
                'valid' => false,
                'message' => 'Minimum pembelian untuk voucher ini adalah Rp '
                    . number_format($minimumPurchase, 0, ',', '.') . '.',
            ], 422);
        }

        $discount = (float) ($voucher->discount ?? 0);

        // Diskon tidak boleh melebihi nilai pembelian
        $discount = min($discount, $purchaseAmount);

        return response()->json([
            'valid' => true,
            'message' => 'Voucher berhasil digunakan.',
            'discount' => $discount,
        ]);
    }
    public function bookingPaymentCallback(Request $request)
    {
        $payload = $request->all();

        $orderId = $payload['order_id'] ?? null;
        $transactionId = $payload['transaction_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $statusCode = $payload['status_code'] ?? null;
        $grossAmount = $payload['gross_amount'] ?? null;
        $signatureKey = $payload['signature_key'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;
        $paymentType = $payload['payment_type'] ?? null;
        $transactionTime = $payload['transaction_time'] ?? null;
        $expiryTime = $payload['expiry_time'] ?? null;

        // Validasi payload
        if (
            !$orderId ||
            !$transactionStatus ||
            $statusCode === null ||
            $grossAmount === null ||
            !$signatureKey
        ) {
            return response()->json([
                'status' => false,
                'message' => 'Payload tidak lengkap.',
            ], 400);
        }

        // Verifikasi signature Midtrans
        $serverKey = config('services.midtrans.server_key');

        if (!$serverKey) {
            Log::error('MIDTRANS_SERVER_KEY belum dikonfigurasi.');

            return response()->json([
                'status' => false,
                'message' => 'Konfigurasi Midtrans tidak tersedia.',
            ], 500);
        }

        $expectedSignature = hash(
            'sha512',
            $orderId . $statusCode . $grossAmount . $serverKey
        );

        if (!hash_equals($expectedSignature, $signatureKey)) {
            return response()->json([
                'status' => false,
                'message' => 'Signature Midtrans tidak valid.',
            ], 401);
        }

        // Cari booking
        $booking = Booking::where('order_id', $orderId)->first();

        if (!$booking) {
            return response()->json([
                'status' => false,
                'message' => 'Booking tidak ditemukan.',
            ], 404);
        }

        $dataUpdate = [
            'transaction_id' => $transactionId,
            // 'payment_method' => $paymentType,
        ];

        // Pemetaan status transaksi Midtrans
        switch ($transactionStatus) {
            case 'capture':
                if ($fraudStatus === 'accept') {
                    $dataUpdate['payment_status'] = 'PAID';
                    $dataUpdate['status'] = 'PAID';
                    $dataUpdate['paid_at'] = $transactionTime
                        ? Carbon::parse($transactionTime)
                        : now();
                }
                break;

            case 'settlement':
                $dataUpdate['payment_status'] = 'PAID';
                $dataUpdate['status'] = 'PAID';
                $dataUpdate['paid_at'] = $transactionTime
                    ? Carbon::parse($transactionTime)
                    : now();
                break;

            case 'pending':
                $dataUpdate['payment_status'] = 'PENDING';
                $dataUpdate['status'] = 'PENDING';
                break;

            case 'deny':
                $dataUpdate['payment_status'] = 'FAILED';
                break;

            case 'cancel':
                $dataUpdate['payment_status'] = 'CANCELLED';
                $dataUpdate['status'] = 'CANCELLED';
                break;

            case 'expire':
                $dataUpdate['payment_status'] = 'EXPIRED';
                $dataUpdate['status'] = 'CANCELLED';

                if ($expiryTime) {
                    $dataUpdate['expired_at'] =
                        Carbon::parse($expiryTime);
                }
                break;

            case 'refund':
            case 'partial_refund':
                $dataUpdate['payment_status'] = 'REFUND';
                break;

            default:
                Log::warning('Status Midtrans belum ditangani.', [
                    'order_id' => $orderId,
                    'transaction_status' => $transactionStatus,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Callback diterima, status belum ditangani.',
                ]);
        }

        // Update booking
        DB::transaction(function () use ($booking, $dataUpdate) {
            $booking->update($dataUpdate);
        });

        return response()->json([
            'status' => true,
            'message' => 'Callback berhasil diproses.',
        ]);
    }
}
