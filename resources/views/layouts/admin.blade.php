<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Customer CRM</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background: #f8f9fa;
            color: #333;
        }
        .nav {
            background-color: #2c3e50;
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 25px;
        }
        .nav-logo {
            font-size: 24px;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }
        .nav-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .nav-menu li {
            margin-left: 20px;
        }
        .nav-menu a {
            color: #ecf0f1;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            padding: 10px 0;
        }
        .nav-menu a:hover {
            color: #3498db;
        }
        .nav-menu a.active {
            color: #3498db;
            border-bottom: 2px solid #3498db;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 25px;
            font-weight: 600;
            text-align: center;
        }
        .btn {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: 500;
            transition: background 0.3s;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background: #2980b9;
        }
        .btn-danger {
            background: #e74c3c;
        }
        .btn-danger:hover {
            background: #c0392b;
        }
        .alert {
            padding: 15px;
            background: #d4edda;
            color: #155724;
            border-radius: 6px;
            margin-bottom: 25px;
            font-size: 16px;
            border-left: 4px solid #28a745;
        }
        
        /* Pagination Styles */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            justify-content: center;
            margin-top: 30px;
        }
        .pagination li {
            margin: 0 5px;
        }
        .pagination li a, .pagination li span {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            border: 1px solid #dee2e6;
            color: #3498db;
            border-radius: 4px;
            transition: all 0.3s;
            font-size: 14px;
        }
        .pagination li a:hover {
            background: #e9ecef;
        }
        .pagination li.active span {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }
        .pagination li.disabled span {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff;
            border-color: #dee2e6;
        }
        /* Fix for large pagination arrows */
        .pagination svg {
            width: 12px;
            height: 12px;
            vertical-align: middle;
        }
    </style>
    @yield('additional_styles')
</head>
<body>
    <nav class="nav">
        <div class="nav-container">
            <a href="{{ route('customer.index') }}" class="nav-logo">Customer CRM</a>
            <ul class="nav-menu">
                <li><a href="{{ route('customer.index') }}" class="{{ request()->routeIs('customer.index') ? 'active' : '' }}">Customers</a></li>
                <li><a href="{{ route('customer.create') }}" class="{{ request()->routeIs('customer.create') ? 'active' : '' }}">Add Customer</a></li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
        @yield('content')
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            let loading = false;
            let skip = 10; // Start after the initial 10 records
            let hasMore = true;
            let scrollTimeout = null;
            
            function loadMoreCustomers() {
                if (loading || !hasMore) return;
                
                loading = true;
                $('#customer-loader').show();
                
                $.ajax({
                    url: '{{ route("customer.loadMore") }}',
                    type: 'GET',
                    data: { skip: skip },
                    success: function(response) {
                        if (response.customers.length > 0) {
                            let tableBody = $('table tbody');
                            let newRows = '';
                            
                            response.customers.forEach(function(customer) {
                                newRows += `
                                    <tr>
                                        <td>${customer.id}</td>
                                        <td>${customer.first_name}</td>
                                        <td>${customer.last_name}</td>
                                        <td>${customer.email}</td>
                                        <td>${customer.phonenumber}</td>
                                        <td class="action-buttons">
                                            <a href="/customer/${customer.id}" class="btn">View</a>
                                            <a href="/customer/${customer.id}/edit" class="btn">Edit</a>
                                            <form action="/customer/${customer.id}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                `;
                            });
                            
                            // Append all rows at once to reduce DOM manipulations
                            tableBody.append(newRows);
                            skip += response.customers.length;
                        }
                        
                        hasMore = response.hasMore;
                        
                        if (!hasMore) {
                            $('#end-of-customers').show();
                        }
                    },
                    error: function() {
                        console.error('Error loading more customers');
                    },
                    complete: function() {
                        loading = false;
                        $('#customer-loader').hide();
                        // Add a small delay before allowing new loads
                        setTimeout(function() {
                            loading = false;
                        }, 300);
                    }
                });
            }
            
            // Check if we're on the customer index page
            if ($('table tbody').length > 0) {
                // Debounced scroll event handler to prevent multiple firings
                $(window).scroll(function() {
                    if (scrollTimeout) {
                        clearTimeout(scrollTimeout);
                    }
                    
                    scrollTimeout = setTimeout(function() {
                        // More conservative threshold to prevent premature loading
                        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
                            loadMoreCustomers();
                        }
                    }, 100); // 100ms debounce
                });
                
                // Initial load if page is not scrollable
                if ($(document).height() <= $(window).height()) {
                    loadMoreCustomers();
                }
            }
        });
    </script>
    @yield('scripts')
</body>
</html>