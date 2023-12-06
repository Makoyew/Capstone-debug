<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    @if(session('success'))
    <div id="successMessage" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
        <div class="flex">
            <div class="py-1">
                <svg class="w-6 h-6 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div>
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div id="errorMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">
        <strong class="font-bold">Access Denied:</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M6.293 6.293a1 1 0 011.414 0L10 10.586l2.293-2.293a1 1 0 111.414 1.414L11.414 12l2.293 2.293a1 1 0 01-1.414 1.414L10 13.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 12 6.293 9.707a1 1 0 010-1.414z"></path>
            </svg>
        </span>
    </div>
    @endif

    <script>
        function hideMessages() {
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');

            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 3000);
            }

            if (errorMessage) {
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 3000);
            }
        }
        window.addEventListener('load', hideMessages);
    </script>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
        <div class="bg-white rounded-lg shadow-md dark:bg-dark-eval-1 p-6 transition-transform transform hover:scale-105">
            <div class="flex items-center">
                <div class="bg-indigo-500 rounded-md p-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 14c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm-3-8h6"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Total Users</h3>
                    <p class="text-3xl font-bold text-indigo-500">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md dark:bg-dark-eval-1 p-6 transition-transform transform hover:scale-105">
            <div class="flex items-center">
                <div class="bg-green-500 rounded-md p-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Total Accepted Requests</h3>
                    <p class="text-3xl font-bold text-green-500">{{ $totalAcceptedRequests }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md dark:bg-dark-eval-1 p-6 transition-transform transform hover:scale-105">
            <div class="flex items-center">
                <div class="bg-yellow-500 rounded-md p-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Total Pending Requests</h3>
                    <p class="text-3xl font-bold text-yellow-500">{{ $totalPendingRequests }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md dark:bg-dark-eval-1 p-6 transition-transform transform hover:scale-105">
            <div class="flex items-center">
                <div class="bg-red-500 rounded-md p-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Total Rejected Requests</h3>
                    <p class="text-3xl font-bold text-red-500">{{ $totalRejectedRequests }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md dark:bg-dark-eval-1 p-6">
        <h3 class="text-2xl font-semibold mb-4">Department Heads</h3>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profile Image</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($supervisors as $supervisor)
                    <tr>
                        <td class="px-6 py-4">
                            @if ($supervisor->profile_picture)
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($supervisor->profile_picture) }}" alt="{{ $supervisor->full_name }} Profile Picture">
                            @else
                                <!-- Default profile image or placeholder image -->
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('images/default-profile.jpeg') }}" alt="{{ $supervisor->full_name }} Profile Picture">
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $supervisor->first_name }} {{ $supervisor->middle_name}} {{ $supervisor->surname}}</td>
                        <td class="px-6 py-4">{{ $supervisor->department->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
