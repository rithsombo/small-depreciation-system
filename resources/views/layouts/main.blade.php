<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=abel:400|barriecito:400" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        /* Add CSS transitions for smoother animation */
        .dropdown-content {
            transition: opacity 0.2s ease-in-out, visibility 0.2s ease-in-out;
            opacity: 0;
            visibility: hidden;
            z-index: 50; /* Ensure dropdown has a high z-index */
        }
        .dropdown-content.show {
            opacity: 1;
            visibility: visible;
        }
        .relative {
            position: relative; /* Ensure it has relative positioning */
            z-index: 40; /* Ensure relative parent has a lower z-index than dropdown */
        }
        /* Adjust modal styles */
        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 60; /* Higher z-index than navbar */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-height: 80vh; /* Adjust as needed */
            overflow-y: auto;
        }
    </style>
</head>

<body class="w-screen h-screen wanted-green">
<div class="sticky flex justify-center pt-1 top-0 z-40"> <!-- Adjusted z-index -->
    <!-- navbar -->
    <div class="w-4/5 h-20 bg-white flex justify-center items-center text-green-600 p-10 rounded-xl">
        <div class="relative">
            <button onclick="toggleDropdown('setting')" style="font-family: 'Figtree';" class="flex justify-center items-center py-2 px-4 rounded hover:text-green-700 focus:text-green-700">
                Setting
            </button>
            <div id="setting" class="absolute dropdown-content bg-white ml-4 text-gray-700 pt-1 w-auto shadow-lg rounded-r rounded-l">
                <a href="{{'customer'}}" class="text-green block px-4 py-2 text-sm hover:bg-gray-200">System</a>
                <a href="{{'user'}}" class="text-green block px-4 py-2 text-sm hover:bg-gray-200">User_account</a>
            </div>
        </div>
        <div class="relative">
            <button onclick="toggleDropdown('report')" style="font-family: 'Figtree';" class="text-green-600 py-2 px-4 rounded hover:text-green-700 focus:text-green-700">
                Report
            </button>
            <div id="report" class="absolute dropdown-content bg-white ml-4 text-gray-700 pt-1 w-auto shadow-lg rounded-r rounded-l">
                <a href="{{ route('money_report') }}" class="text-green block px-4 py-2 text-sm hover:bg-gray-200">14 days report</a>
                <a href="{{ route('customer_havenot_paid') }}" class="text-green block px-4 py-2 text-sm hover:bg-gray-200">On Pending</a>
                <a href="{{ route('customer_unpaid') }}" class="text-green block px-4 py-2 text-sm hover:bg-gray-200">Customer_not_yet_paid</a>
                <a href="{{ route('customer_paid') }}" class="text-green block px-4 py-2 text-sm hover:bg-gray-200">Customer_paid</a>
                <a href="{{ route('total_customer') }}" class="text-green block px-4 py-2 text-sm hover:bg-gray-200">Total Customer</a>
            </div>
        </div>
        <div style="font-family: 'Barriecito';" class="text-green-600 py-2 px-4 hover:text-green-700 focus:text-green-700"><a href="#">Document</a></div>
    </div>
</div>
@yield('content')
</body>

<script>
    // Toggle dropdown visibility
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const isShown = dropdown.classList.contains('show');
        hideAllDropdowns();
        if (!isShown) {
            dropdown.classList.add('show');
        }
    }

    // Hide all dropdowns
    function hideAllDropdowns() {
        const dropdowns = document.querySelectorAll('.dropdown-content');
        dropdowns.forEach((dropdown) => {
            dropdown.classList.remove('show');
        });
    }

    // Close dropdowns when clicking outside
    document.addEventListener("click", function(event) {
        if (!event.target.closest('.relative')) {
            hideAllDropdowns();
        }
    });
</script>

</html>
