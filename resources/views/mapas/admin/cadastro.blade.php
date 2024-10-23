<form>
    @csrf
    <p><label>Cidade:  <input type="text" id="cidade"  required='required' name='cidade' onchange="buscarCoordenadas()"></label></p>
    <p><label>latitude:  <input type="text" id="latitude" required='required' name='latitude'></label></p>
    <p><label>Longitudo:  <input type="text" id="longitude"  required='required' name='longitude'></label></p>
    <p><input type="submit" value="xxx"></p>
</form>



<script>
    // Função para buscar as coordenadas geográficas usando a API Nominatim
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

            // Preenche os campos de latitude e longitude com os dados obtidos
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lon;
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