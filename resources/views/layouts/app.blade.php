<!DOCTYPE html>
<html class="h-full bg-white" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

	<!-- Scripts -->

	<link rel="stylesheet" href="/public/fontawesome/css/all.min.css">

	@vite('resources/css/app.css')

	<link rel="stylesheet" href="https://rsms.me/inter/inter.css">
	@livewireStyles
	@filamentStyles

</head>
<body class="font-sans antialiased h-full bg-gray-100">
<div x-data="{ open: false }" @keydown.window.escape="open = false">
	<x-nav-bar/>
	<div class="lg:pl-72">
		<div class="sticky top-0 z-10 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
			<button x-on:click="open = true" type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden">
				<span class="sr-only">Open sidebar</span>
				<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
					 aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round"
						  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
				</svg>
			</button>

			<!-- Separator -->
			<div class="h-6 w-px bg-gray-900/10 lg:hidden" aria-hidden="true"></div>

			<div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
				<div class="flex flex-1 items-center text-xl font-bold text-gray-800">
				</div>
				<form class="hidden relative flex flex-1" action="#" method="GET">
					<label for="search-field" class="sr-only">Search</label>
					<svg class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400"
						 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
						<path fill-rule="evenodd"
							  d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
							  clip-rule="evenodd"/>
					</svg>
					<input id="search-field"
						   class="block h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm"
						   placeholder="Search..." type="search" name="search">
				</form>
				<div class="flex items-center gap-x-4 lg:gap-x-6">
					<button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500 hidden">
						<span class="sr-only">View notifications</span>
						<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
							 aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round"
								  d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
						</svg>
					</button>

					<!-- Profile dropdown -->
					<div class="relative" x-data="{ openProfile: false }">
						<button x-on:click="openProfile = !openProfile" type="button" class="-m-1.5 flex items-center p-1.5"
								id="user-menu-button" aria-expanded="false" aria-haspopup="true">
							<span class="sr-only">Open user menu</span>
							<img class="h-8 w-8 rounded-full bg-gray-50" src="{{ auth()->user()->avatarUrl() }}" alt="">
							<span class="hidden lg:flex lg:items-center">
								<span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">{{ auth()->user()->name }}</span>
								<svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
								</svg>
							</span>
						</button>
						<div x-cloak x-show="openProfile" x-on:click.away="openProfile = false" x-on:keydown.escape.window="openProfile = false"
							 x-transition:enter="transition ease-out duration-100"
							 x-transition:enter-start="transform opacity-0 scale-95"
							 x-transition:enter-end="transform opacity-100 scale-100"
							 x-transition:leave="transition ease-in duration-75"
							 x-transition:leave-start="transform opacity-100 scale-100"
							 x-transition:leave-end="transform opacity-0 scale-95"
							 class="absolute right-0 z-30 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
							 role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
							<a href="{{ route('profile') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-0">Your profile</a>
							@livewire('logout-component')
						</div>
					</div>
				</div>
			</div>
		</div>

		<main class="py-10">
			<div class="px-4 sm:px-6 lg:px-8">

			<div class="py-12">
       		 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            	<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                	<div class="p-6 text-gray-900">

				{{ $slot }}

				  </div>
            </div>
        </div>
    </div>
			</div>
		</main>
	</div>
</div>

@livewire('notifications')
@livewireScripts
@filamentScripts
@vite('resources/js/app.js')


</body>
</html>
