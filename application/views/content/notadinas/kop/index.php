
<div id="content" class="enable-bootstrap" >
	<div class="container" style="padding:30px 30px 30px 30px;">
		<a href="<?php echo site_url("notadinas/kop/form/add") ?>" class="btn btn-primary">Tambah</a>
		<table class="table table-stripped">
			<thead>
				<tr>
					<td>Nama</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($conf as $key) {
					?>
					<tr>
						<td>
							<?php echo $key->name ?>
						</td>
						<td>
							<a href="<?php echo site_url("notadinas/kop/form/edit/".$key->id) ?>">Edit</a> 
							<a onclick = "del(<?php echo $key->id ?>)" href="#">Delete</a>
						</td>
					</tr>
					<?php
				}
				 ?>
			</tbody>
		</table>
		
	</div>

</div>
<script type="text/javascript">
	function del(id){
			var con = confirm("Apakah anda yakin akan menghapus template ini?");
			if(con){
				$.post("<?php echo site_url("notadinas/kop/delete") ?>",{
					id:id
				},function(succ){
					window.location ="<?php echo site_url("notadinas/kop") ?>"
				});
			}
		}
</script>