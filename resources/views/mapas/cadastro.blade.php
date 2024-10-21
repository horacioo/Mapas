<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário com Mapa e Geocodificação</title>

  <!-- Incluindo o Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

  <style>
    #map {
      width: 200px;
      height: 200px;
      margin-top: 20px;
      display: none; /* Escondido inicialmente, será exibido após a busca */
    }
  </style>
</head>
<body>

  <h1>Formulário de Cadastro de Cidade com Mapa</h1>

  <!-- Formulário -->
  <form id="form-cidade">
    <label>Cidade: <input type="text" required name="cidade" id="cidade" onchange="buscarCoordenadas()"></label><br><br>
    <label>Latitude: <input type="text" required name="latitude" id="latitude" readonly></label><br><br>
    <label>Longitude: <input type="text" required name="longitude" id="longitude" readonly></label><br><br>
    
    <input type="button" value="Cadastrar" >
  </form>

  <!-- Div onde o mapa será renderizado -->
  <div id="map"></div>

  <!-- Incluindo o Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

  <script>
    // Inicializa o mapa com uma posição padrão (antes de buscar coordenadas)
    var map = L.map('map').setView([0, 0], 3); // Inicia o mapa com zoom afastado
    var marker; // Variável para armazenar o marcador

    // Adiciona as camadas do OpenStreetMap ao mapa
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Função para buscar as coordenadas e exibir o mapa
    function buscarCoordenadas() {
      var cidade = document.getElementById('cidade').value;

      // Verifica se o campo de cidade não está vazio
      if (cidade === '') {
        alert('Por favor, preencha o campo da cidade.');
        return;
      }

      // Faz a requisição à API Nominatim para geocodificação
      fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(cidade)}`)
        .then(response => response.json())
        .then(data => {
          if (data && data.length > 0) {
            var lat = data[0].lat;
            var lon = data[0].lon;

            // Preenche os campos de latitude e longitude
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lon;

            // Exibe o mapa com o local encontrado
            document.getElementById('map').style.display = 'block';  // Exibe o mapa

            // Centraliza o mapa nas coordenadas encontradas
            map.setView([lat, lon], 13);  // Zoom nível 13 para mostrar o local mais de perto

            // Se já houver um marcador, remove-o
            if (marker) {
              map.removeLayer(marker);
            }

            // Adiciona um marcador no local encontrado
            marker = L.marker([lat, lon]).addTo(map);

            // Adiciona um popup ao marcador
            marker.bindPopup(`<p>Cidade: ${cidade}</p><p>Latitude: ${lat}</p><p>Longitude: ${lon}</p>`).openPopup();
          } else {
            alert('Cidade não encontrada!');
          }
        })
        .catch(error => {
          console.error('Erro na geocodificação:', error);
          alert('Erro ao buscar as coordenadas!');
        });
    }
  </script>

</body>
</html>