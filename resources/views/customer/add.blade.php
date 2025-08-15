<form action="{{ route('customer.store') }}" method="POST" style="max-width:400px;margin:20px auto;padding:20px;border:1px solid #ccc;border-radius:8px;background:#f9f9f9;font-family:Arial,sans-serif;">
    @csrf

    <label for="first_name" style="display:block;margin-bottom:5px;font-weight:bold;">First Name</label>
    <input type="text" name="first_name" value="{{ old('first_name') }}" style="width:100%;padding:8px;margin-bottom:10px;border:1px solid #ccc;border-radius:4px;">
    @error('first_name')
        <div style="color:red;margin-bottom:10px;">{{ $message }}</div>
    @enderror

    <label for="last_name" style="display:block;margin-bottom:5px;font-weight:bold;">Last Name</label>
    <input type="text" name="last_name" value="{{ old('last_name') }}" style="width:100%;padding:8px;margin-bottom:10px;border:1px solid #ccc;border-radius:4px;">
    @error('last_name')
        <div style="color:red;margin-bottom:10px;">{{ $message }}</div>
    @enderror

    <label for="email" style="display:block;margin-bottom:5px;font-weight:bold;">Email</label>
    <input type="email" name="email" value="{{ old('email') }}" style="width:100%;padding:8px;margin-bottom:10px;border:1px solid #ccc;border-radius:4px;">
    @error('email')
        <div style="color:red;margin-bottom:10px;">{{ $message }}</div>
    @enderror

    <label for="phonenumber" style="display:block;margin-bottom:5px;font-weight:bold;">Phone Number</label>
    <input type="number" name="phonenumber" value="{{ old('phonenumber') }}" style="width:100%;padding:8px;margin-bottom:10px;border:1px solid #ccc;border-radius:4px;">
    @error('phonenumber')
        <div style="color:red;margin-bottom:10px;">{{ $message }}</div>
    @enderror

    <button type="submit" style="background:#007BFF;color:#fff;padding:10px 15px;border:none;border-radius:4px;cursor:pointer;">Submit</button>
</form>
