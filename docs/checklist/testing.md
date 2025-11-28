# Testing Guide - Beautifly Airbnb Platform

## Table of Contents
1. [Testing Overview](#testing-overview)
2. [User Authentication Testing](#user-authentication-testing)
3. [Property Management Testing](#property-management-testing)
4. [Booking System Testing](#booking-system-testing)
5. [CRUD Operations Testing](#crud-operations-testing)
6. [Security Testing](#security-testing)

---

## Testing Overview

**Purpose:** Ensure all functionalities work as expected and provide a seamless user experience.

**Test Environment:**
- Local Development: `http://localhost:8090`
- Docker Container: Running
- Database: MySQL

**Test User Accounts:**
- Admin: `admin@easyco.com` / EasyCo2025!
- Guest: `billieeilish@gmail.com` / Billie08

---

## User Authentication Testing

### Registration

#### Test Case 1: Valid Registration
- [ ] Navigate to registration page
- [ ] Fill in all required fields with valid data
- [ ] Submit form
- [ ] **Expected:** User created successfully, redirected to login/dashboard
- [ ] **Verify:** Check database for new user entry

#### Test Case 2: Registration Validation
- [ ] Try registering with empty fields
- [ ] **Expected:** Validation errors displayed
- [ ] Try registering with invalid email format
- [ ] **Expected:** Email validation error shown
- [ ] Try registering with mismatched passwords
- [ ] **Expected:** Password confirmation error shown
- [ ] Try registering with existing email
- [ ] **Expected:** "Email already exists" error shown

#### Test Case 3: Password Requirements
- [ ] Try password with less than 8 characters
- [ ] **Expected:** "Password too short" error
- [ ] Try password without special characters (if required)
- [ ] **Expected:** Validation error shown

---

### Login

#### Test Case 4: Valid Login
- [ ] Navigate to login page
- [ ] Enter valid credentials
- [ ] Submit form
- [ ] **Expected:** Redirected to dashboard/home
- [ ] **Verify:** Session created, user logged in

#### Test Case 5: Invalid Login
- [ ] Try login with incorrect email
- [ ] **Expected:** "Invalid credentials" error
- [ ] Try login with incorrect password
- [ ] **Expected:** "Invalid credentials" error
- [ ] Try login with empty fields
- [ ] **Expected:** Validation errors displayed

#### Test Case 6: Session Management
- [ ] Login successfully
- [ ] Close browser
- [ ] Reopen and navigate to site
- [ ] **Expected:** Still logged in (if "Remember Me" checked) OR logged out

---

### Logout

#### Test Case 7: Logout Functionality
- [ ] Click logout button
- [ ] **Expected:** Redirected to login/home page
- [ ] Try accessing protected pages
- [ ] **Expected:** Redirected to login page

---

## Property Management Testing

### View Properties

#### Test Case 8: Property List Display
- [ ] Navigate to properties page
- [ ] **Expected:** All active properties displayed
- [ ] **Verify:** Property details shown (title, price, image, etc.)
- [ ] Check if pagination works (if implemented)

#### Test Case 9: Property Details
- [ ] Click on a property
- [ ] **Expected:** Full property details page loads
- [ ] **Verify:** All information displayed correctly
  - [ ] Title
  - [ ] Description
  - [ ] Price per night
  - [ ] Cleaning fee
  - [ ] Max guests
  - [ ] Amenities
  - [ ] Images

---


## Booking System Testing

### Create Booking

#### Test Case 11: Valid Booking Creation
- [ ] Login as guest user
- [ ] Select a property
- [ ] Choose check-in and check-out dates
- [ ] Enter number of adults and kids
- [ ] Submit booking
- [ ] **Expected:** Booking created, confirmation shown
- [ ] **Verify:** Database entry created
- [ ] **Verify:** Booking appears in user's booking list

#### Test Case 12: Booking Validation
- [ ] Try booking with past check-in date
- [ ] **Expected:** "Invalid date" error
- [ ] Try booking with check-out before check-in
- [ ] **Expected:** "Check-out must be after check-in" error
- [ ] Try booking with guests exceeding max_guests
- [ ] **Expected:** "Too many guests" error
- [ ] Try booking overlapping dates (if validation exists)
- [ ] **Expected:** "Property unavailable" error

#### Test Case 13: Booking Calculation
- [ ] Create a booking for 3 nights
- [ ] **Verify:** Total price = (nights × price_per_night) calculated correctly
- [ ] Check if cleaning fee applied correctly
- [ ] Check if all fees displayed in breakdown

---

### View Bookings

#### Test Case 14: Booking List
- [ ] Navigate to "My Bookings" page
- [ ] **Expected:** All user's bookings displayed
- [ ] **Verify:** Booking details shown correctly
  - [ ] Property name
  - [ ] Check-in/Check-out dates
  - [ ] Status
  - [ ] Total price

#### Test Case 15: Booking Status
- [ ] Check bookings with different statuses
- [ ] **Verify:** Status indicators work
  - [ ] Pending (yellow/orange)
  - [ ] Confirmed (green)
  - [ ] Cancelled (red)
  - [ ] Completed (blue/gray)
  - [ ] Rejected (red)

---

### Cancel Booking

#### Test Case 16: Cancel Booking
- [ ] Navigate to active booking
- [ ] Click cancel button
- [ ] Confirm cancellation
- [ ] **Expected:** Booking status changed to "cancelled"
- [ ] **Verify:** Database updated
- [ ] **Verify:** Cancellation email sent (if implemented)

---

## CRUD Operations Testing

### Users CRUD

#### Test Case 17: Create User (Admin)
- [ ] Login as admin
- [ ] Navigate to user management
- [ ] Click "Create User"
- [ ] Fill in form with valid data
- [ ] Submit
- [ ] **Expected:** User created successfully
- [ ] **Verify:** User appears in list
- [ ] **Verify:** Database entry exists

#### Test Case 18: Read/View Users
- [ ] Navigate to user list page (`/test/user`)
- [ ] **Expected:** All users displayed in table
- [ ] **Verify:** User data accurate

#### Test Case 19: Update User
- [ ] Click "Edit" on a user
- [ ] **Expected:** Modal/form opens with current data
- [ ] Modify fields (first name, last name, email)
- [ ] Submit
- [ ] **Expected:** Success message shown
- [ ] **Verify:** Changes reflected in list
- [ ] **Verify:** Database updated

#### Test Case 20: Update Validation
- [ ] Try updating with invalid email
- [ ] **Expected:** Validation error shown
- [ ] Try updating with empty required fields
- [ ] **Expected:** Required field errors shown

#### Test Case 21: Delete User (Soft Delete)
- [ ] Click "Delete" on a user
- [ ] **Expected:** Confirmation modal appears
- [ ] Confirm deletion
- [ ] **Expected:** User removed from list
- [ ] **Verify:** `account_status` = 0 in database
- [ ] **Verify:** `deleted_at` timestamp set
- [ ] **Verify:** User NOT actually deleted from database

#### Test Case 22: Deleted User Not Visible
- [ ] Refresh user list page
- [ ] **Expected:** Deleted users NOT shown
- [ ] Check database directly
- [ ] **Verify:** Deleted users still exist with `account_status = 0`

---

## Security Testing

### Authentication Security

#### Test Case 23: Protected Routes
- [ ] Logout
- [ ] Try accessing admin pages directly via URL
- [ ] **Expected:** Redirected to login
- [ ] Try accessing user dashboard without login
- [ ] **Expected:** Redirected to login

---

### Password Security

#### Test Case 24: Password Hashing
- [ ] Register new user
- [ ] Check database
- [ ] **Verify:** Password stored as hash (not plain text)
- [ ] **Verify:** Hash uses proper algorithm (bcrypt/argon2)

---

## Overall Website Checklist

### Phase 1: Foundation ✅
- [x] Database setup and configuration
- [x] User authentication system
- [x] Database migrations created
- [x] Seeder files created
- [x] Basic CRUD operations

### Phase 2: Core Features 🚧
- [ ] User registration with validation
- [ ] User login/logout
- [ ] User profile management
- [ ] Property listing page
- [ ] Property detail page
- [ ] Booking creation system
- [ ] Booking management (view, cancel)
- [ ] Admin dashboard
- [ ] User dashboard

### Phase 3: Advanced Features 📋
- [ ] Search and filter properties
- [ ] Date availability calendar
- [ ] Payment integration
- [ ] Email notifications
- [ ] Booking confirmation emails
- [ ] Review and rating system
- [ ] Host property management
- [ ] Analytics dashboard

### Phase 4: UI/UX Polish 🎨
- [ ] Responsive design (mobile, tablet, desktop)
- [ ] Consistent styling across all pages
- [ ] Loading states and animations
- [ ] Error handling and user feedback
- [ ] Accessibility improvements
- [ ] Image optimization
- [ ] SEO optimization

### Phase 5: Security & Testing 🔒
- [ ] Input validation on all forms
- [ ] CSRF protection
- [ ] XSS prevention
- [ ] SQL injection prevention
- [ ] Password security (hashing)
- [ ] Role-based access control
- [ ] Session security
- [ ] Rate limiting (prevent abuse)

### Phase 6: Documentation 📚
- [ ] README.md with setup instructions
- [ ] API documentation (if applicable)
- [ ] User manual
- [ ] Admin guide
- [ ] Code comments and documentation
- [ ] Testing documentation (this file)

### Phase 7: Deployment Preparation 🚀
- [ ] Environment configuration
- [ ] Database backup strategy
- [ ] Error logging setup
- [ ] Performance monitoring
- [ ] Security audit
- [ ] Browser compatibility testing
- [ ] Production deployment checklist

---

## Bug Tracking Template

When you find a bug during testing, document it like this:

```markdown
### Bug #[NUMBER]: [Short Description]

**Severity:** Critical / High / Medium / Low
**Priority:** High / Medium / Low
**Status:** Open / In Progress / Resolved / Closed

**Steps to Reproduce:**
1. Navigate to [page]
2. Click on [element]
3. Enter [data]
4. Observe [issue]

**Expected Behavior:**
[What should happen]

**Actual Behavior:**
[What actually happens]

**Screenshots/Videos:**
[Attach if applicable]

**Environment:**
- Browser: [Chrome 120 / Firefox 121 / etc.]
- OS: [Windows 11 / Mac OS / etc.]
- Screen Size: [1920x1080 / etc.]

**Additional Notes:**
[Any other relevant information]
```

---

## Test Result Template

Document your test results:

```markdown
## Test Session: [Date]

**Tester:** [Your Name]
**Duration:** [Start Time - End Time]
**Test Environment:** [Local/Staging/Production]

### Tests Executed:
- Total Test Cases: [Number]
- Passed: [Number]
- Failed: [Number]
- Blocked: [Number]
- Skipped: [Number]

### Critical Issues Found:
1. [Issue description and reference]
2. [Issue description and reference]

### Summary:
[Brief overview of testing session]

### Recommendations:
1. [Recommendation 1]
2. [Recommendation 2]
```

---

## Notes

- Always test in **multiple browsers** (Chrome, Firefox, Safari, Edge)
- Test with **different user roles** (admin, host, guest, unauthenticated)
- Document **all bugs** found with clear reproduction steps
- Retest after bug fixes to ensure they work
- Perform **regression testing** after major changes
- Keep this document updated as features are added/modified

---

## Version History

| Version | Date | Changes | Author |
|---------|------|---------|--------|
| 1.0 | 2025-11-25 | Initial testing guide created | Team |
| | | | |

---

**Happy Testing! 🎉**