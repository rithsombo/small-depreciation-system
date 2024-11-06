@extends('layouts.main')
@section('content')

        <center>
            <div class="pt-4">
                <div class="relative overflow-x-auto" style="z-index: 30;">
                    <p class="flex justify-center items-center mb-3">Money report in 14 days</p>
                    <table class="w-4/5 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-xl overflow-hidden">
                        <thead class="text-xs uppercase text-green bg-gray-100">
                        <tr>
                            <th scope="col" class="w-1/7 px-6 py-3">#</th>
                            <th scope="col" class="w-1/7 px-6 py-3">Date</th>
                            <th scope="col" class="w-1/7 px-6 py-3">Principal</th>
                            <th scope="col" class="w-1/7 px-6 py-3">Interest</th>
                            <th scope="col" class="w-1/7 px-6 py-3">Total</th>
                            <th scope="col" class="w-1/7 px-6 py-3">Status</th>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </center>
@endsection
