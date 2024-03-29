function togglePassword() {
    var passwordInput = document.getElementById("password");
    var passwordToggle = document.getElementById("password-toggle");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordToggle.innerHTML = "&#128526;"; 
    } else {
        passwordInput.type = "password";
        passwordToggle.innerHTML = "&#128522;"; 
    }
}
const button = document.getElementById('myButton');

button.addEventListener('click', () => {
    alert('Button was clicked!');
});

const imageContainer = document.querySelector('.image-container');
const image = document.querySelector('.image-container img');

const setImageDimensions = () => {
    const containerWidth = imageContainer.offsetWidth;
    const containerHeight = imageContainer.offsetHeight;
    const imageWidth = image.naturalWidth;
    const imageHeight = image.naturalHeight;

    const aspectRatio = imageWidth / imageHeight;
    let newWidth = containerWidth;
    let newHeight = containerWidth / aspectRatio;

    if (newHeight > containerHeight) {
        newHeight = containerHeight;
        newWidth = containerHeight * aspectRatio;
    }

    image.style.width = `${newWidth}px`;
    image.style.height = `${newHeight}px`;
};

setImageDimensions();

window.addEventListener('resize', setImageDimensions);

