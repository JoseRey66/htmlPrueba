<?php
// En tu página actual
include 'header.php';
?>
<br>
<main id="content" role="main">
  
  <!-- Article Description Section -->
  <div class="d-lg-flex position-relative">
    <div class="w-lg-80 mx-lg-auto">
      <div class="container d-lg-flex align-items-lg-center space-top-2 space-lg-0 min-vh-lg-100">  
        <style>
          .positive {
            color: green;
          }

          .negative {
            color: red;
          }
        </style>
   <table id="pricesTable" class="table table-striped">
       <thead>
           <tr>
               <th>Name</th>
               <th>Price (USD)</th>
               <th>24h %</th>
               <th>Market Cap</th>
               <th>Volume (24h)</th>
               <th>Circulating Supply</th>
           </tr>
       </thead>
       <tbody id="pricesTableBody"></tbody>
   </table>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

   <script>
       // Obtener la referencia a la tabla en HTML
       var pricesTable = document.getElementById("pricesTableBody");
       var currentPage = 1;
       var coinsPerPage = 50;

       function updateTable() {
           // Calcular los parámetros de paginación
           var start = (currentPage - 1) * coinsPerPage;
           var end = start + coinsPerPage;

           // Hacer una solicitud a la API de CoinGecko para obtener las criptomonedas correspondientes a la página actual
           fetch(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=${coinsPerPage}&page=${currentPage}&sparkline=false`)
               .then(response => response.json())
               .then(data => {
                   // Limpiar la tabla antes de agregar las nuevas filas
                   pricesTable.innerHTML = "";

                   // Recorrer los datos y crear filas en la tabla
                   data.forEach(coin => {
                       var row = pricesTable.insertRow();
                       var nameCell = row.insertCell(0);
                       var priceCell = row.insertCell(1);
                       var percent24hCell = row.insertCell(2);
                       var marketCapCell = row.insertCell(3);
                       var volumeCell = row.insertCell(4);
                       var circulatingSupplyCell = row.insertCell(5);

                       // Agregar el icono de la criptomoneda
                       var icon = document.createElement("img");
                       icon.src = coin.image;
                       icon.style.width = "20px"; // Ajusta el tamaño del ícono según tus necesidades
                       nameCell.appendChild(icon);

                       // Agregar el nombre de la criptomoneda
                       nameCell.innerHTML += " " + coin.name;

                       // Resto de las celdas
                       priceCell.innerHTML = coin.current_price;

                       // Aplicar clases CSS en función del porcentaje
                       if (coin.price_change_percentage_24h < 0) {
                           percent24hCell.classList.add("negative");
                       } else {
                           percent24hCell.classList.add("positive");
                       }
                       percent24hCell.innerHTML = coin.price_change_percentage_24h;

                       marketCapCell.innerHTML = coin.market_cap;
                       volumeCell.innerHTML = coin.total_volume;
                       circulatingSupplyCell.innerHTML = coin.circulating_supply;
                   });

                   // Inicializar DataTables después de agregar las filas
                   $('#pricesTable').DataTable({
                       "paging": true,
                       "pageLength": 10,
                       "searching": true
                   });
               })
               .catch(error => {
                   console.log('Error:', error);
               });
       }

       // Actualizar la tabla al cargar la página
       updateTable();
   </script>
   </div>
 </div></div>
 
</main>

 <footer class="bg-navy">
  <div class="container">
      <div class="space-top-2 space-bottom-1 space-bottom-lg-2">
          <div class="row justify-content-lg-between">
              <div class="col-lg-3 ml-lg-auto mb-5 mb-lg-0">
                  <!-- Logo -->
                  <div class="mb-4">
                      <a href="index.html" aria-label="Front">
                          <img class="brand" src="../../assets/svg/logos/logocoin.PNG" alt="Logo">
                      </a>
                  </div>
                  <!-- End Logo -->

                  <!-- Nav Link -->
                  <ul class="nav nav-sm nav-x-0 nav-white flex-column">
                      <li class="nav-item">
                          <a class="nav-link media" href="javascript:;">
                              <span class="media">
                                  <span class="fas fa-location-arrow mt-1 mr-2"></span>
                                  <span class="media-body">
                                      Lambayeque, Perú
                                  </span>
                              </span>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link media" href="tel:+51999999999">
                              <span class="media">
                                  <span class="fas fa-phone-alt mt-1 mr-2"></span>
                                  <span class="media-body">
                                      +51 999 999 999
                                  </span>
                              </span>
                          </a>
                      </li>
                  </ul>
                  <!-- End Nav Link -->
              </div>

              <div class="col-6 col-md-3 col-lg mb-5 mb-lg-0">
                  <h5 class="text-white">Compañia</h5>

                  <!-- Nav Link -->
                  <ul class="nav nav-sm nav-x-0 nav-white flex-column">
                     <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                      
                  </ul>
                  <!-- End Nav Link -->
              </div>

              <div class="col-6 col-md-3 col-lg mb-5 mb-lg-0">
                  <h5 class="text-white">Caracterisiticas</h5>

                  <!-- Nav Link -->
                  <ul class="nav nav-sm nav-x-0 nav-white flex-column">
                      <li class="nav-item"><a class="nav-link" href="#">Prensa</a></li>
                      <li class="nav-item"><a class="nav-link" href="#">Notas</a></li>
                      <li class="nav-item"><a class="nav-link" href="#">Integraciones</a></li>
                      <li class="nav-item"><a class="nav-link" href="#">Precios</a></li>
                  </ul>
                  <!-- End Nav Link -->
              </div>

              <div class="col-6 col-md-3 col-lg">
                  <h5 class="text-white">Documentacion</h5>

                  <!-- Nav Link -->
                  <ul class="nav nav-sm nav-x-0 nav-white flex-column">
                      <li class="nav-item"><a class="nav-link" href="#">Soporte</a></li>
                      <li class="nav-item"><a class="nav-link" href="#">Documentacion</a></li>
                      <li class="nav-item"><a class="nav-link" href="#">Estado</a></li>
                      <li class="nav-item"><a class="nav-link" href="#">API de Referencia</a></li>
                      <li class="nav-item"><a class="nav-link" href="#">Requerimientos</a></li>
                  </ul>
                  <!-- End Nav Link -->
              </div>

              <div class="col-6 col-md-3 col-lg">
                  <h5 class="text-white">Resources</h5>

                  <!-- Nav Link -->
                  <ul class="nav nav-sm nav-x-0 nav-white flex-column">
                      <li class="nav-item">
                          <a class="nav-link" href="#">
                              <span class="media align-items-center">
                                  <i class="fa fa-info-circle mr-2"></i>
                                  <span class="media-body">Help</span>
                              </span>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#">
                              <span class="media align-items-center">
                                  <i class="fa fa-user-circle mr-2"></i>
                                  <span class="media-body">Your Account</span>
                              </span>
                          </a>
                      </li>
                  </ul>
                  <!-- End Nav Link -->
              </div>
          </div>
      </div>

      <hr class="opacity-xs my-0">

      <div class="space-1">
          <div class="row align-items-md-center mb-7">
              <div class="col-md-6 mb-4 mb-md-0">
                  <!-- Nav Link -->
                  <ul class="nav nav-sm nav-white nav-x-sm align-items-center">
                      <li class="nav-item">
                          <a class="nav-link" href="#">Privacidad &amp; Politicas</a>
                      </li>
                      <li class="nav-item opacity mx-3">&#47;</li>
                      <li class="nav-item">
                          <a class="nav-link" href="#">Terminos</a>
                      </li>
                      <li class="nav-item opacity mx-3">&#47;</li>
                      <li class="nav-item">
                          <a class="nav-link" href="#">Mapa</a>
                      </li>
                  </ul>
                  <!-- End Nav Link -->
              </div>

              <div class="col-md-6 text-md-right">
                  <ul class="list-inline mb-0">
                      <!-- Social Networks -->
                      <li class="list-inline-item">
                          <a class="btn btn-xs btn-icon btn-soft-light" href="#">
                              <i class="fab fa-facebook-f"></i>
                          </a>
                      </li>
                      <li class="list-inline-item">
                          <a class="btn btn-xs btn-icon btn-soft-light" href="#">
                              <i class="fab fa-google"></i>
                          </a>
                      </li>
                      <li class="list-inline-item">
                          <a class="btn btn-xs btn-icon btn-soft-light" href="#">
                              <i class="fab fa-twitter"></i>
                          </a>
                      </li>
                      <li class="list-inline-item">
                          <a class="btn btn-xs btn-icon btn-soft-light" href="#">
                              <i class="fab fa-github"></i>
                          </a>
                      </li>
                      <!-- End Social Networks -->
                  </ul>
              </div>
          </div>

          <!-- Copyright -->
          <div class="w-md-75 text-lg-center mx-lg-auto">
              <p class="text-white opacity-sm small">&copy; 2023 Derechos Reservados</p>
              <p class="text-white opacity-sm small">Cuando visita o interactúa con nuestros sitios, servicios o herramientas, nosotros o nuestros proveedores de servicios autorizados podemos usar cookies para almacenar información para ayudarlo a brindarle una experiencia mejor, más rápida y más segura y con fines de marketing</p>
          </div>
          <!-- End Copyright -->
      </div>
  </div>
</footer>

<a class="js-go-to go-to position-fixed" href="javascript:;" style="visibility: hidden;"
   data-hs-go-to-options='{
     "offsetTop": 700,
     "position": {
       "init": {
         "right": 15
       },
       "show": {
         "bottom": 15
       },
       "hide": {
         "bottom": -15
       }
     }
   }'>
  <i class="fas fa-angle-up"></i>
</a>



   
     <!-- JS Implementing Plugins -->
     <script src="../../assets/vendor/hs-header/dist/hs-header.min.js"></script>
  <script src="../../assets/vendor/hs-go-to/dist/hs-go-to.min.js"></script>
  <script src="../../assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.js"></script>
  <script src="../../assets/vendor/typed.js/lib/typed.min.js"></script>
  <script src="../../assets/vendor/fancybox/dist/jquery.fancybox.min.js"></script>
  <script src="../../assets/vendor/aos/dist/aos.js"></script>

  <!-- JS Front -->
  <script src="../../assets/js/hs.core.js"></script>
  <script src="../../assets/js/hs.fancybox.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    $(document).on('ready', function () {
      // initialization of header
      var header = new HSHeader($('#header')).init();

      // initialization of mega menu
      var megaMenu = new HSMegaMenu($('.js-mega-menu'), {
        desktop: {
          position: 'left'
        }
      }).init();

      // initialization of text animation (typing)
      var typed = new Typed(".js-text-animation", {
        strings: ["ideal", "fastest", "convenient"],
        typeSpeed: 60,
        loop: true,
        backSpeed: 25,
        backDelay: 1500
      });

      // initialization of fancybox
      $('.js-fancybox').each(function () {
        var fancybox = $.HSCore.components.HSFancyBox.init($(this));
      });

      // initialization of aos
      AOS.init({
        duration: 650,
        once: true
      });

      // initialization of go to
      $('.js-go-to').each(function () {
        var goTo = new HSGoTo($(this)).init();
      });
    });
  </script>

  <!-- IE Support -->
  <script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="../../assets/vendor/polifills.js"><\/script>');
  </script>
   
     <!-- JS Front -->
     <script src="../../assets/js/hs.core.js"></script>
     <script src="../../assets/js/hs.fancybox.js"></script>
   
     <!-- JS Plugins Init. -->
     <script>
       $(document).on('ready', function () {
         // initialization of header
         var header = new HSHeader($('#header')).init();
   
         // initialization of mega menu
         var megaMenu = new HSMegaMenu($('.js-mega-menu'), {
           desktop: {
             position: 'left'
           }
         }).init();
   
         // initialization of text animation (typing)
         var typed = new Typed(".js-text-animation", {
           strings: ["ideal", "fastest", "convenient"],
           typeSpeed: 60,
           loop: true,
           backSpeed: 25,
           backDelay: 1500
         });
   
         // initialization of fancybox
         $('.js-fancybox').each(function () {
           var fancybox = $.HSCore.components.HSFancyBox.init($(this));
         });
   
         // initialization of aos
         AOS.init({
           duration: 650,
           once: true
         });
   
         // initialization of go to
         $('.js-go-to').each(function () {
           var goTo = new HSGoTo($(this)).init();
         });
       });
     </script>
   
     
</body>
</html>
