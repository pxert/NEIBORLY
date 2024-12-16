  // Select all buttons with the class 'wishlist-btn'
  const wishlistButtons = document.querySelectorAll('.wishlist-btn');

  // Add a click event listener to each button
  wishlistButtons.forEach(button => {
    button.addEventListener('click', () => {
      // Find the heart icon (SVG) inside the button
      const heartIcon = button.querySelector('.heart-icon');
      
      // Toggle the button color using your custom classes
      button.classList.toggle('btn-pink');
      button.classList.toggle('btn-white');

      // Change the heart color (fill) depending on the button state
      if (heartIcon.style.fill === 'pink') {
        heartIcon.style.fill = 'white';  // Change to white
      } else {
        heartIcon.style.fill = 'pink';   // Change to pink
      }
    });
  });