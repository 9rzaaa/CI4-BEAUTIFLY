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
$routes->get('/about', 'Users::about');     // About page (moved from inline function)

// ---------- Authentication ----------
$routes->post('auth/login', 'Auth::login');     // Handle login form submission
$routes->get('auth/logout', 'Auth::logout');    // Logout the current user
$routes->post('auth/signup', 'Auth::signup');   // Handle signup form submission

// ---------- Admin Pages ----------
$routes->get('admin/dashboard', function () {
    return view('admin/dashboard');            // Admin dashboard view
});

// ---------- Test / CRUD Pages ----------
$routes->get('/test/user', 'CRUDTesting::showUsersPage');
// Displays user list page (CRUD testing page)

// open create form
$routes->get('test/user_create', 'CRUDTesting::index');

// process create (form submit)
$routes->post('crud-testing/create', 'CRUDTesting::create');

// View update page (GET)
$routes->get('/test/update/(:num)', 'CRUDTesting::showUpdateForm/$1');

// Process update (POST)
$routes->post('/crud-testing/update/(:num)', 'CRUDTesting::processUpdate/$1');

// Process delete (POST)
$routes->post('/crud-testing/delete/(:num)', 'CRUDTesting::deleteUserData/$1');

// ---------- BOOKING ROUTES ----------

// Main booking page (date selection)
$routes->get('booking', 'BookingController::index');

// ✅ Booking review page (requires login) - STANDARDIZED PATH
$routes->get('booking/review', 'BookingController::review');

// Booking success page
$routes->get('booking/success', 'BookingController::success');

// Booking history page
$routes->get('booking/history', 'BookingController::history');

// My Bookings page
$routes->get('bookings', 'BookingController::myBookings', ['filter' => 'auth']);

// ---------- BOOKING API ROUTES ----------

// Create booking
$routes->post('booking/create', 'BookingController::create');

// Get booking details
$routes->get('booking/(:num)', 'BookingController::getBooking/$1', ['filter' => 'auth']);

// Update booking
$routes->put('booking/(:num)', 'BookingController::update/$1', ['filter' => 'auth']);

// Cancel booking
$routes->post('booking/(:num)/cancel', 'BookingController::cancel/$1', ['filter' => 'auth']);

// Get property details
$routes->get('booking/property/(:num)', 'BookingController::getProperty/$1');

// Calculate price (AJAX)
$routes->get('booking/calculate-price', 'BookingController::calculatePrice');

// Check login status
$routes->get('booking/check-login', 'BookingController::checkLogin');

// Get booked dates
$routes->get('booking/booked-dates', 'BookingController::getBookedDates');

// Get user's bookings list
$routes->get('booking/user/list', 'BookingController::getUserBookings', ['filter' => 'auth']);

// ---------- PAYMENT ROUTES ----------

// Process payment
$routes->post('payment/process', 'PaymentController::processPayment');

// Get payment details
$routes->get('payment/details/(:num)', 'PaymentController::getPaymentDetails/$1');

// Refund payment
$routes->post('payment/refund/(:num)', 'PaymentController::refundPayment/$1');

// ---------- LEGACY/COMPATIBILITY ROUTES (if needed) ----------

// Old route redirects (optional - for backward compatibility)
$routes->get('user/booking_review', function () {
    return redirect()->to('/booking/review');
});

$routes->get('user/booking-form', function () {
    return redirect()->to('/booking');
});

$routes->get('booking_success', function () {
    return redirect()->to('/booking/success');
});
