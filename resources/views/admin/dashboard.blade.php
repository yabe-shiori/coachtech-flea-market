<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 text-white">
                    <h3 class="text-lg font-bold mb-6">Admin Dashboard</h3>
                    <div>
                        <a href="{{ route('admin.item.index') }}" class="block py-2 text-blue-500 hover:underline mb-2">
                            <i class="fas fa-list mr-2"></i> View All Items
                        </a>
                        <a href="{{ route('admin.create') }}" class="block py-2 text-blue-500 hover:underline mb-2">
                            <i class="fas fa-user-plus mr-2"></i> Create Admin
                        </a>
                        <a href="{{ route('admin.seller_payments') }}" class="block py-2 text-blue-500 hover:underline">
                            <i class="fas fa-money-check-alt mr-2"></i> Seller Payments
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
