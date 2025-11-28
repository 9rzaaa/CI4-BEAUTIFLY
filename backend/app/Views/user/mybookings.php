<?php
$active = 'My Bookings';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - EASY&CO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#73AF6F',
                        accent: '#4A5F8F',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <?php echo view('components/header'); ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">My Bookings</h1>
            <p class="text-gray-600">View and manage your resort reservations</p>
        </div>

        <!-- Filter Tabs -->
        <div class="mb-6">
            <div class="flex flex-wrap gap-3">
                <button class="filter-tab active px-6 py-2.5 rounded-lg font-medium transition-all duration-200" data-filter="all">
                    All Bookings
                </button>
                <button class="filter-tab px-6 py-2.5 rounded-lg font-medium transition-all duration-200" data-filter="upcoming">
                    Upcoming
                </button>
                <button class="filter-tab px-6 py-2.5 rounded-lg font-medium transition-all duration-200" data-filter="completed">
                    Completed
                </button>
                <button class="filter-tab px-6 py-2.5 rounded-lg font-medium transition-all duration-200" data-filter="cancelled">
                    Cancelled
                </button>
            </div>
        </div>

        <!-- Bookings Container -->
        <div id="bookingsContainer">
            <!-- Loading State -->
            <div id="loadingState" class="text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div>
                <p class="mt-4 text-gray-600">Loading your bookings...</p>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden text-center py-16">
                <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-semibold text-gray-700">No bookings found</h3>
                <p class="mt-2 text-gray-500">You haven't made any bookings yet.</p>
                <a href="/booking" class="inline-block mt-6 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Book Now
                </a>
            </div>

            <!-- Bookings Grid -->
            <div id="bookingsGrid" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Booking cards will be dynamically inserted here -->
            </div>
        </div>
    </main>

    <!-- Booking Details Modal -->
    <div id="detailsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div id="modalContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    <style>
        .filter-tab {
            background-color: white;
            color: #4B5563;
            border: 2px solid #E5E7EB;
        }
        
        .filter-tab:hover {
            border-color: #73AF6F;
            color: #73AF6F;
        }
        
        .filter-tab.active {
            background-color: #73AF6F;
            color: white;
            border-color: #73AF6F;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .status-upcoming {
            background-color: #DBEAFE;
            color: #1E40AF;
        }

        .status-completed {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .status-cancelled {
            background-color: #FEE2E2;
            color: #991B1B;
        }

        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .booking-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .booking-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .booking-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</body>
</html>


