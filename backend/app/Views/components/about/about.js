                const scroller = document.getElementById('galleryScroller');
                const leftBtn = document.getElementById('galleryLeft');
                const rightBtn = document.getElementById('galleryRight');

                // Duplicate the gallery items to allow infinite scroll effect
                const items = Array.from(scroller.children);
                items.forEach(item => scroller.appendChild(item.cloneNode(true)));

                const scrollAmount = scroller.clientWidth / 2; // scroll by half container = 2 items

                rightBtn.addEventListener('click', () => {
                    if (scroller.scrollLeft + scroller.clientWidth >= scroller.scrollWidth / 2) {
                        scroller.scrollLeft = 0;
                    } else {
                        scroller.scrollBy({
                            left: scrollAmount,
                            behavior: 'smooth'
                        });
                    }
                });

                leftBtn.addEventListener('click', () => {
                    if (scroller.scrollLeft <= 0) {
                        scroller.scrollLeft = scroller.scrollWidth / 2;
                    } else {
                        scroller.scrollBy({
                            left: -scrollAmount,
                            behavior: 'smooth'
                        });
                    }
                });