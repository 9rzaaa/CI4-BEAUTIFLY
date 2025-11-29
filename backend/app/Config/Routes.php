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
// Main booking page
$routes->get('booking', 'BookingController::index');

// Booking review page (requires login)
$routes->get('user/booking_review', 'BookingController::review');

// Check login status API
$routes->get('api/bookings/check-login', 'BookingController::checkLogin');

// Get booked dates API
$routes->get('api/bookings/booked-dates', 'BookingController::getBookedDates');

// Booking history
$routes->get('booking/history', 'BookingController::history');

// API endpoints
$routes->get('api/bookings/property/(:num)', 'BookingController::getProperty/$1');
$routes->post('api/bookings/create', 'BookingController::create');
$routes->get('api/bookings', 'BookingController::list');
$routes->get('api/bookings/(:num)', 'BookingController::show/$1');
$routes->put('api/bookings/(:num)', 'BookingController::update/$1');
$routes->delete('api/bookings/(:num)', 'BookingController::delete/$1');

$routes->post('/booking/create', 'BookingController::create');
$routes->get('/booking/success', 'BookingController::success');

// My Bookings Routes
$routes->get('bookings', 'BookingController::myBookings', ['filter' => 'auth']); // View page
$routes->get('api/bookings/user', 'BookingController::getUserBookings', ['filter' => 'auth']); // Get user bookings
$routes->get('api/bookings/(:num)', 'BookingController::getBookingDetails/$1', ['filter' => 'auth']); // Get single booking
$routes->post('api/bookings/(:num)/cancel', 'BookingController::cancelBooking/$1', ['filter' => 'auth']); // Cancel booking

$routes->get('/user/booking-form', 'User::bookingForm');  // Booking form page
$routes->get('/user/booking-confirmation', 'User::bookingConfirmation'); // Booking confirmation page
$routes->get('/booking_success', 'User::bookingSuccess'); // Success page after payment


