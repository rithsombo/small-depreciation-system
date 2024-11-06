@extends('layouts.main')
@section('content')
    <center><img src="{{ asset('img/main_photo.png') }}" alt="" class=""/></center>
    <div>
        User
    </div>
    <center>
        <div class="pt-10">
            <div class="relative overflow-x-auto" style="z-index: 30;">
                <table
                    class="w-4/5 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-xl overflow-hidden">
                    <thead class="text-xs uppercase text-green bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Password
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($data as $item)
                        <tr class="border-b text-green">
                            <th scope="row" class="px-6 py-4 font-medium text-green whitespace-nowrap">
                                {{$loop->iteration}}
                            </th>
                            <td class="px-6 py-4">
                                {{$item->username}}
                            </td>
                            <td class="px-6 py-4">
                                {{$item->userpassword}}
                            </td>
                            <td class="px-6 py-4">
                                {{$item->userpassword}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </center>
@endsection
