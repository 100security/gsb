<!DOCTYPE HTML>
<!--
	100SECURITY
	www.100security.com.br
	Marcos Henrique - @100security
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>🔒 Google Safe Browsing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>	
  </head>
  <body>
    <br>
    <br>
    <br>
    <main class="container">
	<div class="d-flex align-items-center p-3 my-3 text-white bg-dark rounded shadow-sm justify-content-between">
		<h5 class="mb-0 text-white">🔒 Google Safe Browsing</h5>
		<div>
			<button type="button" id="export-csv" class="btn btn-success" onclick="window.location.href='export_to_csv.php'">Export to CSV</button>
			<button type="button" class="btn btn-default" onclick="window.open('https://www.github.com/100security/gsb', '_blank')">GitHub</button>
			<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#aboutModal">About</button>
		</div>
	</div>
      <div class="my-4 p-3 bg-white rounded shadow-sm">
        <div class="container">
          <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
            <div class="col text-center">
              <img src='img/unsafe.png'>
              <br>
              <br>
              <div class="p-3 border bg-danger">
                <font color="white">Unsafe</font>
                <h1>
                  <b>
                    <span class="num-unsafe" style="color: white">Loading...</span>
                  </b>
                </h1>
				<button type="button" id="filter-unsafe" class="btn btn-dark">Filter</button>
              </div>
            </div>
            <div class="col text-center">
              <img src='img/safe.png'>
              <br>
              <br>
              <div class="p-3 border bg-success">
                <font color="white">Safe</font>
                <h1>
                  <b>
                    <span class="num-safe" style="color: white">Loading...</span>
                  </b>
                </h1>
				<button type="button" id="filter-safe" class="btn btn-dark">Filter</button>
              </div>
            </div>
            <div class="col text-center">
              <img src='img/duplicates.png'>
              <br>
              <br>
              <div class="p-3 border bg-warning">
                <font color="white">Duplicates</font>
                <h1>
                  <b>
                    <span class="num-duplicates" style="color: white">Loading...</span>
                  </b>
                </h1>
				<button type="button" id="filter-duplicates" class="btn btn-dark">Filter</button>
              </div>
            </div>
            <div class="col text-center">
              <img src='img/total.png'>
              <br>
              <br>
              <div class="p-3 border bg-primary">
                <font color="white">Total</font>
                <h1>
                  <b>
                    <span class="num-total" style="color: white">Loading...</span>
                  </b>
                </h1>
				<!-- <button type="button" class="btn btn-dark" onclick="window.location.reload();">Filter</button> -->
				<button type="button" id="filter-total" class="btn btn-dark">Filter</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      </div>
<div class="container">
    <canvas id="httpCodesChart"></canvas>
</div>

      <div class="my-4 p-3 bg-white rounded shadow-sm">
        <div class="container">
          <span id="conteudo"></span>
        </div>
      </div>
      <div class="align-items-center p-3 my-3 text-white bg-light rounded shadow-sm">
        <div class="text-center">
          <center>
            <font color="white"><h5 class="h6 mb-0 text-white text-center"><a href="https://www.100security.com.br/gsb" target="_blank">www.100security.com.br/gsb</a></font></h5>
          </center>
        </div>
      </div>
    </main>
<script>
$(document).ready(function() {
    $('#updateButton').click(function() {
        window.location.reload();
    });
});
</script>
<script>
$(document).ready(function() {
    var qnt_result_pg = 9999999999;
    var pagina = 1;

    list_sites(pagina, qnt_result_pg);

	
	$('#filter-unsafe').click(function() {
		  list_sites(1, qnt_result_pg, 'Unsafe').then(function() {
			document.getElementById('conteudo').scrollIntoView({
			  behavior: 'smooth'
			});
		  });
		});
	
    $('#filter-safe').click(function() {
      list_sites(1, qnt_result_pg, 'Safe').then(function() {
        document.getElementById('conteudo').scrollIntoView({
          behavior: 'smooth'
        });
      });
    });

    $('#filter-duplicates').click(function() {
      list_sites(1, qnt_result_pg, 'Duplicates').then(function() {
        document.getElementById('conteudo').scrollIntoView({
          behavior: 'smooth'
        });
      });
    });

    $('#filter-total').click(function() {
      list_sites(1, qnt_result_pg, '').then(function() {
        document.getElementById('conteudo').scrollIntoView({
          behavior: 'smooth'
        });
      });
    });

    function list_sites(pagina, qnt_result_pg, statusFilter = '') {
      var dados = {
        pagina: pagina,
        qnt_result_pg: qnt_result_pg,
        statusFilter: statusFilter
      };
      $.post('list_sites.php', dados, function(retorna) {
        $("#conteudo").html(retorna);
      });
    }

    function list_sites(pagina, qnt_result_pg, statusFilter = '') {
      return new Promise((resolve, reject) => {
        var dados = {
          pagina: pagina,
          qnt_result_pg: qnt_result_pg,
          statusFilter: statusFilter
        };
        $.post('list_sites.php', dados, function(retorna) {
          $("#conteudo").html(retorna);
          resolve();
        });
      });
    }

    $.getJSON('get_status_count.php', function(data) {
      $('.num-safe').text(data.safe);
      $('.num-unsafe').text(data.unsafe);
      $('.num-duplicates').text(data.duplicates);
      $('.num-total').text(data.total);
    });
  });
</script>
    <br>
    <br>

	<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="confirmModalLabel">🔴 Confirm Removal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Are you sure you want to remove this site?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger" id="confirm-remove">Remove</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="aboutModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="aboutModalLabel">🔓 About</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
		  <center><img src="img/100security.png" width="100px" height="100px"><br><br>
			Profissionais de Segurança da Informação<br>
			<a href="https://www.100security.com.br/" target="_blank">www.100security.com.br</a><br><br>
			by: <a href="https://www.linkedin.com/in/user-marcoshenrique" target="_blank">Marcos Henrique</a><br>
			<br><hr>
			<b>Google Safe Browsing</b><br>
			<br></center>
			<p align="justify">
			This Web tool displays results gathered from Google Safe Browsing, providing clear insights into which sites are flagged as dangerous. It aids users in safely navigating the internet by alerting them about potential threats from malware, phishing, and unwanted software.
			<br></p>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-warning" data-dismiss="modal">Fechar</button>
		  </div>
		</div>
	  </div>
	</div>

	<script>
	$(document).ready(function() {
		$('body').on('click', '.remove-btn', function() {
			var siteId = $(this).data('id');
			$('#confirmModal').modal('show');

			$('#confirm-remove').off('click').on('click', function() {
				$.post('remove_site.php', {id: siteId}, function(response) {
					$('#confirmModal').modal('hide');
					window.location.reload();
					list_sites(pagina, qnt_result_pg);
				});
			});
		});

		function list_sites(pagina, qnt_result_pg, statusFilter = '') {
			var dados = {
				pagina: pagina,
				qnt_result_pg: qnt_result_pg,
				statusFilter: statusFilter
			};
			$.post('list_sites.php', dados, function(retorna) {
				$("#conteudo").html(retorna);
			});
		}
	});
	</script>
	
	<script>
	$(document).ready(function(){
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		$('#back-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
	</script>

	<script>
	$(document).ready(function() {
		$.ajax({
			url: 'get_http_codes.php',
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				var httpCodesData = data;
				var ctx = document.getElementById('httpCodesChart').getContext('2d');
				var httpCodesChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: Object.keys(httpCodesData),
						datasets: [{
							label: 'HTTP Codes Count',
							data: Object.values(httpCodesData),
							backgroundColor: 'rgba(54, 162, 235, 0.2)',
							borderColor: 'rgba(54, 162, 235, 1)',
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							y: {
								beginAtZero: true
							}
						}
					}
				});
			},
			error: function(xhr, status, error) {
				console.error("Error loading data: ", error);
			}
		});
	});
	</script>

	<div id="back-top" style="display: none; position: fixed; bottom: 20px; right: 20px; cursor: pointer;">
		<a href="#top"><span style="font-size: 40px;">🔼</span></a>
	</div>

  </body>
</html>