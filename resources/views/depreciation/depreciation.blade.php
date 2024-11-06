@extends('layouts.main')
@section('content')

        <center>
            <div class="pt-4">
                <div class="relative overflow-x-auto" style="z-index: 30;">
                    <table class="w-4/5 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-xl overflow-hidden">
                        <thead class="text-xs uppercase text-green bg-gray-100">
                        <tr>
                            <th scope="col" class="w-1/7 px-6 py-3">#</th>
                            <th scope="col" class="w-1/7 px-6 py-3">Date</th>
                            <th scope="col" class="w-1/7 px-6 py-3">Principal</th>
                            <th scope="col" class="w-1/7 px-6 py-3">Interest</th>
                            <th scope="col" class="w-1/7 px-6 py-3">Total</th>
                            <th scope="col" class="w-1/7 px-6 py-3">Status</th>
                            <th scope="col" class="w-1/7 px-6 py-3">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach($data as $user)
                            <tr class="border-b text-green" x-data="{ showEditModal: false, showDeleteModal: false }">
                                <th scope="row" class="px-6 py-4 font-medium text-green whitespace-nowrap">{{ $loop->iteration }}</th>
                                <td class="px-6 py-4">{{ $user->paid_date }}</td>
                                <td class="px-6 py-4">{{ $user->principal }}</td>
                                <td class="px-6 py-4">{{ $user->interest_month }}</td>
                                <td class="px-6 py-4">{{ $user->principal + $user->interest_month }}</td>
                                <td class="px-6 py-4">
                                    {{ $user->statusPiad }}
                                    @if (is_null($user->clear_by_userid))
                                        Padding
                                    @else
                                        Paid
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <button @click="showDeleteModal = true" class="bg-blue-600 text-white rounded-md w-16 h-8 hover:bg-blue-700" style="font-family: 'Figtree';">Clear</button>
                                    <!-- Delete Modal -->
                                    <div x-show="showDeleteModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                                        <div class="bg-white rounded-lg p-8">
                                            <h2 class="text-xl font-semibold mb-4">Confirm Delete</h2>
                                            <p class="mb-4">Are you sure you want to clear this depreciation?</p>
                                            <div class="flex justify-end">
                                                <button @click="showDeleteModal = false" class="bg-gray-600 text-white rounded-md w-14 h-8 hover:bg-gray-700 mr-2">Cancel</button>
                                                <form action="{{ route('clear_depre', ['depreid' => $user->depreid, 'cusid' => $user->cusid]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-red-600 text-white rounded-md w-16 h-8 hover:bg-red-700">Clear</button>
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
@endsection
