<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
    {
        DB::transaction(function () {

            echo "Start seeding...\n";

            // =====================================================
            // PASSWORD
            // =====================================================

            $password = Hash::make('password123');

            // =====================================================
            // USERS
            // =====================================================

            // -----------------------------------------------------
            // ADMIN
            // -----------------------------------------------------

            $existingAdmin = DB::table('users')
                ->where('email', 'admin@villakita.com')
                ->first();

            if ($existingAdmin) {

                $adminId = $existingAdmin->id;

                DB::table('users')
                    ->where('id', $adminId)
                    ->update([
                        'username'   => 'admin',
                        'fullname'   => 'Administrator',
                        'role'       => 'ADMIN',
                        'phone'      => '081111111111',
                        'address'    => 'Jakarta',
                        'updated_at' => now(),
                    ]);

            } else {

                $adminId = DB::table('users')->insertGetId([
                    'username'   => 'admin',
                    'fullname'   => 'Administrator',
                    'email'      => 'admin@villakita.com',
                    'password'   => $password,
                    'role'       => 'ADMIN',
                    'phone'      => '081111111111',
                    'address'    => 'Jakarta',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // -----------------------------------------------------
            // OWNER
            // -----------------------------------------------------

            $existingOwner = DB::table('users')
                ->where('email', 'owner@villakita.com')
                ->first();

            if ($existingOwner) {

                $ownerId = $existingOwner->id;

                DB::table('users')
                    ->where('id', $ownerId)
                    ->update([
                        'username'   => 'owner',
                        'fullname'   => 'Villa Owner',
                        'role'       => 'OWNER',
                        'phone'      => '082222222222',
                        'address'    => 'Bandung',
                        'updated_at' => now(),
                    ]);

            } else {

                $ownerId = DB::table('users')->insertGetId([
                    'username'   => 'owner',
                    'fullname'   => 'Villa Owner',
                    'email'      => 'owner@villakita.com',
                    'password'   => $password,
                    'role'       => 'OWNER',
                    'phone'      => '082222222222',
                    'address'    => 'Bandung',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // -----------------------------------------------------
            // USER
            // -----------------------------------------------------

            $existingUser = DB::table('users')
                ->where('email', 'user@villakita.com')
                ->first();

            if ($existingUser) {

                $userId = $existingUser->id;

                DB::table('users')
                    ->where('id', $userId)
                    ->update([
                        'username'   => 'user',
                        'fullname'   => 'Regular User',
                        'role'       => 'USER',
                        'phone'      => '083333333333',
                        'address'    => 'Surabaya',
                        'updated_at' => now(),
                    ]);

            } else {

                $userId = DB::table('users')->insertGetId([
                    'username'   => 'user',
                    'fullname'   => 'Regular User',
                    'email'      => 'user@villakita.com',
                    'password'   => $password,
                    'role'       => 'USER',
                    'phone'      => '083333333333',
                    'address'    => 'Surabaya',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // =====================================================
            // PRODUCT
            // =====================================================

            $existingProduct = DB::table('products')
                ->where('slug', 'villa-puncak-indah')
                ->first();

            if ($existingProduct) {

                $productId = $existingProduct->id;

                DB::table('products')
                    ->where('id', $productId)
                    ->update([
                        'name'         => 'Villa Puncak Indah',
                        'type'         => 'VILLA',
                        'booking_type' => 'MENGINAP',
                        'price'        => 1500000,
                        'updated_at'   => now(),
                    ]);

            } else {

                $productId = DB::table('products')->insertGetId([
                    'owner_id'       => $ownerId,
                    'created_by'     => $adminId,
                    'name'          => 'Villa Puncak Indah',
                    'slug'          => 'villa-puncak-indah',
                    'thumbnail'     => '/uploads/villa1.jpg',
                    'description'   => 'Villa nyaman dengan pemandangan pegunungan.',
                    'location'      => 'Puncak',
                    'address'       => 'Jl. Raya Puncak No. 1',
                    'url_maps'      => 'https://maps.google.com',

                    'type'          => 'VILLA',
                    'booking_type'  => 'MENGINAP',

                    'total_bedroom' => 4,
                    'total_bathroom'=> 3,
                    'max_guest'     => 10,
                    'wide'          => 250,
                    'price_start'   => 1000000,
                    'price'         => 1500000,
                    'service_fee'   => 5000,
                    'type_unit'     => 'Entire Villa',
                    'stock'         => 5,
                    'capacity'      => 10,
                    'is_active'     => true,

                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }

            // =====================================================
            // PRODUCT IMAGES
            // =====================================================

            $image1Exists = DB::table('product_images')
                ->where('product_id', $productId)
                ->where('image', '/uploads/villa1.jpg')
                ->exists();

            if (!$image1Exists) {

                DB::table('product_images')->insert([
                    'product_id' => $productId,
                    'image'      => '/uploads/villa1.jpg',
                ]);
            }

            $image2Exists = DB::table('product_images')
                ->where('product_id', $productId)
                ->where('image', '/uploads/villa2.jpg')
                ->exists();

            if (!$image2Exists) {

                DB::table('product_images')->insert([
                    'product_id' => $productId,
                    'image'      => '/uploads/villa2.jpg',
                ]);
            }

            // =====================================================
            // PRODUCT ITEMS
            // =====================================================

            $productItems = [
                ['FACILITY', 'Private Pool'],
                ['FACILITY', 'WiFi'],
                ['FACILITY', 'BBQ Area'],
                ['INCLUDE', 'Breakfast'],
                ['INCLUDE', 'Free Parking'],
                ['EXCLUDE', 'Lunch'],
                ['EXCLUDE', 'Airport Pickup'],
            ];

            foreach ($productItems as [$type, $name]) {

                $exists = DB::table('product_items')
                    ->where('product_id', $productId)
                    ->where('type', $type)
                    ->where('name', $name)
                    ->exists();

                if (!$exists) {

                    DB::table('product_items')->insert([
                        'product_id' => $productId,
                        'type'       => $type,
                        'name'       => $name,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // =====================================================
            // BOOKING
            // =====================================================

            $bookingExists = DB::table('bookings')
                ->where('booking_code', 'BK202608010001')
                ->exists();

            if (!$bookingExists) {

                DB::table('bookings')->insert([
                    'user_id'         => $userId,
                    'product_id'      => $productId,
                    'booking_code'    => 'BK202608010001',
                    'order_id'        => 'ORDER-202608010001',
                    'name_guest'      => 'Budi Santoso',
                    'email'           => 'budi@gmail.com',
                    'phone'           => '08123456789',
                    'check_in'        => Carbon::parse('2026-08-01'),
                    'check_out'       => Carbon::parse('2026-08-03'),
                    'total_guest'     => 4,
                    'total_price'     => 3000000,
                    'status'          => 'PAID',
                    'payment_status'  => 'PAID',
                    'payment_method'  => 'bank_transfer',
                    'transaction_id'  => 'TXN-202608010001',
                    'paid_at'         => now(),
                    'expired_at'      => now()->addDay(),
                    'note'            => 'Late check in',
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);
            }

            // =====================================================
            // BLOG
            // =====================================================

            $blogs = [
                [
                    'title'     => 'Tips Memilih Villa',
                    'slug'      => 'tips-memilih-villa',
                    'category'  => 'Tips',
                    'thumbnail' => '/uploads/blog1.jpg',
                    'content'   => 'Lorem ipsum dolor sit amet.',
                ],
                [
                    'title'     => 'Liburan Bersama Keluarga',
                    'slug'      => 'liburan-keluarga',
                    'category'  => 'Family',
                    'thumbnail' => '/uploads/blog2.jpg',
                    'content'   => 'Lorem ipsum dolor sit amet.',
                ],
            ];

            foreach ($blogs as $blog) {

                $exists = DB::table('blogs')
                    ->where('slug', $blog['slug'])
                    ->exists();

                if (!$exists) {

                    DB::table('blogs')->insert([
                        'title'      => $blog['title'],
                        'slug'       => $blog['slug'],
                        'category'   => $blog['category'],
                        'thumbnail'  => $blog['thumbnail'],
                        'content'    => $blog['content'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // =====================================================
            // VOUCHER
            // =====================================================

            $voucherExists = DB::table('vouchers')
                ->where('code', 'WELCOME10')
                ->exists();

            if (!$voucherExists) {

                DB::table('vouchers')->insert([
                    'code'          => 'WELCOME10',
                    'description'   => 'Diskon 10%',
                    'discount'      => 10,
                    'min_purchase'  => 1000000,
                    'date_expired'  => Carbon::parse('2027-01-01'),
                    'status'        => true,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }

            // =====================================================
            // PARTNER
            // =====================================================

            $partnerExists = DB::table('partners')
                ->where('image', 'partner.png')
                ->exists();

            if (!$partnerExists) {

                DB::table('partners')->insert([
                    'image'      => 'partner.png',
                    'status'     => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            echo "✅ Seeding selesai\n";
        });
    }
}
