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
  




  const searchInput = document.querySelector('#search-input');
const searchButton = document.querySelector('#search-button');

searchButton.addEventListener('click', () => {
    const searchTerm = searchInput.value;

    fetch(ajaxObject.ajaxUrl, {
        method: 'POST',
        body: new URLSearchParams({
            action: 'custom_search',
            search_term: searchTerm,
        }),
        headers: {
            'Content-type': 'application/x-www-form-urlencoded',
        },
    })
    .then(response => response.json())
    .then(data => {
        const resultsContainer = document.querySelector('#results');
        resultsContainer.innerHTML = ''; // Limpia resultados anteriores
        for (const [key, url] of Object.entries(data)) {
            const result = document.createElement('div');
            result.innerHTML = `<a href="${url}">${key}</a>`;
            resultsContainer.appendChild(result);
        }
    });
});
