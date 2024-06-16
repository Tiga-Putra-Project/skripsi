@extends('layouts.auth.master')

@section('title')
    Profile {{ $user->username}}
@endsection

@section('content')
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Profile of {{ $user->username }}</h5>
            </div>
        </div>
        <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
            <div class="col-span-12 card 2xl:col-span-12">
                <div class="card-body">
                    <div class="grid items-center grid-cols-1 gap-3 mb-4 2xl:grid-cols-12">
                        <div class="2xl:col-span-3">
                            <h6 class="text-xl">Data Pribadi</h6>
                        </div>
                    </div>
                    <div class="overflow-x-auto mb-4">
                        <form action="{{ route('user.profile.edit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="user_unique_id" class="form-label">User ID</label>
                                <input type="text" class="form-control" id="user_unique_id" value="{{ $user->user_unique_id }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" value="{{ $user->username }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input type="text" name="fullname" class="form-control" id="fullname" value="@error('alamat'){{ old('fullname') }}@else{{ $user->fullname }}@enderror" placeholder="Enter a fullname">
                                @error('fullname')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" id="email" value="@error('alamat'){{ old('email') }}@else{{ $user->email }}@enderror" placeholder="Enter an email">
                                @error('email')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" id="alamat" placeholder="Alamat" rows="3">@error('alamat'){{ old('alamat') }}@else{{ $user->alamat }}@enderror</textarea>
                                @error('alamat')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Save Change</button>
                            </div>
                        </form>
                    </div>
                    <hr class="mb-4">
                    <div class="grid items-center grid-cols-1 gap-3 mb-4 2xl:grid-cols-12">
                        <div class="2xl:col-span-3">
                            <h6 class="text-xl">Change Password</h6>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <form action="{{ route('user.profile.password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Old Password</label>
                                <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Old Password">
                                @error('old_password')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password">
                                @error('new_password')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                                @error('confirm_password')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
