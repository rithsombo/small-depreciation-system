@extends('layouts.main')
@section('content')

        <center>
            <div class="pt-4">
                <div class="relative overflow-x-auto" style="z-index: 30;">
                    <p class="flex justify-center items-center mb-3">Customer who already paid, Total : {{$customerCount}}</p>
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
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach($data as $user)
                            <tr class="border-b text-green" x-data="{ showEditModal: false, showDeleteModal: false }">
                                <th scope="row" class="px-6 py-4 font-medium text-green whitespace-nowrap">{{ $loop->iteration }}</th>
                                <td class="px-6 py-4">{{ $user->cusname }}</td>
                                <td class="px-6 py-4">{{ $user->productname }}</td>
                                <td class="px-6 py-4">{{ $user->product_price }}</td>
                                <td class="px-6 py-4">{{ $user->interest }}</td>
                                <td class="px-6 py-4">{{ $user->duration }}</td>
                                <td class="px-6 py-4">
                                    <img src="{{ asset('/photo/' . $user->photo) }}" alt="User Image" class="w-12 h-12 rounded-full">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </center>
@endsection
