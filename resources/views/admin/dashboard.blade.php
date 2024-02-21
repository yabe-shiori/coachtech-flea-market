<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 text-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold">Admin Dashboard</h3>
                        <div class="flex items-center">
                            <a href="{{ route('admin.item.index') }}" class="text-blue-500 hover:underline mr-6">
                                <i class="fas fa-list mr-2"></i> View All Items
                            </a>
                            <a href="{{ route('admin.create') }}" class="text-blue-500 hover:underline mr-6">
                                <i class="fas fa-user-plus mr-2"></i> Create Admin
                            </a>
                            <a href="{{ route('admin.seller_payments') }}" class="text-blue-500 hover:underline">
                                <i class="fas fa-money-check-alt mr-2"></i> Seller Payments
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
