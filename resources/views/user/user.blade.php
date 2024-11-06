@extends('layouts.main')
@section('content')
    <div x-data="{ showAddModal: false }">
        <center>
            <div class="w-4/5 flex items-center justify-start pt-4">
                <button @click="showAddModal = true" class="bg-blue-600 text-white rounded-md w-14 h-8 hover:bg-blue-700" style="font-family: 'Figtree';">
                    ADD
                </button>
            </div>
        </center>
        <center>
            <div class="pt-4">
                <div class="relative overflow-x-auto" style="z-index: 30;">
                    <table class="w-4/5 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-xl overflow-hidden">
                        <thead class="text-xs uppercase text-green bg-gray-100">
                        <tr>
                            <th scope="col" class="w-1/5 px-6 py-3">#</th>
                            <th scope="col" class="w-1/5 px-6 py-3">Username</th>
                            <th scope="col" class="w-1/5 px-6 py-3">Password</th>
                            <th scope="col" class="w-1/5 px-6 py-3">Image</th>
                            <th scope="col" class="w-1/5 px-6 py-3">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach($data as $user)
                            <tr class="border-b text-green" x-data="{ showEditModal: false, showDeleteModal: false }">
                                <th scope="row" class="px-6 py-4 font-medium text-green whitespace-nowrap">{{ $loop->iteration }}</th>
                                <td class="px-6 py-4">{{ $user->username }}</td>
                                <td class="px-6 py-4">{{ $user->userpassword }}</td>
                                <td class="px-6 py-4">
                                    <img src="{{ asset('/photo/' . $user->photo) }}" alt="User Image" class="w-12 h-12 rounded-full">
                                </td>
                                <td class="px-6 py-4">
                                    <button @click="showEditModal = true" class="bg-blue-600 text-white rounded-md w-14 h-8 hover:bg-blue-700" style="font-family: 'Figtree';">EDIT</button>
                                    <button @click="showDeleteModal = true" class="bg-red-600 text-white rounded-md w-16 h-8 hover:bg-red-700" style="font-family: 'Figtree';">DELETE</button>

                                    <!-- Edit Modal -->
                                    <div x-show="showEditModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                                        <div class="w-4/5 bg-white rounded-lg p-8">
                                            <h2 class="text-xl font-semibold mb-4">Edit User</h2>
                                            <form action="{{ route('update_user', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-4">
                                                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                                    <input type="text" name="username" id="username" value="{{ $user->username }}" class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                                    <input type="password" name="password" id="password" value="{{ $user->userpassword }}" class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                                    <input type="file" name="image" id="image" src="{{ asset('/photo/' . $user->photo) }}" class="h-10 p-2 mt-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-md border-gray-300 cursor-pointer focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                                </div>
                                                <div class="flex justify-end">
                                                    <button @click="showEditModal = false" type="button" class="bg-gray-600 text-white rounded-md w-14 h-8 hover:bg-gray-700 mr-2">Cancel</button>
                                                    <button type="submit" class="bg-blue-600 text-white rounded-md w-16 h-8 hover:bg-blue-700">SAVE</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End Edit Modal -->

                                    <!-- Delete Modal -->
                                    <div x-show="showDeleteModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                                        <div class="bg-white rounded-lg p-8">
                                            <h2 class="text-xl font-semibold mb-4">Confirm Delete</h2>
                                            <p class="mb-4">Are you sure you want to delete this user {{$user->username}}?</p>
                                            <div class="flex justify-end">
                                                <button @click="showDeleteModal = false" class="bg-gray-600 text-white rounded-md w-14 h-8 hover:bg-gray-700 mr-2">Cancel</button>
                                                <form action="{{ route('delete_user', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-red-600 text-white rounded-md w-16 h-8 hover:bg-red-700">DELETE</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Delete Modal -->
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </center>

        <!-- Add Modal -->
        <div x-show="showAddModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="z-40 fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white rounded-lg p-8 w-4/5">
                <h2 class="text-xl font-semibold mb-4">Add User</h2>
                <form action="{{ route('create_user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" name="username" id="username" class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="image" id="image" class="h-10 p-2 mt-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-md border-gray-300 cursor-pointer focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="flex justify-end">
                        <button @click="showAddModal = false" type="button" class="bg-gray-600 text-white rounded-md w-14 h-8 hover:bg-gray-700 mr-2">Cancel</button>
                        <button type="submit" class="bg-blue-600 text-white rounded-md w-16 h-8 hover:bg-blue-700">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Add Modal -->
    </div>
@endsection
