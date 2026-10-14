{{--
    Dashboard View
    Extends the main app layout (layouts/app.blade.php)
    @yield('content') in the layout will be replaced with what's in @section('content') here
--}}
@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Page Header --}}
<div class="page-header">
    <h1>
        @if(auth()->user()->isAdmin())
            <i class="bi bi-speedometer2 me-2 text-primary"></i>Admin Dashboard
        @else
            <i class="bi bi-speedometer2 me-2 text-primary"></i>My Dashboard
        @endif
    </h1>
    <p>
        Welcome back, <strong>{{ auth()->user()->name }}</strong>!
        Today is {{ now()->format('l, d F Y') }}.
    </p>
</div>

{{-- ===== Statistics Cards ===== --}}
<div class="row g-3 mb-4">

    {{-- Total Customers --}}
    <div class="col-6 col-md-4 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#ede9fe; color:#7c3aed;">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-value">{{ $stats['total_customers'] }}</div>
            <div class="stat-label">Total Customers</div>
        </div>
    </div>

    {{-- Active Orders --}}
    <div class="col-6 col-md-4 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dbeafe; color:#1d4ed8;">
                <i class="bi bi-receipt-cutoff"></i>
            </div>
            <div class="stat-value">{{ $stats['active_orders'] }}</div>
            <div class="stat-label">Active Orders</div>
        </div>
    </div>

    {{-- Ready for Delivery --}}
    <div class="col-6 col-md-4 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dcfce7; color:#16a34a;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="stat-value">{{ $stats['ready_orders'] }}</div>
            <div class="stat-label">Ready for Delivery</div>
        </div>
    </div>

    {{-- Today's Deliveries --}}
    <div class="col-6 col-md-4 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef3c7; color:#d97706;">
                <i class="bi bi-truck"></i>
            </div>
            <div class="stat-value">{{ $stats['today_deliveries'] }}</div>
            <div class="stat-label">Due Today</div>
        </div>
    </div>

    {{-- Overdue Orders --}}
    <div class="col-6 col-md-4 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fee2e2; color:#dc2626;">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
            <div class="stat-value">{{ $stats['overdue_orders'] }}</div>
            <div class="stat-label">Overdue Orders</div>
        </div>
    </div>

    {{-- Pending Payments (Admin only) --}}
    @if(auth()->user()->isAdmin())
    <div class="col-6 col-md-4 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fce7f3; color:#be185d;">
                <i class="bi bi-cash-coin"></i>
            </div>
            <div class="stat-value">₹{{ number_format($stats['pending_payments']) }}</div>
            <div class="stat-label">Pending Payments</div>
        </div>
    </div>

    {{-- Total Revenue (Admin only) --}}
    <div class="col-6 col-md-4 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e0f2fe; color:#0284c7;">
                <i class="bi bi-currency-rupee"></i>
            </div>
            <div class="stat-value">₹{{ number_format($stats['total_revenue']) }}</div>
            <div class="stat-label">Total Revenue</div>
        </div>
    </div>
    @endif

</div>

{{-- ===== Getting Started Notice (shown when no data exists) ===== --}}
<div class="row g-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <div style="font-size:4rem; color:#e2e8f0; margin-bottom:1rem;">
                    <i class="bi bi-scissors"></i>
                </div>
                <h4 class="fw-bold text-secondary">Welcome to Tailor Shop Management System</h4>
                <p class="text-muted mb-4">
                    Your system is ready! Start by adding your first customer, then create measurements and orders.
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="#" class="btn btn-primary">
                        <i class="bi bi-person-plus me-2"></i>Add First Customer
                    </a>
                    <a href="#" class="btn btn-outline-secondary">
                        <i class="bi bi-receipt-cutoff me-2"></i>Create Order
                    </a>
                </div>
                <div class="mt-4 p-3 rounded" style="background:#f8fafc; display:inline-block;">
                    <p class="text-muted small mb-1">
                        <i class="bi bi-info-circle me-1"></i>
                        Charts and recent orders will appear here once you start adding data.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
