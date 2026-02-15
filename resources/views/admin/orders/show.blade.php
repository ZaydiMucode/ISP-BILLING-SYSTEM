@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="min-h-screen bg-gray-100" x-data="{ sidebarOpen: false }">
    @include('admin.partials.sidebar')

    <div class="lg:pl-64">
        @include('admin.partials.topbar')

        <div class="p-6">
            <!-- Header -->
            <div class="mb-6 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $order->order_number }}</h1>
                        <p class="text-gray-600">{{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    @php $badge = $order->status_badge; @endphp
                    <span class="px-4 py-2 rounded-lg bg-{{ $badge['color'] }}-100 text-{{ $badge['color'] }}-800 font-medium">{{ $badge['label'] }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4"><i class="fas fa-user mr-2 text-cyan-600"></i>Customer Information</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Name</p>
                                <p class="font-medium">{{ $order->customer_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Phone</p>
                                <p class="font-medium">
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $order->customer_phone) }}" target="_blank" class="text-green-600 hover:underline">
                                        <i class="fab fa-whatsapp mr-1"></i>{{ $order->customer_phone }}
                                    </a>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium">{{ $order->customer_email ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">National ID (NIK)</p>
                                <p class="font-medium">{{ $order->customer_nik ?? '-' }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm text-gray-500">Address</p>
                                <p class="font-medium">{{ $order->customer_address }}</p>
                                @if($order->latitude && $order->longitude)
                                <a href="https://maps.google.com/?q={{ $order->latitude }},{{ $order->longitude }}" target="_blank" class="text-sm text-cyan-600 hover:underline">
                                    <i class="fas fa-map-marker-alt mr-1"></i>View on Google Maps
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Package Info -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4"><i class="fas fa-box mr-2 text-cyan-600"></i>Package Details</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Package</p>
                                <p class="font-medium">{{ $order->package->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Speed</p>
                                <p class="font-medium">{{ $order->package->speed }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Connection Type</p>
                                <p class="font-medium">{{ strtoupper($order->connection_type) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Package Price</p>
                                <p class="font-medium"> ₱ {{ number_format($order->package_price, 0, ',', '.') }}/month</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4"><i class="fas fa-credit-card mr-2 text-cyan-600"></i>Payment</h3>
                        @php $payBadge = $order->payment_status_badge; @endphp
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                <span class="px-2 py-1 text-xs rounded-full bg-{{ $payBadge['color'] }}-100 text-{{ $payBadge['color'] }}-800">{{ $payBadge['label'] }}</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Method</p>
                                <p class="font-medium">{{ ucfirst($order->payment_method) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Package Fee</p>
                                <p class="font-medium">₱ {{ number_format($order->package_price, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Installation Fee</p>
                                <p class="font-medium">₱ {{ number_format($order->installation_fee, 0, ',', '.') }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm text-gray-500">Total Amount</p>
                                <p class="text-2xl font-bold text-cyan-600">₱ {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </div>
                            @if($order->paid_at)
                            <div>
                                <p class="text-sm text-gray-500">Payment Date</p>
                                <p class="font-medium">{{ $order->paid_at->format('d M Y H:i') }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    @if($order->customer_notes)
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4"><i class="fas fa-sticky-note mr-2 text-cyan-600"></i>Customer Notes</h3>
                        <p class="text-gray-700">{{ $order->customer_notes }}</p>
                    </div>
                    @endif
                </div>

                <!-- Actions Sidebar -->
                <div class="space-y-6">
                    <!-- Update Status -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Update Status</h3>
                        <form id="statusForm" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Order Status</label>
                                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="scheduled" {{ $order->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                    <option value="installing" {{ $order->status == 'installing' ? 'selected' : '' }}>Installation</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Installation Date</label>
                                <input type="date" name="installation_date" value="{{ $order->installation_date?->format('Y-m-d') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Time Slot</label>
                                <select name="installation_time" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                    <option value="">Select Time</option>
                                    <option value="08:00-10:00" {{ $order->installation_time == '08:00-10:00' ? 'selected' : '' }}>08:00 - 10:00</option>
                                    <option value="10:00-12:00" {{ $order->installation_time == '10:00-12:00' ? 'selected' : '' }}>10:00 - 12:00</option>
                                    <option value="13:00-15:00" {{ $order->installation_time == '13:00-15:00' ? 'selected' : '' }}>13:00 - 15:00</option>
                                    <option value="15:00-17:00" {{ $order->installation_time == '15:00-17:00' ? 'selected' : '' }}>15:00 - 17:00</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Technician</label>
                                <select name="technician_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                    <option value="">Select Technician</option>
                                    @foreach($technicians as $tech)
                                    <option value="{{ $tech->id }}" {{ $order->technician_id == $tech->id ? 'selected' : '' }}>{{ $tech->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Admin Notes</label>
                                <textarea name="admin_notes" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg">{{ $order->admin_notes }}</textarea>
                            </div>
                            <button type="submit" class="w-full bg-cyan-600 text-white py-2 rounded-lg hover:bg-cyan-700">
                                <i class="fas fa-save mr-2"></i>Save Changes
                            </button>
                        </form>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-2">
                            @if($order->payment_status === 'pending')
                            <button onclick="confirmPayment()" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
                                <i class="fas fa-check-circle mr-2"></i>Confirm Payment
                            </button>
                            @endif
                            
                            @if($order->status === 'installing' && $order->payment_status === 'paid')
                            <button onclick="completeOrder()" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                                <i class="fas fa-user-plus mr-2"></i>Complete & Create Customer
                            </button>
                            @endif

                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $order->customer_phone) }}" target="_blank" class="block w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 text-center">
                                <i class="fab fa-whatsapp mr-2"></i>Contact via WhatsApp
                            </a>
                        </div>
                    </div>

                    @if($order->customer_id)
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                        <p class="text-green-800 font-medium"><i class="fas fa-check-circle mr-2"></i>Already a customer</p>
                        <a href="{{ route('admin.customers.show', $order->customer_id) }}" class="text-sm text-green-600 hover:underline">View customer data →</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('statusForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    Swal.fire({
        title: 'Update Status?',
        text: 'Are you sure you want to update the order status?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0891b2',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Update!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            showLoading('Saving...');
            fetch('{{ route("admin.orders.update-status", $order) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(Object.fromEntries(formData))
            })
            .then(r => r.json())
            .then(data => {
                Swal.close();
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => location.reload());
                } else {
                    showError(data.message || 'An error occurred');
                }
            })
            .catch(() => {
                Swal.close();
                showError('Network error occurred');
            });
        }
    });
});

function confirmPayment() {
    Swal.fire({
        title: 'Confirm Payment?',
        text: 'Are you sure the payment has been received?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Confirm!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            showLoading('Processing...');
            fetch('{{ route("admin.orders.confirm-payment", $order) }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(r => r.json())
            .then(data => {
                Swal.close();
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Payment Confirmed!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => location.reload());
                } else {
                    showError(data.message || 'An error occurred');
                }
            })
            .catch(() => {
                Swal.close();
                showError('Network error occurred');
            });
        }
    });
}

function completeOrder() {
    Swal.fire({
        title: 'Complete Order?',
        html: 'The order will be completed and a <strong>new customer account</strong> will be created automatically.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#2563eb',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Complete!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            showLoading('Creating customer account...');
            fetch('{{ route("admin.orders.complete", $order) }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(r => r.json())
            .then(data => {
                Swal.close();
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Completed!',
                        text: data.message,
                        showConfirmButton: true,
                        confirmButtonColor: '#0891b2'
                    }).then(() => location.reload());
                } else {
                    showError(data.message || 'An error occurred');
                }
            })
            .catch(() => {
                Swal.close();
                showError('Network error occurred');
            });
        }
    });
}
</script>
@endpush
@endsection
