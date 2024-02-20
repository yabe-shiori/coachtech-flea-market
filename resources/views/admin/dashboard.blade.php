<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 text-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold">Admin Dashboard</h3>
                        <div>
                            <a href="{{ route('admin.item.index') }}" class="text-blue-500 hover:underline flex items-center">
                                <i class="fas fa-list mr-2"></i> View All Items
                            </a>
                            <a href="{{ route('admin.create') }}" class="ml-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 flex items-center">
                                <i class="fas fa-user-plus mr-2"></i> Create Admin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
