@extends('layouts.admin')

@section('title', 'Customer Management')

@section('additional_styles')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 25px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border-radius: 6px;
        overflow: hidden;
    }
    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e9ecef;
    }
    th {
        background-color: #f1f3f5;
        color: #2c3e50;
        font-weight: 600;
    }
    tr:hover {
        background-color: #f8f9fa;
    }
    tr:last-child td {
        border-bottom: none;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    .empty-message {
        text-align: center;
        padding: 30px;
        color: #6c757d;
        font-size: 18px;
    }
    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
</style>
@endsection

@section('content')
<h1>Customer Management</h1>

@if(session('success'))
    <div class="alert">
        {{ session('success') }}
    </div>
@endif

<div class="header-actions">
    <a href="{{ route('customer.create') }}" class="btn">Add New Customer</a>
</div>

@if($customers->count() > 0)
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->first_name }}</td>
                    <td>{{ $customer->last_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phonenumber }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('customer.show', $customer->id) }}" class="btn">View</a>
                        <a href="{{ route('customer.edit', $customer->id) }}" class="btn">Edit</a>
                        <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div id="customer-loader" class="text-center py-4 mt-3" style="display: none; height: 60px;">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div id="end-of-customers" class="text-center py-4 mt-3" style="display: none; height: 60px;">
        <p class="fw-bold">No more customers to load</p>
    </div>
@else
    <div class="empty-message">
        <p>No customers found. Click the "Add New Customer" button to create one.</p>
    </div>
@endif
@endsection