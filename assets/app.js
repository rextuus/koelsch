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

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');


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