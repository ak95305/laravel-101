@extends('layouts.admin')

@section('title', 'Create Customer')

@section('additional_styles')
<style>
    .form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #2c3e50;
    }
    input, textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
        transition: border-color 0.3s;
        box-sizing: border-box;
    }
    input:focus, textarea:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
    }
    .error {
        color: #e74c3c;
        margin-top: 5px;
        font-size: 14px;
    }
    .btn-secondary {
        background: #7f8c8d;
        margin-left: 10px;
    }
    .btn-secondary:hover {
        background: #6c7a7d;
    }
    .actions {
        margin-top: 25px;
        display: flex;
    }
</style>
@endsection

@section('content')
<h1>Create New Customer</h1>

<form action="{{ route('customer.store') }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
        @error('first_name')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
        @error('last_name')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="phonenumber">Phone Number</label>
        <input type="tel" name="phonenumber" id="phonenumber" value="{{ old('phonenumber') }}" required>
        @error('phonenumber')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="address">Address</label>
        <textarea id="address" name="address" rows="3">{{ old('address') }}</textarea>
        @error('address')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="actions">
        <button type="submit" class="btn">Create Customer</button>
        <a href="{{ route('customer.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
