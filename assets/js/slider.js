import 'hammerjs';

const SLIDERCONTAINER = document.querySelector('.is-style-is-kompakt-slider');
if (SLIDERCONTAINER) {
    const SLIDER = SLIDERCONTAINER.querySelector('.wp-block-group__inner-container');
    const SLIDES = SLIDER?.querySelectorAll('figure');




    if (SLIDER) {
        const HAMMER = new Hammer(SLIDER);
        const SLIDERSIZE = 100;
        const SENSITIVITY = 2;

        // animation type: fade | slide
        const ANIMATION = 'slide';
        // Show Navigation: true | false
        const NAVI = true;
        // Automatic Slider after x ms: false | int milliseconds
        const AUTO = 8000;

        if (ANIMATION === 'slide') {
            SLIDER.style.width = `${SLIDES.length * 100}%`;
        } else if (ANIMATION === 'fade') {
            SLIDER.classList.add('fade')
        } else {

        }

        let timer;
        let sliderTimer;
        let panIsRunning = false;
        let activeIndex = 0;

        HAMMER.on('pan', ($event) => {
            panIsRunning = true;
            const panDistance = (SLIDERSIZE / SLIDES.length) * $event.deltaX / SLIDER.clientWidth;
            const panDistanceCalculated = panDistance - SLIDERSIZE / SLIDES.length * activeIndex;
            animateSlider(panDistanceCalculated);
            if ($event.isFinal) {
                if (panDistance <= -(SENSITIVITY / SLIDES.length)) {
                    goToSlide(activeIndex + 1);
                } else if (panDistance >= (SENSITIVITY / SLIDES.length)) {
                    goToSlide(activeIndex - 1);
                } else {
                    goToSlide(activeIndex);
                }
            }
        });

        const generateBullets = (elements, target) => {
            if (NAVI) {
                const newNavigation = document.createElement('div');
                newNavigation.classList.add('custom-slider-navigation');
                elements.forEach((bullet, index) => {
                    const newBullet = document.createElement('button');
                    newBullet.classList.add('bullet');
                    newBullet.dataset.active = index;
                    if (index === activeIndex) {
                        newBullet.classList.add('bullet-active');
                    }
                    newNavigation.appendChild(newBullet);
                });
                target.appendChild(newNavigation);
                document.querySelectorAll('.bullet').forEach(bullet => {
                    bullet.addEventListener('click', bulletClick, false);
                });
            }
        }

        const bulletClick = ($event) => {
            activeIndex = Number($event.target.dataset.active);
            goToSlide(activeIndex);
        }

        const setActiveBullet = () => {
            const activeBullet = document.querySelector('.bullet-active');
            if (activeBullet) {
                activeBullet.classList.remove('bullet-active');
            }
            document.querySelectorAll('.bullet').forEach(bullet => {
                if (bullet.dataset.active === activeIndex.toString()) {
                    bullet.classList.add('bullet-active');
                }
            });
        }

        const goToSlide = (index) => {
            if (index < 0) {
                activeIndex = 0;
            } else if (index > (SLIDES.length - 1)) {
                // activeIndex = (SLIDES.length - 1);
                activeIndex = 0;
            } else {
                activeIndex = index;
            }
            SLIDER.classList.add('is-animating');
            const percentage = -(SLIDERSIZE / SLIDES.length) * activeIndex;
            animateSlider(percentage);
            setActiveBullet();
            setActiveSlide(activeIndex);
            setTimeOut(activeIndex);
            addSmoothTransition();
        }

        const addSmoothTransition = () => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                SLIDER.classList.remove('is-animating');
                panIsRunning = false;
            }, 400);
        }

        const animateSlider = (percentage) => {
            if (ANIMATION === 'slide') {
                const distance = (SLIDERSIZE / SLIDES.length) * (SLIDES.length - 1);
                if (percentage > 0) {
                    percentage = 0;
                } else if (percentage < -distance) {
                    percentage = -distance;
                }
                SLIDER.style.transform = 'translateX( ' + percentage + '% )';
            } else if (ANIMATION === 'fade') {

            } else {

            }
        }

        const setActiveSlide = (index) => {
            const ELEMENT = document.querySelector('.active');
            if (ELEMENT) {
                ELEMENT.classList.remove('active');
            }
            SLIDES[index].classList.add('active');
        }

        const setTimeOut = (activeIndex) => {
            if (AUTO) {
                clearTimeout(sliderTimer);
                sliderTimer = setTimeout(() => {
                    goToSlide(activeIndex + 1)
                }, AUTO);
            }
        }

        setTimeOut(activeIndex);
        setActiveSlide(activeIndex);
        generateBullets(SLIDES, SLIDERCONTAINER);

    }
}