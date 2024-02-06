import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';
import './styles/footer.scss';
import './styles/upload.scss';
import './styles/navi.scss';
import './styles/random.scss';
import './styles/admin.scss';
import JSConfetti from 'js-confetti'

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');


const jsConfetti = new JSConfetti()

// image upload
function handleImagePreview(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const imagePreview = document.getElementById('image-preview');
            imagePreview.innerHTML = `<img src="${e.target.result}" alt="Selected Image" style="">`;
        };

        reader.readAsDataURL(input.files[0]);
    }
}

// Event listener to trigger the image preview when a file is selected
const imageFileInput = document.querySelector('.custom-file-input');
if (imageFileInput) {
    imageFileInput.addEventListener('change', function () {
        handleImagePreview(this);
    });
}

// gambling
// Function to switch images with increasing speed
let gamblingContainer = document.getElementById('randomSetContainer');
if (gamblingContainer){
    function switchImages() {
        const winnerImage = document.getElementById('winnerImage');
        const looserImageOne = document.getElementById('looserImage1');
        const looserImageTwo = document.getElementById('looserImage2');

        const looserImages = [...document.querySelectorAll('.looserImage')];

        let images = [winnerImage];

        images = images.concat(looserImages);
        console.log(images);
        let currentIndex = 0;
        let initialSpeed = 200; // Initial speed in milliseconds
        let speed = initialSpeed; // Current speed

        const interval = setInterval(() => {
            images[currentIndex].style.display = 'none'; // Hide current image

            currentIndex = (currentIndex + 1) % images.length; // Move to next image
            images[currentIndex].style.display = 'block'; // Show next image

            if (currentIndex === 0) {
                // Increase speed for the next round
                initialSpeed -= 50; // Adjust the decrement value as needed
                speed = initialSpeed > 0 ? initialSpeed : 0; // Ensure speed doesn't go negative
            }

            if (speed <= 0) {
                jsConfetti.addConfetti()

                clearInterval(interval); // Stop interval when speed reaches below or equal to 0
                // Show winner image with text as overlay
                winnerImage.style.display = 'block';
                winnerImage.classList.add('overlay-container');

                const overlay = document.getElementById('winner-overlay');
                overlay.classList.toggle('hidden');

                const statistic = document.getElementById('statistic-panel');
                statistic.classList.toggle('hidden');


                let amountElement = document.getElementById('amount-gaffel');
                if (statistic.classList.contains('gaffel')){
                    amountElement = document.getElementById('amount-gaffel');
                }
                if (statistic.classList.contains('reisi')){
                    amountElement = document.getElementById('amount-reisi');
                }
                if (statistic.classList.contains('frueh')){
                    amountElement = document.getElementById('amount-frueh');
                }


                let amount = parseInt(amountElement.textContent);

// Function to animate incrementing the value
                amountElement.classList.add('blink');

// Function to animate incrementing the value
                function animateValue(endValue, duration) {
                    let start = amount,
                        range = endValue - start,
                        current = start,
                        increment = endValue > start ? 1 : -1,
                        stepTime = Math.abs(Math.floor(duration / range)),
                        timer = setInterval(function () {
                            current += increment;
                            amountElement.textContent = current;
                            if (current == endValue) {
                                clearInterval(timer);
                                // Remove blinking class once animation completes
                                amountElement.classList.remove('blink');

                                overlay.onclick = function() {
                                    overlay.style.display = "none";
                                }
                            }
                        }, stepTime);
                }

// Call the animateValue function to increment the value by 1 over a duration of 1000ms (1 second)
                animateValue(amount + 1, 4000);



            }
        }, speed);
    }

// Start switching images
    setTimeout(switchImages, 100); // Start after 1 second
}
