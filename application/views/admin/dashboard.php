<div class="content">
	
    
    	<ul class="breadcrumb bs-docs">
          <li class="active">Dashboard</li>
        </ul>
        
        <div class="bs-docs">
        	<h3 class="lead">Utilitários</h3>
            
            <?php echo $this->mensagem->display(); ?>
            
            <div class="alert alert-info">
	            <a href="dashboard/backup" class="btn btn-primary">Backup</a>
	            <span class="help-inline">Para fazer o backup do banco de dados</span>
       		</div>

       		
        </div>
    

          <div class="bs-docs">
          
            <h3 class="lead">Chart</h3>
            <p><a href="https://developers.google.com/chart/interactive/docs/examples">https://developers.google.com/chart/interactive/docs/examples</a></p>


            
            <!--Load the AJAX API-->
			<script type="text/javascript" src="https://www.google.com/jsapi"></script>
            <script type="text/javascript">

			google.load('visualization', '1', {packages: ['table', 'gauge', 'intensitymap', 'corechart']});
			google.setOnLoadCallback(drawMouseoverVisualization);
			
			  // barsVisualization must be global in our script tag to be able
			  // to get and set selection.
			  var barsVisualization;
			  function drawMouseoverVisualization() {
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'Year');
				data.addColumn('number', 'Score');
				data.addRows([
				  ['2005',<?php echo $this->db->count_all('categorias'); ?>],
				  ['2006',<?php echo $this->db->count_all('artigos'); ?>],
				  ['2007',<?php echo $this->db->count_all('users'); ?>],
				  ['2008',3.9],
				  ['2009',4.6]
				]);
			
				barsVisualization = new google.visualization.ColumnChart(document.getElementById('mouseoverdiv'));
				barsVisualization.draw(data, null);
			
				// Add our over/out handlers.
				google.visualization.events.addListener(barsVisualization, 'onmouseover', barMouseOver);
				google.visualization.events.addListener(barsVisualization, 'onmouseout', barMouseOut);
			  }
			
			  function barMouseOver(e) {
				barsVisualization.setSelection([e]);
			  }
			
			  function barMouseOut(e) {
				barsVisualization.setSelection([{'row': null, 'column': null}]);
			  }
			</script>
			
			<div id='mouseoverdiv' style="height: 400px;"></div>
            
            
            
            
            
            
            
            
            
            
            
          </div><!-- bs docs -->


    </div>

      



	
















