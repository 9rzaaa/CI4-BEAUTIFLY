<script>
.bg-accent { background-color: #73AF6F; }
.text-accent { color: #73AF6F; }
.bg-primary-dark { background-color: #2F5233; }
.bg-secondary-light { background-color: #F8F4E3; }

/* Square logo containers */
.payment-logo-option {
    width: 100%;
    height: 100px;
    padding: 10px;
    border: 2px solid #E0DBCF;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    justify-content: center;
    align-items: center;
    background: white;
    flex-direction: column;
    text-align: center;
}

.payment-logo-option:hover { border-color: #73AF6F; }
.payment-logo-option.selected {
    border-color: #2F5233;
    box-shadow: 0 0 0 3px rgba(47, 82, 51, 0.4);
}
.payment-logo-option img { width: 80%; max-height: 40px; object-fit: contain; margin-bottom: 4px; }
.payment-logo-option input[type="radio"] { display: none; }

.btn-pulse:hover { animation: pulse-shadow 1.5s infinite; }
@keyframes pulse-shadow {
    0%,100% { box-shadow: 0 0 0 0 rgba(115,175,111,0.7); }
    50% { box-shadow: 0 0 0 15px rgba(115,175,111,0); }
}
</script>
