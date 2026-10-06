@extends('layouts.app')

@section('content')

      <div class="min-h-screen bg-slate-50">
        <div class="container px-4 py-10 mx-auto max-w-7xl">

          <div class="grid gap-8 lg:grid-cols-12">

            <div class="lg:col-span-3">
              <x-profile.header-profile
                :name="$data->username"
                :image="$data->image"
                :role="$data->role"
              />
            </div>

            <div class="lg:col-span-9">
              <div class="p-8 bg-white shadow rounded-2xl">
                <h1 class="mb-6 text-3xl font-bold">
                  My Account
                </h1>

                {{-- {/* Form akun */} --}}
                <x-profile.account-information />
              </div>
            </div>

          </div>

        </div>
      </div>
   

@endsection