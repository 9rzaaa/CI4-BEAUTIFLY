<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ---------- Public Pages ----------
$routes->get('/', 'Users::index');          // Home page
$routes->get('/login', 'Users::login');     // Login page
$routes->get('/signup', 'Users::signup');   // Signup/registration page
$routes->get('/mb', 'Users::moodboard');    // Moodboard page
$routes->get('/rm', 'Users::roadmap');      // Roadmap page
$routes->get('/about', 'Users::about');     // About page

// ---------- Authentication ----------
$routes->post('auth/login', 'Auth::login');     // Handle login form submission
$routes->get('auth/logout', 'Auth::logout');    // Logout the current user
$routes->post('auth/signup', 'Auth::signup');   // Handle signup form submission

// ---------- Admin Pages ----------
$routes->get('admin/dashboard', function () {
    return view('admin/dashboard');            // Admin dashboard view
});

// ---------- Admin Booking Management ----------
$routes->get('admin/bookings', 'AdminBookingController::index');                    // Display bookings management page
$routes->get('admin/bookings/list', 'AdminBookingController::list');                // Get bookings list 
$routes->get('admin/bookings/view/(:num)', 'AdminBookingController::view/$1');      // View single booking 
$routes->post('admin/bookings/update', 'AdminBookingController::update');           // Update booking 
$routes->delete('admin/bookings/delete/(:num)', 'AdminBookingController::delete/$1'); // Delete booking 
$routes->get('admin/bookings/statistics', 'AdminBookingController::statistics');    // Get statistics 

// ---------- Test / CRUD Pages ----------
$routes->get('/test/user', 'CRUDTesting::showUsersPage');
$routes->get('test/user_create', 'CRUDTesting::index');
$routes->post('crud-testing/create', 'CRUDTesting::create');
$routes->get('/test/update/(:num)', 'CRUDTesting::showUpdateForm/$1');
$routes->post('/crud-testing/update/(:num)', 'CRUDTesting::processUpdate/$1');
$routes->post('/crud-testing/delete/(:num)', 'CRUDTesting::deleteUserData/$1');

// ========================================
// BOOKING ROUTES - USER FACING
// ========================================

// Main booking page (date selection)
$routes->get('booking', 'BookingController::index');

// Booking review page (requires login)
$routes->get('booking/review', 'BookingController::review', ['filter' => 'auth']);

// Booking success page
$routes->get('booking/success', 'BookingController::success', ['filter' => 'auth']);

// My Bookings (booking history)
$routes->get('bookings', 'BookingController::myBookings', ['filter' => 'auth']);

// View single booking details
$routes->get('bookings/view/(:num)', 'BookingController::viewBooking/$1', ['filter' => 'auth']);

// ========================================
// BOOKING API ROUTES
// ========================================

// Create new booking
$routes->post('booking/create', 'BookingController::create', ['filter' => 'auth']);

// Cancel booking - FIXED ROUTE
$routes->post('bookings/cancel/(:num)', 'BookingController::cancel/$1', ['filter' => 'auth']);

// Get booked dates for calendar
$routes->get('booking/get-booked-dates', 'BookingController::getBookedDates');

// Calculate price (AJAX)
$routes->get('booking/calculate-price', 'BookingController::calculatePrice');

// Check login status
$routes->get('booking/check-login', 'BookingController::checkLogin');

// ========================================
// PAYMENT ROUTES
// ========================================

// Process payment
$routes->post('payment/process', 'PaymentController::processPayment', ['filter' => 'auth']);

// Get payment details
$routes->get('payment/details/(:num)', 'PaymentController::getPaymentDetails/$1', ['filter' => 'auth']);

// Refund payment
$routes->post('payment/refund/(:num)', 'PaymentController::refundPayment/$1', ['filter' => 'auth']);

// ========================================
// LEGACY/COMPATIBILITY ROUTES
// ========================================

// Old route redirects (for backward compatibility)
$routes->get('user/booking_review', function () {
    return redirect()->to('/booking/review');
});

$routes->get('user/booking-form', function () {
    return redirect()->to('/booking');
});

$routes->get('booking_success', function () {
    return redirect()->to('/booking/success');
});

$routes->get('booking/history', function () {
    return redirect()->to('/bookings');
});