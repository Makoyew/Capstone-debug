<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Evaluation') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
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
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <div class="flex">
                    <div class="py-1">
                        <svg class="w-6 h-6 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div>
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Profile Image</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Department</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Evaluation Action</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">...</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 text-center whitespace-no-wrap">
                            <div class="flex items-center justify-center">
                                <!-- Profile Picture -->
                                <!-- Adjust the logic based on your actual structure -->
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if ($user->profile_picture)
                                        <img class="h-10 w-10 rounded-full object-cover border-4 border-blue-500" src="{{ Storage::url($user->profile_picture) }}" alt="{{ $user->name }} Profile Picture">
                                    @else
                                        <img class="h-10 w-10 rounded-full object-cover border-4 border-blue-500" src="{{ asset('images/default-profile.jpeg') }}" alt="{{ $user->name }} Profile Picture">
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-no-wrap">
                            <div class="ml-4">
                                <div class="text-sm leading-5 font-medium text-gray-900">{{ $user->first_name }} {{$user->middle_name}} {{ $user->surname }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-no-wrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-center whitespace-no-wrap">
                            @if ($user->department)
                                {{ $user->department->name }}
                            @else
                                Department Not Assigned
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center whitespace-no-wrap">
                            @if (!$user->hasEvaluated(auth()->user()))
                                <!-- Evaluate Button -->
                                <a href="{{ route('evaluations.form', ['user_id' => $user->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-2 rounded-md transition duration-300 ease-in-out transform hover:scale-105">Evaluate</a>
                            @else
                                @if ($user->evaluations->isNotEmpty())
                                    @foreach ($user->evaluations as $evaluation)
                                        @if ($evaluation->submitted_at)
                                            <span class="text-sm text-black block mt-1">
                                                Submitted on {{ \Carbon\Carbon::parse($evaluation->submitted_at)->format('Y-m-d H:i:s') }}
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-300 block mt-1">No submission date available</span>
                                        @endif
                                    @endforeach
                                @else
                                    <span class="text-sm text-gray-300 block mt-1">No evaluation data found</span>
                                @endif
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center whitespace-no-wrap">
                            @if ($user->evaluations->isNotEmpty())
                                <a href="{{ route('evaluations.view', ['user_id' => $user->id]) }}" class="text-blue-500 hover:underline animated-eye">
                                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
