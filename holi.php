

/* Estructura general */
/* Configuración del body */
body {
  margin: 0;
  padding: 0;
  font-family: "Almarai", sans-serif;
  font-weight: 300;
  font-style: normal;
  color: #21398F;
}

.sct3, .section4 {
  color: #21398F;
  border-radius: 30px;
}

.sct3 {
  background-color: #CADCE9;
}

.section4 {
  background-color: #E4AEB4;
}

.slider-container {
  scroll-behavior: smooth;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  display: flex;
  gap: 3rem;
  padding: 1rem;
  scrollbar-width: none; /* Oculta la barra de desplazamiento en Firefox */
}

/*
.slider-container::-webkit-scrollbar {
    display: none;
}
*/


.slider-item {
  min-height: 300px;
  width: 300px;
  flex: 0 0 calc(33.333% - 5rem);
  max-width: calc(33.333% - 5rem);
  scroll-snap-align: center;
  border-radius: 30px;
  background-color: #fff;
  padding: 1rem;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Añade una sombra */
  overflow: hidden; /* Asegura que el contenido no se desborde */
}

@media (max-width: 768px) {
  .slider-container {
    gap: 1.5rem; /* Reduce el espacio entre tarjetas */
    justify-content: center; /* Centra las tarjetas */
  }

  .slider-item {
    flex: 0 0 80%; /* Cada tarjeta ocupa el 80% del ancho del contenedor */
    max-width: 80%;
  }
}








.principle {
  color: #21398F;
  background-color: #CADCE9;
  margin: 0;
  width: 100%;
  display: flex;
  font-family: "Almarai", sans-serif;
  font-weight: 300;
  font-style: normal;
  padding: 2rem 0; /* Añade espacio vertical */
}

.principle button,
.principle a {
  background-color: #E4AEB4;
  color: white;
  font-size: 16px;
  font-family: "ADLaM Display", system-ui;
  font-weight: 400;
  font-style: normal;
  border: none;
  padding: 0.5rem 1.5rem;
  text-decoration: none; /* Asegura que los enlaces no tengan subrayado */
}

.principle button:hover,
.principle a:hover {
  background-color: #cadce9;
  color: #21398F; /* Cambia el color en hover */exemplaire."
  
  – Isabelle, 27 ans
}

.principle p {
  font-size: clamp(1.25rem, 2.5vw, 1.5rem);
  margin-bottom: 1.5rem; /* Añade espacio debajo del párrafo */
}

.illustration img {
  max-height: 400px;
  object-fit: contain;
}

h1 {
  color: #21398F;
  font-family: "ADLaM Display", system-ui;
  font-weight: 400;
  font-style: normal;
  padding: 30px;
  font-size: 32px;
}

  





  
.tmg p, 
.tmg .fw-bold {
  color: #21398F; /* Unifica el color */
}

.btn-aide:hover {
  background-color: white; /* Un tono más oscuro al pasar el ratón */
  transition: background-color 0.3s ease; /* Añade transición para un cambio suave */
}



/* Footer */
footer {
  background-color: #222;
  color: white;
  text-align: left; /* Alineación izquierda para columnas */
  padding: 20px 40px; /* Espaciado interno más amplio */
  display: flex;
  flex-wrap: wrap; /* Ajusta columnas en pantallas pequeñas */
  justify-content: space-between; /* Espaciado uniforme entre columnas */
  align-items: flex-start; /* Alinea contenido al inicio */
  margin-top: auto; /* Asegura que el footer esté en la parte inferior */
}

footer h5 {
  font-size: 1rem;
  font-weight: bold;
  margin-bottom: 15px; /* Espaciado uniforme debajo del título */
  color: #f8f9fa;
}

footer a {
  color: #6c757d; /* Color gris predeterminado */
  text-decoration: none;
  font-size: 0.9rem;
  transition: color 0.3s ease; /* Transición para un cambio de color suave */
}

footer a:hover {
  color: #007bff; /* Azul al pasar el ratón */
}

footer p {
  margin: 0; /* Elimina márgenes predeterminados */
  font-size: 0.9rem; /* Tamaño más accesible */
  color: #b0b0b0;
}

.footer-list, .footer-list ul {
  margin: 0; /* Elimina márgenes superiores */
  padding: 0;
  list-style: none; /* Sin viñetas */
}

.footer-list li {
  margin-bottom: 10px; /* Espaciado entre elementos */
}


/* Redes Sociales */
.social-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 2.5rem; /* Tamaño relativo para mejor escalabilidad */
  height: 2.5rem;
  background-color: white; /* Fondo blanco */
  border-radius: 50%; /* Hace los íconos circulares */
  margin-right: 0.625rem; /* Espaciado entre íconos */
}

.social-icon svg {
  width: 1.5rem; /* Ajusta tamaño de íconos */
  height: 1.5rem;
  color: #E4AEB4; /* Color inicial */
  transition: color 0.3s ease, transform 0.3s ease; /* Añade una transición suave */
}

.social-icon svg:hover {
  color: #21398F; /* Cambia a un azul más oscuro en hover */
  transform: scale(1.1); /* Aumenta ligeramente el tamaño en hover */
}

/* Responsividad */
@media (max-width: 768px) {
  footer {
    flex-direction: column; /* Cambia diseño a columnas apiladas */
    text-align: center;
    gap: 1rem; /* Añade espacio uniforme entre secciones */
  }

  .footer-list {
    margin-bottom: 1.25rem; /* Añade espacio entre secciones */
  }

  .social-icon {
    margin: 0.3125rem; /* Ajusta márgenes para evitar amontonamiento */
  }
}

/* Menú en el header */
#menu-en-tete-du-menu li a {
  color: white;
  transition: color 0.3s ease-in-out, text-decoration 0.3s ease-in-out;
}

#menu-en-tete-du-menu li a:hover {
  color: #21398F; /* Cambia a azul oscuro */
  text-decoration: underline; /* Añade subrayado en hover */
}








/* Navbar personalizada */
.custom-navbar {
  background-color: #E4AEB4;
  padding: 0.75rem 1rem; /* Espaciado interno uniforme */
}

/* Estilo del navbar principal */
.navbar {
  padding: 0.625rem 1.25rem; /* Espaciado interno optimizado */
}

/* Barra de búsqueda personalizada */
.navbar .form-control {
  width: 100%;
  max-width: 25rem; /* 400px traducido a rem */
  border-radius: 0.5rem; /* Bordes redondeados */
}

.navbar .btn {
  margin-left: 0.625rem; /* Espaciado uniforme */
  border-radius: 0.5rem; /* Bordes redondeados */
}

/* Fondo rosado */
.bg-pink {
  background-color: #CADCE9;
}

/* Botones primarios */
.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
  color: white;
  transition: background-color 0.3s ease, transform 0.2s ease; /* Suaviza los cambios */
}

.btn-primary:hover {
  background-color: #0056b3; /* Azul más oscuro */
  transform: scale(1.05); /* Aumenta ligeramente el tamaño */
}

/* Botones secundarios */
.btn-outline-secondary {
  color: #6c757d;
  border-color: #6c757d;
  transition: color 0.3s ease, border-color 0.3s ease, transform 0.2s ease;
}

.btn-outline-secondary:hover {
  color: #495057; /* Gris más oscuro */
  border-color: #495057;
  transform: scale(1.05); /* Aumenta ligeramente el tamaño */
}







/*button log out*/
#logoutButton {
  position: fixed;
  top: 110px; /* Ajusta según tu diseño */
  right: 20px;
  background-color: #FF6B6B; /* Rojo suave */
  color: white;
  border-radius: 50px;
  padding: 0.5rem 1rem; /* Usar rem para escalabilidad */
  font-size: 1rem; /* Escalable */
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 0.5rem; /* Espacio entre ícono y texto */
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  z-index: 1050; /* Asegura que esté por encima de otros elementos */
  transition: transform 0.2s ease-in-out, opacity 0.2s ease-in-out;
}

/* Botón Logout */
#logoutButton {
  position: fixed;
  top: 110px; /* Ajusta según tu diseño */
  right: 20px;
  background-color: #FF6B6B; /* Rojo suave */
  color: white;
  border-radius: 50px;
  padding: 0.5rem 1rem; /* Usar rem para escalabilidad */
  font-size: 1rem; /* Escalable */
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 0.5rem; /* Espacio entre ícono y texto */
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  z-index: 1050; /* Asegura que esté por encima de otros elementos */
  transition: transform 0.2s ease-in-out, opacity 0.2s ease-in-out;
}

#logoutButton:hover {
  transform: scale(1.05);
  opacity: 0.9;
}

.logout-icon {
  font-size: 1.25rem; /* Tamaño escalable del ícono */
}

/* Navbar */
nav ul.navbar-nav {
  display: flex;
  justify-content: space-between;
  width: 100%;
}

nav ul.navbar-nav li:last-child {
  margin-left: auto; /* Empuja el último elemento hacia el extremo derecho */
}

/* Barra de Búsqueda */
.navbar .search-form {
  margin: 0 auto;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 60%;
  max-width: 400px; /* Asegura que no se expanda demasiado */
  background-color: white;
  border-radius: 1.25rem;
  padding: 0.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease; /* Suaviza el efecto al interactuar */
}

.navbar .search-form input {
  border: none;
  outline: none;
  flex: 1; /* Toma el espacio restante */
  padding: 0.5rem;
  font-size: 1rem;
}

.navbar .search-form button {
  background-color: transparent;
  border: none;
  cursor: pointer;
  transition: transform 0.3s ease;
}

.navbar .search-form button:hover {
  transform: scale(1.1);
}













/* Enlaces no listados */
.list-unstyled li a {
  color: #6c757d; /* Color gris */
  text-decoration: none;
  transition: color 0.3s ease; /* Transición suave al cambiar de color */
}

.list-unstyled li a:hover {
  color: #495057; /* Color más oscuro en hover */
  text-decoration: underline;
}

/* Texto truncado */
.section2 p {
  max-height: 100px; /* Limita la altura del texto */
  overflow: hidden; /* Oculta el contenido adicional */
  text-overflow: ellipsis; /* Agrega "..." al final del texto si es demasiado largo */
  line-height: 1.5; /* Ajusta el interlineado para mejorar la legibilidad */
  white-space: nowrap; /* Asegura que el texto se trunque en una línea */
}

/* Diseño flexible para .sct2 */
.sct2 {
  background-color: rgba(249, 220, 223, 0.25); /* Fondo limpio y transparente */
  border-radius: 30px;
  color: #21398F;
  display: flex;
  flex-direction: column;
  justify-content: space-between; /* Distribuye uniformemente los elementos */
  height: auto; /* Cambiado para evitar problemas con contenedores flexibles */
  padding: 1rem; /* Añade espacio interno */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra ligera para destacar */
}


/* Imagen dentro de la tarjeta */
.card .icon img {
  max-width: 100%;
  height: auto;
  object-fit: cover; /* Asegura que la imagen se ajuste correctamente */
  margin-bottom: 15px; /* Espacio inferior */
}

/* Títulos dentro de .sct2 */
.sct2 h2 {
  margin-bottom: 20px; /* Espacio inferior del título */
  text-align: center; /* Alineación centrada */
  font-size: 1.5rem; /* Ajusta el tamaño del título si es necesario */
}

/* Cuerpo de la tarjeta */
.card-body {
  padding: 20px; /* Ajuste más compacto */
  display: flex;
  flex-direction: column;
  justify-content: space-between; /* Distribuye el contenido de manera uniforme */
  gap: 15px; /* Espaciado entre elementos internos */
}

/* Texto en el cuerpo de la tarjeta */
.card-body p {
  margin-bottom: 0; /* Evita márgenes adicionales innecesarios */
  text-align: center; /* Centrado del texto */
  font-size: 1rem; /* Ajusta el tamaño para mayor legibilidad */
  line-height: 1.5; /* Mejora la legibilidad */
}



.side-bar {
  background-color: rgba(228, 174, 180, 0.54); /* Transparencia más legible */
  position: sticky;
  top: 0;
  left: 0;
  width: 100%;
  max-width: 305px;
  color: white;
  border-right: 1px solid #ddd;
  padding: 20px;
  z-index: 1000;
  height: auto;
}

.side-bar h3 {
  color: #21398F;
  font-size: 1.5rem;
  margin-bottom: 1.5rem;
}

.side-bar .nav-link {
  font-size: 1.25rem; /* Ajuste de tamaño para mejorar accesibilidad */
  font-family: "ADLaM Display", system-ui;
  font-weight: 400;
  color: #fff;
  background-color: transparent;
  border-radius: 20px; /* Menor curvatura para modernidad */
  padding: 10px 15px;
  display: flex;
  align-items: center;
  transition: background-color 0.3s, color 0.3s; /* Suaviza el hover */
}

.side-bar .nav-link:hover {
  background-color: #e4aeb4; /* Añade efecto hover */
  color: #21398F;
}

.side-bar .nav-link img {
  margin-right: 10px;
  width: 20px; /* Asegura tamaños consistentes */
  height: auto;
}

/* Responsividad */
@media (max-width: 768px) {
  .side-bar {
    padding: 10px;
    max-width: 100%; /* Se expande en pantallas pequeñas */
  }

  .side-bar h3 {
    font-size: 1.2rem;
    margin-bottom: 1rem;
  }

  .side-bar .nav-link {
    font-size: 1rem; /* Reduce tamaño en móviles */
    padding: 8px 10px;
  }
}


/*hola*/
.side-bar .nav-link {
  transition: background-color 0.3s, color 0.3s; /* Transición suave */
}

.side-bar .nav-link:hover {
  color: #21398F;
  background-color: #E4AEB4; /* Mantén consistencia con active */
}

.side-bar .nav-link.active {
  background-color: #E4AEB4;
  color: #fff;
}

/* Responsividad */
@media (max-width: 768px) {
  .side-bar {
    width: 100%;
    max-width: none; /* Elimina cualquier límite de ancho */
    border-right: none; /* No tiene sentido mantener esto en pantallas pequeñas */
    padding: 10px;
    height: auto;
  }

  .side-bar h3 {
    text-align: center;
    font-size: 1.2rem;
  }

  .side-bar .nav-link {
    justify-content: center; /* Centra los enlaces */
    padding: 8px 12px; /* Ajuste menor para mantener buen diseño */
  }
}










.posts {
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.post {
  background-color: rgba(249, 220, 223, 0.25); /* Fondo con transparencia */
  padding: 20px;
  border-radius: 30px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra ligera para resaltar */
}

.post h4 {
  font-size: 1.25rem; /* Ajuste responsivo con rem */
  font-family: "ADLaM Display", system-ui;
  font-weight: 400;
  color: #21398F;
  margin: 0; /* Elimina márgenes innecesarios */
}





/* Estilo inicial del botón */
.post-btn {
  background-color: #E4AEB4;
  color: white;
  font-size: 1rem; /* Usar rem para escalabilidad */
  font-family: "ADLaM Display", system-ui;
  font-weight: 400;
  border-radius: 50px;
  text-align: center;
  padding: 10px 20px;
  display: inline-block;
  border: none;
  transition: background-color 0.3s ease, color 0.3s ease; /* Transiciones específicas */
  text-decoration: none;
}

/* Hover del botón */
.post-btn:hover {
  background-color: rgba(228, 174, 180, 0.2); /* Fondo transparente */
  color: #21398F;
}

/* Estilo del formulario */
form .form-control {
  border-radius: 50px;
  border: 1px solid #ccc;
  padding: 10px 15px;
  font-family: 'ADLaM Display', sans-serif;
  transition: border-color 0.3s ease; /* Efecto en el borde */
}

form .form-control:focus {
  border-color: #21398F; /* Color destacado en focus */
  box-shadow: 0 0 5px rgba(33, 57, 143, 0.5); /* Sombra suave */
}

form .form-label {
  font-weight: bold;
  color: #21398F; /* Asegurar consistencia en colores */
}

form textarea.form-control {
  border-radius: 20px;
  resize: vertical; /* Permitir redimensionar solo en vertical */
}

form .btn {
  padding: 10px 30px;
  font-size: 1rem;
  font-weight: bold;
  background-color: #E4AEB4;
  color: white;
  border: none;
  border-radius: 50px;
  transition: background-color 0.3s ease, color 0.3s ease;
}

form .btn:hover {
  background-color: #21398F;
  color: white;
}











body {
  font-family: 'Almarai', sans-serif; /* Texto general */
}

h1, h3, h4, h5, h6 {
  font-family: 'ADLaM Display', system-ui; /* Títulos importantes */
}


