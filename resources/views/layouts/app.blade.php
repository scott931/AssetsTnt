<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Asset Management System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Sidebar (revamped, pure Tailwind CSS) -->
            <div class="fixed inset-y-0 left-0 z-50 w-64 h-screen bg-white shadow-lg overflow-y-auto flex flex-col"
           >
                <div class="flex items-center justify-center h-16 bg-white-600" style="height: 84px;">
                    <h1 class="text-xl font-bold text-black">TNT Asset Management</h1>
                </div>
                <nav class="mt-8 flex-1">
                    <ul class="space-y-1">
                        <!-- Dashboard -->
                        <li>
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"/></svg>
                            Dashboard
                        </a>
                        </li>

                        <!-- Land Register Link -->
                        <li>
                            <a href="{{ route('land-register.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('land-register.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"/></svg>
                                Land Register
                            </a>
                        </li>

                        <!-- Building Register Link -->
                        <li>
                            <a href="{{ route('building-register.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('building-register.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                Building Register
                            </a>
                        </li>

                        <!-- Divider -->
                        <li class="my-2">
                            <hr class="border-gray-200">
                        </li>
                        <!-- Assets Dropdown -->
                        <li>
                            <input type="checkbox" id="assetsMenu" class="peer hidden">
                            <label for="assetsMenu" class="flex items-center gap-3 px-4 py-2 rounded-lg cursor-pointer transition-colors {{ request()->routeIs('assets.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    Assets
                                <svg class="w-4 h-4 ml-auto transition-transform peer-checked:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </label>
                            <ul class="flex flex-col gap-1 max-h-0 overflow-hidden peer-checked:max-h-40 peer-checked:py-1 peer-checked:mb-2 transition-all duration-300 bg-blue-50 rounded-lg mx-2">
                                <li><a href="{{ route('assets.index') }}" class="block px-8 py-2 rounded hover:bg-blue-100 text-gray-700">View All</a></li>
                                <li><a href="{{ route('assets.create') }}" class="block px-8 py-2 rounded hover:bg-blue-100 text-gray-700">+ Add Asset</a></li>
                            </ul>
                        </li>
                        <!-- Categories Dropdown -->
                        <li>
                            <input type="checkbox" id="categoriesMenu" class="peer hidden">
                            <label for="categoriesMenu" class="flex items-center gap-3 px-4 py-2 rounded-lg cursor-pointer transition-colors {{ request()->routeIs('categories.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                    Categories
                                <svg class="w-4 h-4 ml-auto transition-transform peer-checked:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </label>
                            <ul class="flex flex-col gap-1 max-h-0 overflow-hidden peer-checked:max-h-40 peer-checked:py-1 peer-checked:mb-2 transition-all duration-300 bg-blue-50 rounded-lg mx-2">
                                <li><a href="{{ route('categories.index') }}" class="block px-8 py-2 rounded hover:bg-blue-100 text-gray-700">View All</a></li>
                                <li><a href="{{ route('categories.create') }}" class="block px-8 py-2 rounded hover:bg-blue-100 text-gray-700">+ Add Category</a></li>
                            </ul>
                        </li>
                        <!-- Departments Dropdown -->
                        <li>
                            <input type="checkbox" id="departmentsMenu" class="peer hidden">
                            <label for="departmentsMenu" class="flex items-center gap-3 px-4 py-2 rounded-lg cursor-pointer transition-colors {{ request()->routeIs('departments.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    Departments
                                <svg class="w-4 h-4 ml-auto transition-transform peer-checked:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </label>
                            <ul class="flex flex-col gap-1 max-h-0 overflow-hidden peer-checked:max-h-40 peer-checked:py-1 peer-checked:mb-2 transition-all duration-300 bg-blue-50 rounded-lg mx-2">
                                <li><a href="{{ route('departments.index') }}" class="block px-8 py-2 rounded hover:bg-blue-100 text-gray-700">View All</a></li>
                                <li><a href="{{ route('departments.create') }}" class="block px-8 py-2 rounded hover:bg-blue-100 text-gray-700">+ Add Department</a></li>
                            </ul>
                        </li>
                        <!-- Locations Dropdown -->
                        <li>
                            <input type="checkbox" id="locationsMenu" class="peer hidden">
                            <label for="locationsMenu" class="flex items-center gap-3 px-4 py-2 rounded-lg cursor-pointer transition-colors {{ request()->routeIs('locations.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Locations
                                <svg class="w-4 h-4 ml-auto transition-transform peer-checked:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </label>
                            <ul class="flex flex-col gap-1 max-h-0 overflow-hidden peer-checked:max-h-40 peer-checked:py-1 peer-checked:mb-2 transition-all duration-300 bg-blue-50 rounded-lg mx-2">
                                <li><a href="{{ route('locations.index') }}" class="block px-8 py-2 rounded hover:bg-blue-100 text-gray-700">View All</a></li>
                                <li><a href="{{ route('locations.create') }}" class="block px-8 py-2 rounded hover:bg-blue-100 text-gray-700">+ Add Location</a></li>
                            </ul>
                        </li>
                        <!-- Suppliers Dropdown -->
                        <li>
                            <input type="checkbox" id="suppliersMenu" class="peer hidden">
                            <label for="suppliersMenu" class="flex items-center gap-3 px-4 py-2 rounded-lg cursor-pointer transition-colors {{ request()->routeIs('suppliers.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    Suppliers
                                <svg class="w-4 h-4 ml-auto transition-transform peer-checked:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </label>
                            <ul class="flex flex-col gap-1 max-h-0 overflow-hidden peer-checked:max-h-40 peer-checked:py-1 peer-checked:mb-2 transition-all duration-300 bg-blue-50 rounded-lg mx-2">
                                <li><a href="{{ route('suppliers.index') }}" class="block px-8 py-2 rounded hover:bg-blue-100 text-gray-700">View All</a></li>
                                <li><a href="{{ route('suppliers.create') }}" class="block px-8 py-2 rounded hover:bg-blue-100 text-gray-700">+ Add Supplier</a></li>
                            </ul>
                        </li>
                        <!-- Maintenance Link -->
                        <li>
                            <a href="{{ route('maintenance.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('maintenance.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Maintenance
                            </a>
                        </li>
                        <!-- Reports Link -->
                        <li>
                            <a href="{{ route('reports.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('reports.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                Reports
                            </a>
                        </li>
                        <!-- Settings Link -->
                        <li>
                            <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('settings.index') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                                Settings
                            </a>
                        </li>
                        <!-- Users Dropdown -->
                        <li>
                            <input type="checkbox" id="usersMenu" class="peer hidden">
                            <label for="usersMenu" class="flex items-center gap-3 px-4 py-2 rounded-lg cursor-pointer transition-colors {{ request()->routeIs('users.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                                    Users
                                <svg class="w-4 h-4 ml-auto transition-transform peer-checked:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </label>
                            <ul class="flex flex-col gap-1 max-h-0 overflow-hidden peer-checked:max-h-40 peer-checked:py-1 peer-checked:mb-2 transition-all duration-300 bg-blue-50 rounded-lg mx-2">
                                <li><a href="{{ route('users.index') }}" class="block px-8 py-2 rounded hover:bg-blue-100 text-gray-700">View All</a></li>
                                <li><a href="{{ route('users.create') }}" class="block px-8 py-2 rounded hover:bg-blue-100 text-gray-700">+ Add User</a></li>
                            </ul>
                        </li>


                        <!-- Regions Link -->
                        <li>
                            <a href="{{ route('regions.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('regions.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Regions
                            </a>
                        </li>
                        <!-- Transfer Assets Button -->
                        <li>
                            <!-- <a href="{{ route('transfers.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-blue-500 text-white font-semibold shadow hover:bg-blue-transition-colors"> -->
                            <a href="{{ route('transfers.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('transfers.index') ? 'bg-blue-600 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                Transfer Assets
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="ml-64 min-h-screen">
                <!-- Top Navigation -->
                <div class="bg-white shadow-sm border-b">
                    <!-- <div class="flex items-center justify-between px-6 py-4"> -->
                    <div class="flex items-center justify-between px-6 py-4 w-full">
                        <div class="flex items-center">
                            <h2 class="text-xl font-semibold text-gray-800">
                                @yield('header', 'Dashboard')
                            </h2>
                        </div>

                        <div class="flex items-center space-x-4">
                            <!-- Quick Actions -->
                            <div class="relative">
                                <button id="quickActionsBtn" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>

                                <!-- Quick Actions Dropdown -->
                                <div id="quickActionsDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg z-50 border border-gray-200">
                                    <div class="py-1">
                                        <a href="{{ route('assets.create') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                            Add New Asset
                                        </a>
                                        <a href="{{ route('maintenance.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Schedule Maintenance
                                        </a>
                                        <a href="{{ route('transfers.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                            </svg>
                                            Transfer Asset
                                        </a>
                                        <a href="{{ route('reports.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                            Generate Report
                                        </a>
                                        <a href="{{ route('land-register.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"/></svg>
                                            Land Register
                                        </a>
                                        <a href="{{ route('building-register.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                            Building Register
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Notifications -->
                            <div class="relative">
                                <button id="notificationsBtn" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg relative">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.19 4.19A4 4 0 004 6v6a4 4 0 004 4h6a4 4 0 004-4V6a4 4 0 00-4-4H8a4 4 0 00-2.83 1.17z"></path>
                                    </svg>
                                    <!-- Notification Badge -->
                                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                                </button>

                                <!-- Notifications Dropdown -->
                                <div id="notificationsDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-50 border border-gray-200">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <h3 class="text-sm font-semibold text-gray-900">Notifications</h3>
                                    </div>
                                    <div class="py-1 max-h-64 overflow-y-auto">
                                        <!-- Maintenance Due -->
                                        <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-3 flex-1">
                                                    <p class="text-sm font-medium text-gray-900">Maintenance Due</p>
                                                    <p class="text-sm text-gray-500">Laptop #LAP001 requires maintenance in 2 days</p>
                                                    <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Asset Assigned -->
                                        <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-3 flex-1">
                                                    <p class="text-sm font-medium text-gray-900">Asset Assigned</p>
                                                    <p class="text-sm text-gray-500">Monitor #MON002 has been assigned to you</p>
                                                    <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Transfer Request -->
                                        <div class="px-4 py-3 hover:bg-gray-50">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-3 flex-1">
                                                    <p class="text-sm font-medium text-gray-900">Transfer Request</p>
                                                    <p class="text-sm text-gray-500">Transfer request for Printer #PRN001 approved</p>
                                                    <p class="text-xs text-gray-400 mt-1">3 days ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 border-t border-gray-200">
                                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">View all notifications</a>
                                    </div>
                                </div>
                            </div>

                            <!-- User Profile Menu -->
                            <div class="relative">
                                <button id="userMenuBtn" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg px-3 py-2">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                    <div class="hidden md:block text-left">
                                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                    </div>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <!-- User Profile Dropdown -->
                                <div id="userMenuDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 border border-gray-200">
                                    <div class="py-1">
                                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            Profile Settings
                                        </a>
                                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                            </svg>
                                            Dashboard
                                        </a>
                                        <a href="{{ route('settings.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Settings
                                        </a>
                                        <div class="border-t border-gray-100"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                </svg>
                                                Sign Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page Content -->
                <main class="p-6">
                    @isset($slot)
                        {{ $slot }}
                    @else
                        @yield('content')
                    @endisset
                </main>
            </div>
        </div>

        <!-- JavaScript for Dropdowns -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Quick Actions Dropdown
                const quickActionsBtn = document.getElementById('quickActionsBtn');
                const quickActionsDropdown = document.getElementById('quickActionsDropdown');

                if (quickActionsBtn && quickActionsDropdown) {
                    quickActionsBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        quickActionsDropdown.classList.toggle('hidden');
                        // Close other dropdowns
                        notificationsDropdown.classList.add('hidden');
                        userMenuDropdown.classList.add('hidden');
                    });
                }

                // Notifications Dropdown
                const notificationsBtn = document.getElementById('notificationsBtn');
                const notificationsDropdown = document.getElementById('notificationsDropdown');

                if (notificationsBtn && notificationsDropdown) {
                    notificationsBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        notificationsDropdown.classList.toggle('hidden');
                        // Close other dropdowns
                        quickActionsDropdown.classList.add('hidden');
                        userMenuDropdown.classList.add('hidden');
                    });
                }

                // User Menu Dropdown
                const userMenuBtn = document.getElementById('userMenuBtn');
                const userMenuDropdown = document.getElementById('userMenuDropdown');

                if (userMenuBtn && userMenuDropdown) {
                    userMenuBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        userMenuDropdown.classList.toggle('hidden');
                        // Close other dropdowns
                        quickActionsDropdown.classList.add('hidden');
                        notificationsDropdown.classList.add('hidden');
                    });
                }

                // Close dropdowns when clicking outside
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.relative')) {
                        quickActionsDropdown.classList.add('hidden');
                        notificationsDropdown.classList.add('hidden');
                        userMenuDropdown.classList.add('hidden');
                    }
                });

                // Close dropdowns when pressing Escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        quickActionsDropdown.classList.add('hidden');
                        notificationsDropdown.classList.add('hidden');
                        userMenuDropdown.classList.add('hidden');
                    }
                });
            });
        </script>

        <!-- Modals for Add Forms -->
        <div id="categoryModal" class="modal hidden"> <div class="modal-content"><h2>Add Category</h2><form method="POST" action="{{ route('categories.store') }}">@csrf<input type="text" name="name" placeholder="Name" required class="input"><input type="text" name="code" placeholder="Code" class="input"><textarea name="description" placeholder="Description" class="input"></textarea><label><input type="checkbox" name="is_active" value="1" checked> Active</label><button type="button" onclick="closeModal('categoryModal')" class="btn-cancel">Cancel</button><button type="submit" class="btn-primary">Add</button></form></div></div>
        <style>.modal { position: fixed; inset: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 1000; } .modal.hidden { display: none; } .modal-content { background: #fff; padding: 2rem; border-radius: 0.5rem; width: 100%; max-width: 400px; } .input { display: block; width: 100%; margin-bottom: 1rem; padding: 0.5rem; border: 1px solid #ccc; border-radius: 0.25rem; } .btn-primary { background: #2563eb; color: #fff; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; } .btn-cancel { background: #e5e7eb; color: #111; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; margin-right: 0.5rem; }</style><script>function openModal(id) { document.getElementById(id).classList.remove('hidden'); } function closeModal(id) { document.getElementById(id).classList.add('hidden'); }</script>
        <script>
        function toggleSidebarMenu(id) {
            // Close all dropdowns first
            const dropdowns = ['assetsSubmenu', 'departmentsSubmenu', 'locationsSubmenu', 'suppliersSubmenu', 'usersSubmenu'];
            const arrows = ['assetsSubmenuArrow', 'departmentsSubmenuArrow', 'locationsSubmenuArrow', 'suppliersSubmenuArrow', 'usersSubmenuArrow'];
            dropdowns.forEach(function(d) {
                if (d !== id) {
                    var el = document.getElementById(d);
                    if (el) {
                        el.classList.add('max-h-0', 'opacity-0', 'pointer-events-none');
                        el.classList.remove('max-h-96', 'opacity-100', 'pointer-events-auto');
                    }
                }
            });
            arrows.forEach(function(a) {
                if (a !== id + 'Arrow') {
                    var arrow = document.getElementById(a);
                    if (arrow) {
                        arrow.classList.remove('rotate-180');
                    }
                }
            });
            // Toggle the clicked one
            var el = document.getElementById(id);
            var arrow = document.getElementById(id + 'Arrow');
            if (el.classList.contains('max-h-0')) {
                el.classList.remove('max-h-0', 'opacity-0', 'pointer-events-none');
                el.classList.add('max-h-96', 'opacity-100', 'pointer-events-auto');
                if (arrow) arrow.classList.add('rotate-180');
            } else {
                el.classList.add('max-h-0', 'opacity-0', 'pointer-events-none');
                el.classList.remove('max-h-96', 'opacity-100', 'pointer-events-auto');
                if (arrow) arrow.classList.remove('rotate-180');
            }
        }
        </script>
        <script>
        function showAndScrollToAssetForm() {
            var formSection = document.getElementById('assetFormSection');
            if (formSection && formSection.classList.contains('hidden')) {
                formSection.classList.remove('hidden');
            }
            if (formSection) {
                formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
        </script>
        <script>
        function closeAllSidebarDropdowns() {
            const dropdowns = ['assetsSubmenu', 'departmentsSubmenu', 'locationsSubmenu', 'suppliersSubmenu', 'usersSubmenu'];
            const arrows = ['assetsSubmenuArrow', 'departmentsSubmenuArrow', 'locationsSubmenuArrow', 'suppliersSubmenuArrow', 'usersSubmenuArrow'];
            dropdowns.forEach(function(d) {
                var el = document.getElementById(d);
                if (el) {
                    el.classList.add('max-h-0', 'opacity-0', 'pointer-events-none');
                    el.classList.remove('max-h-96', 'opacity-100', 'pointer-events-auto');
                }
            });
            arrows.forEach(function(a) {
                var arrow = document.getElementById(a);
                if (arrow) {
                    arrow.classList.remove('rotate-180');
                }
            });
        }
        </script>
    </body>
</html>
