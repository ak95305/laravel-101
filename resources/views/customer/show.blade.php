@extends('layouts.admin')

@section('title', 'Customer Details')

@section('additional_styles')
<style>
    .customer-info {
        margin-bottom: 30px;
    }
    .info-group {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    .info-group:last-child {
        border-bottom: none;
    }
    .info-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
        font-size: 18px;
    }
    .info-value {
        font-size: 16px;
        color: #555;
    }
    .btn-danger {
        background: #e74c3c;
    }
    .btn-danger:hover {
        background: #c0392b;
    }
    .actions {
        margin-top: 30px;
        display: flex;
        justify-content: flex-start;
        gap: 10px;
    }
    .btn-secondary {
        background: #7f8c8d;
    }
    .btn-secondary:hover {
        background: #6c7a7d;
    }
</style>
@endsection

@section('content')
<h1>Customer Details</h1>

<div class="customer-info">
    <div class="info-group">
        <div class="info-label">First Name</div>
        <div class="info-value">{{ $customer->first_name }}</div>
    </div>
    
    <div class="info-group">
        <div class="info-label">Last Name</div>
        <div class="info-value">{{ $customer->last_name }}</div>
    </div>
    
    <div class="info-group">
        <div class="info-label">Email</div>
        <div class="info-value">{{ $customer->email }}</div>
    </div>
    
    <div class="info-group">
        <div class="info-label">Phone Number</div>
        <div class="info-value">{{ $customer->phonenumber }}</div>
    </div>
    
    <div class="info-group">
        <div class="info-label">Address</div>
        <div class="info-value">{{ $customer->address ?? 'Not provided' }}</div>
    </div>
</div>

<div class="actions">
    <a href="{{ route('customer.edit', $customer->id) }}" class="btn">Edit</a>
    <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this customer?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('customer.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection