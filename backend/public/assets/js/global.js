// ==================== global.js ====================
// Add this file to your assets/js/ folder and include it in your head.php

(function() {
    'use strict';

    // ==================== PAGE LOADING ANIMATION ====================
    
    // Create loading overlay
    function createLoadingOverlay() {
        const overlay = document.createElement('div');
        overlay.id = 'pageLoader';
        overlay.innerHTML = `
            <div class="loader-content">
                <div class="spinner"></div>
                <p class="loader-text">Loading...</p>
            </div>
        `;
        document.body.appendChild(overlay);
        
        // Add styles
        const style = document.createElement('style');
        style.textContent = `
            #pageLoader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(18, 18, 18, 0.95);
                backdrop-filter: blur(10px);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                opacity: 1;
                transition: opacity 0.3s ease;
            }
            
            #pageLoader.fade-out {
                opacity: 0;
                pointer-events: none;
            }
            
            .loader-content {
                text-align: center;
            }
            
            .spinner {
                width: 50px;
                height: 50px;
                border: 4px solid rgba(255, 255, 255, 0.1);
                border-top-color: #C8A998;
                border-radius: 50%;
                animation: spin 0.8s linear infinite;
                margin: 0 auto 20px;
            }
            
            .loader-text {
                color: white;
                font-size: 16px;
                font-weight: 500;
                letter-spacing: 1px;
            }
            
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
            
            /* Image lazy loading skeleton */
            img[data-src] {
                background: linear-gradient(135deg, var(--sky-blue), var(--ocean-blue));
                background-size: 200% 100%;
                animation: loading 1.5s infinite;
            }
            
            @keyframes loading {
                0% { background-position: 200% 0; }
                100% { background-position: -200% 0; }
            }
            
            /* Scroll to top button */
            #scrollToTop {
                position: fixed;
                bottom: 30px;
                right: 30px;
                width: 50px;
                height: 50px;
                background: linear-gradient(135deg, #91ADC8 0%, #5C7996 100%);
                color: white;
                border: none;
                border-radius: 50%;
                cursor: pointer;
                display: flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0 4px 15px rgba(145, 173, 200, 0.4);
                opacity: 0;
                visibility: hidden;
                transform: scale(0.8);
                transition: all 0.3s ease;
                z-index: 1000;
            }
            
            #scrollToTop.show {
                opacity: 1;
                visibility: visible;
                transform: scale(1);
            }
            
            #scrollToTop:hover {
                transform: scale(1.1);
                box-shadow: 0 6px 20px rgba(100, 130, 160, 0.6);
            }
            
            #scrollToTop:active {
                transform: scale(0.95);
            }
            
            #scrollToTop svg {
                width: 24px;
                height: 24px;
            }
            
            @media (max-width: 768px) {
                #scrollToTop {
                    bottom: 20px;
                    right: 20px;
                    width: 45px;
                    height: 45px;
                }
                
                #scrollToTop svg {
                    width: 20px;
                    height: 20px;
                }
            }
        `;
        document.head.appendChild(style);
    }
    
    // Show loader on page load
    window.addEventListener('load', function() {
        const loader = document.getElementById('pageLoader');
        if (loader) {
            setTimeout(() => {
                loader.classList.add('fade-out');
                setTimeout(() => loader.remove(), 300);
            }, 500);
        }
    });
    
    // Show loader on link clicks (for internal navigation)
    document.addEventListener('DOMContentLoaded', function() {
        createLoadingOverlay();
        
        // Hide loader after page loads
        window.addEventListener('load', function() {
            const loader = document.getElementById('pageLoader');
            if (loader) {
                setTimeout(() => {
                    loader.classList.add('fade-out');
                    setTimeout(() => loader.remove(), 300);
                }, 300);
            }
        });
        
        // Add loading to internal links
        const internalLinks = document.querySelectorAll('a[href^="/"], a[href^="' + window.location.origin + '"]');
        internalLinks.forEach(link => {
            // Skip anchor links and logout links
            if (link.getAttribute('href').startsWith('#') || 
                link.getAttribute('href').includes('logout') ||
                link.getAttribute('target') === '_blank') {
                return;
            }
            
            link.addEventListener('click', function(e) {
                const loader = document.getElementById('pageLoader');
                if (!loader) {
                    createLoadingOverlay();
                }
                document.getElementById('pageLoader').classList.remove('fade-out');
            });
        });
        
        // ==================== LAZY LOADING IMAGES ====================
        
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                    
                    img.addEventListener('load', function() {
                        img.style.animation = 'none';
                        img.style.background = 'none';
                    });
                }
            });
        }, {
            rootMargin: '50px'
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
        
        // ==================== SCROLL TO TOP BUTTON ====================
        
        // Create scroll to top button
        const scrollBtn = document.createElement('button');
        scrollBtn.id = 'scrollToTop';
        scrollBtn.setAttribute('aria-label', 'Scroll to top');
        scrollBtn.innerHTML = `
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        `;
        document.body.appendChild(scrollBtn);
        
        // Show/hide button based on scroll position
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 300) {
                scrollBtn.classList.add('show');
            } else {
                scrollBtn.classList.remove('show');
            }
            
            lastScrollTop = scrollTop;
        }, { passive: true });
        
        // Smooth scroll to top
        scrollBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // ==================== SMOOTH SCROLL FOR ANCHOR LINKS ====================
        
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    });
    
    // ==================== FORM LOADING STATES ====================
    
    // Add loading state to forms
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.tagName === 'FORM') {
            const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                const originalText = submitBtn.textContent || submitBtn.value;
                submitBtn.dataset.originalText = originalText;
                
                if (submitBtn.tagName === 'BUTTON') {
                    submitBtn.innerHTML = `
                        <svg class="animate-spin inline-block w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing...
                    `;
                } else {
                    submitBtn.value = 'Processing...';
                }
            }
        }
    });
    
    // ==================== IMAGE PRELOADING ====================
    
    // Preload critical images
    function preloadImage(url) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.onload = () => resolve(img);
            img.onerror = reject;
            img.src = url;
        });
    }
    
    // Preload hero images
    const criticalImages = document.querySelectorAll('img[data-preload="true"]');
    criticalImages.forEach(img => {
        if (img.dataset.src) {
            preloadImage(img.dataset.src).then(() => {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            });
        }
    });
    
})();