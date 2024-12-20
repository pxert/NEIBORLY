console.log('Fichier js chargé');



document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.slider-container');
    if (slider) {
      let isDown = false;
      let startX;
      let scrollLeft;
  
      slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
      });
  
      slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.remove('active');
      });
  
      slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.remove('active');
      });
  
      slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2; // Ajusta la velocidad del desplazamiento
        slider.scrollLeft = scrollLeft - walk;
      });
    }
  });
  