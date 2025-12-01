<style>
    /* FILTER TABS */
    .filter-tab {
        background-color: white;
        color: #4F5D44; /* earthy gray-green */
        border: 2px solid #DCEED1; /* light leaf */
        padding: 0.625rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.2s;
        cursor: pointer;
    }

    .filter-tab:hover {
        border-color: #6DA34D; /* primary green */
        color: #2E5A32; /* darker garden green */
    }

    .filter-tab.active {
        background-color: #6DA34D; /* garden green */
        color: white;
        border-color: #6DA34D;
    }

    /* STATUS BADGES */
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

    /* Upcoming – soft leaf green */
    .status-upcoming {
        background-color: #DCEED1;
        color: #2E5A32;
    }

    /* Completed – darker healthy green */
    .status-completed {
        background-color: #A3B18A;
        color: #1F3F1C;
    }

    /* Cancelled – soft garden rose */
    .status-cancelled {
        background-color: #F3D8D0;
        color: #8C3B2E;
    }

    /* Pending – natural wheat yellow */
    .status-pending {
        background-color: #FFF4CC;
        color: #8C6239;
    }

    /* Confirmed – soft mint */
    .status-confirmed {
        background-color: #DCEED1;
        color: #2E5A32;
    }

    /* BOOKING CARDS */
    .booking-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 1px 3px 0 rgba(46, 90, 50, 0.15); /* natural green shadow */
        transition: all 0.3s ease;
        overflow: hidden;
        border: 1px solid #DCEED1; /* soft garden border */
    }

    .booking-card:hover {
        box-shadow: 0 10px 25px -5px rgba(46, 90, 50, 0.2);
        transform: translateY(-2px);
    }

    /* BOOKING IMAGE */
    .booking-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .booking-image-container {
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: linear-gradient(to bottom right, #DCEED1, #A3B18A); /* garden gradient */
    }
</style>