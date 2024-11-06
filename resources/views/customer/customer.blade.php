@extends('layouts.main')
@section('content')
    <div x-data="{ showAddModal: false, showEditModal: false, showDeleteModal: false }">
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
                            <th scope="col" class="w-1/8 px-6 py-3">#</th>
                            <th scope="col" class="w-1/8 px-6 py-3">Name</th>
                            <th scope="col" class="w-1/8 px-6 py-3">ProductName</th>
                            <th scope="col" class="w-1/8 px-6 py-3">Price</th>
                            <th scope="col" class="w-1/8 px-6 py-3">Interest</th>
                            <th scope="col" class="w-1/8 px-6 py-3">Duration</th>
                            <th scope="col" class="w-1/8 px-6 py-3">Photo</th>
                            <th scope="col" class="w-1/8 px-6 py-3">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach($data as $user)
                            <tr class="border-b text-green"
                                x-data="{ showEditModal: false, showDeleteModal: false }">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-green whitespace-nowrap">{{ $loop->iteration }}</th>
                                <td class="px-6 py-4"><a href="{{route('depreciation').'?cusid='.$user-> cusid}}" class="text-black underline">{{ $user->cusname }}</a></td>
                                <td class="px-6 py-4">{{ $user->productname }}</td>
                                <td class="px-6 py-4">{{ $user->product_price }}</td>
                                <td class="px-6 py-4">{{ $user->interest }}</td>
                                <td class="px-6 py-4">{{ $user->duration }}</td>
                                <td class="px-6 py-4">
                                    <img src="{{ asset('/photo/' . $user->photo) }}" alt="User Image" class="w-12 h-12 rounded-full">
                                </td>
                                <td class="px-6 py-4">
                                    <button @click="showEditModal = true"
                                            class="bg-blue-600 text-white rounded-md w-14 h-8 hover:bg-blue-700"
                                            style="font-family: 'Figtree';">EDIT</button>
                                    <button @click="showDeleteModal = true"
                                            class="bg-red-600 text-white rounded-md w-16 h-8 hover:bg-red-700"
                                            style="font-family: 'Figtree';">DELETE</button>

                                    <!-- Edit Modal -->
                                    <div x-show="showEditModal"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         x-transition:leave="transition ease-in duration-300"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0"
                                         class="z-40 fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                                    <div class="mt-20 bg-white rounded-lg p-8 w-4/5 modal-content">
                                            <h2 class="text-xl font-semibold mb-4">Edit User</h2>
                                            <form action="{{ route('update_customer', ['id' => $user->cusid]) }}"
                                                  method="POST"
                                                  enctype="multipart/form-data"
                                                  class="grid grid-cols-2">
                                                @csrf
                                                <div class="mb-4">
                                                    <label for="username" class="block text-sm font-medium text-gray-700">Customer Name</label>
                                                    <input type="text"
                                                           name="cusname"
                                                           value="{{ $user->cusname }}"
                                                           class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="tell" class="block text-sm font-medium text-gray-700">Customer Tell</label>
                                                    <input type="text"
                                                           name="custtel"
                                                           value="{{ $user->custtel }}"
                                                           class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="idcard" class="block text-sm font-medium text-gray-700">ID Card</label>
                                                    <input type="text"
                                                           name="idcard"
                                                           value="{{ $user->idcard }}"
                                                           class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="cusaddress" class="block text-sm font-medium text-gray-700">Customer Address</label>
                                                    <input type="text"
                                                           name="cusaddress"
                                                           value="{{ $user->cusaddress }}"
                                                           class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="productname" class="block text-sm font-medium text-gray-700">Product Name</label>
                                                    <input type="text"
                                                           name="productname"
                                                           value="{{ $user->productname }}"
                                                           class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="photo" class="block text-sm font-medium text-gray-700">Image</label>
                                                    <input type="file"
                                                           name="photo"
                                                           class="h-10 p-2 mt-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-md border-gray-300 cursor-pointer focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                                </div>
                                                <div class="col-span-2 justify-self-end">
                                                    <button @click="showEditModal = false" type="button" class="bg-gray-600 text-white rounded-md w-14 h-8 hover:bg-gray-700 mr-2">Cancel</button>
                                                    <button type="submit" class="bg-blue-600 text-white rounded-md w-16 h-8 hover:bg-blue-700">SAVE</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End Edit Modal -->

                                    <!-- Delete Modal -->
                                    <div x-show="showDeleteModal"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         x-transition:leave="transition ease-in duration-300"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0"
                                         class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                                        <div class="bg-white rounded-lg p-8">
                                            <h2 class="text-xl font-semibold mb-4">Confirm Delete</h2>
                                            <p class="mb-4">Are you sure you want to delete this customer {{$user->cusname}}?</p>
                                            <div class="flex justify-end">
                                                <button @click="showDeleteModal = false"
                                                        class="bg-gray-600 text-white rounded-md w-14 h-8 hover:bg-gray-700 mr-2">Cancel</button>
                                                <form action="{{ route('delete_customer', ['id' => $user->cusid]) }}"
                                                      method="POST">
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
        <div x-show="showAddModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="z-40 fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="h-auto bg-white rounded-lg p-8 w-4/5 modal-content">
                <h2 class="text-xl font-semibold mb-4">Add Customer</h2>
                <form action="{{ route('create_customer') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="grid grid-cols-2 space-x-1">
                    @csrf
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700">Customer Name</label>
                        <input type="text"
                               name="cusname"
                               class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="productname" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text"
                               name="productname"
                               class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="idcard" class="block text-sm font-medium text-gray-700">ID Card</label>
                        <input type="text"
                               name="idcard"
                               class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="product_price" class="block text-sm font-medium text-gray-700">Product Price</label>
                        <input type="number"
                               name="product_price"
                               class="h-10 p-2 mt-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-md border-gray-300 cursor-pointer focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mb-4">
                        <label for="cusaddress" class="block text-sm font-medium text-gray-700">Customer Address</label>
                        <input type="text"
                               name="cusaddress"
                               class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="interest" class="block text-sm font-medium text-gray-700">Interest</label>
                        <input type="number"
                               name="interest"
                               class="h-10 p-2 mt-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-md border-gray-300 cursor-pointer focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mb-4">
                        <label for="tell" class="block text-sm font-medium text-gray-700">Customer Tell</label>
                        <input type="text"
                               name="custtel"
                               class="h-10 p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                        <input type="number"
                               name="duration"
                               class="h-10 p-2 mt-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-md border-gray-300 cursor-pointer focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mb-4">
                        <label for="photo" class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file"
                               name="photo"
                               class="h-10 p-2 mt-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-md border-gray-300 cursor-pointer focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mb-4">
                        <label for="create_date" class="block text-sm font-medium text-gray-700">Create Date</label>
                        <input type="date"
                               name="create_date"
                               class="h-10 p-2 mt-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-md border-gray-300 cursor-pointer focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="col-span-2 justify-self-end">
                        <button @click="showAddModal = false" type="button" class="bg-gray-600 text-white rounded-md w-14 h-8 hover:bg-gray-700 mr-2">Cancel</button>
                        <button type="submit"
                                class="bg-blue-600 text-white rounded-md w-16 h-8 hover:bg-blue-700">SAVE</button>
                    </div>
                </form>
            </div>
        </div>

@endsection
