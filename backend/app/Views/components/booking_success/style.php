<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<style>
.bg-accent { background-color: #73AF6F; }
.text-accent { color: #73AF6F; }
.bg-primary-dark { background-color: #2F5233; }
.bg-secondary-light { background-color: #F8F4E3; }

/* Success checkmark */
.success-checkmark { width: 80px; height: 80px; margin: 0 auto; }
.checkmark-circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 2;
    stroke-miterlimit: 10;
    stroke: #73AF6F;
    fill: none;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}
.checkmark-check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    stroke: #73AF6F;
    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}
@keyframes stroke { 100% { stroke-dashoffset: 0; } }
@keyframes scale { 0%, 100% { transform: none; } 50% { transform: scale3d(1.1,1.1,1); } }
@keyframes fill { 100% { box-shadow: inset 0px 0px 0px 30px #73AF6F; } }
.fade-in { animation: fadeIn 0.6s ease-in; }
@keyframes fadeIn { from { opacity:0; transform:translateY(20px);} to{opacity:1; transform:translateY(0);} }
@media print { .no-print { display:none; } body { background:white !important; } }
</style>
