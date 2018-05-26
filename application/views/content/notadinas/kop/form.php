
<script type="text/javascript" src="<?php  echo $this->config->item('js') ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php  echo $this->config->item('js') ?>ckeditor/config.js"></script>
<script type="text/javascript" src="<?php  echo $this->config->item('js') ?>ckeditor/styles.js"></script>
<!-- <script type="text/javascript" src="<?php  echo $this->config->item('js') ?>tinymce/4.7/tinymce/tinymce.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php  echo $this->config->item('js') ?>tinymce/4.5/tinymce/tinymce.min.js"></script> -->
<!-- <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script> -->

<div id="content" class="enable-bootstrap">
	<div class="container">
		<form class="form" onSubmit="return validate();" action="<?php echo site_url("notadinas/kop/".$action) ?>" method="post">
		<input type="submit" name="submit" class="btn btn-danger" value="Simpan"><br><br>
			<label>Name</label>
			<input type="text" name="name" class="form-control" value ="<?php echo (isset($kop->name)) ? $kop->name : "" ?>" placeholder="Name">
			<label>Template KOP</label><br>
			<textarea id="isi" name="isi"><?php echo (isset($kop->isi)) ? $kop->isi : "" ?></textarea><br>
		</form>
	</div>
</div>
<style type="text/css">
	th, td {
  border: solid 1px #ccc;
  text-align: center;
  padding: 10px;
}
</style>
<script type="text/javascript">
	function validate(){
		if($("input[name=name]").val() == ""){
			alert("Nama Harus di isi");
			return false;
		}
		// alert($("#isi").val());
		if($("#isi").val() == ""){
			alert("Kop Harus di isi");
			return false;
		}

		return true;
	}
	$(document).ready(function(){

		tinymce.init({
		  selector: '#isi',
		  height: 300,
		  menubar: false,
		  // themes:"mobile",
		  plugins: [ "image","table"
		  ],
		  document_base_url:"<?php echo base_url() ?>",
 		 table_appearance_options:true,
  table_grid: true,
		  toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | sizeselect fontselect fontsizeselect | numlist bullist outdent indent  | removeformat | image | table | org_name org_address company_city org_email ',
		   table_toolbar: "tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
		   fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",	
  content_style: "p {margin:0;padding:0};h1 h2 h3 {margin:0;padding:0};",
		  file_browser_callback: RoxyFileBrowser,
		  // content_css: [
		  //   '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
		  //   '//www.tinymce.com/css/codepen.min.css'],
		    setup: function (editor) {
		    editor.addButton('org_name', {
		      text: 'Nama OPD',
		      icon: false,
		      onclick: function () {
		        editor.insertContent('{{org_name}}');
		      }
		    });
		    editor.addButton('org_address', {
		      text: 'Alamat OPD',
		      icon: false,
		      onclick: function () {
		        editor.insertContent('{{org_address}}');
			  }
			});
		    editor.addButton('company_city', {
		      text: 'Kota Perusahaan',
		      icon: false,
		      onclick: function () {
		        editor.insertContent('{{company_city}}');
			  }
			});
		    editor.addButton('org_email', {
		      text: 'Email OPD',
		      icon: false,
		      onclick: function () {
		        editor.insertContent('{{org_email}}');
			  }
			});
			}
		});
	})
	function RoxyFileBrowser(field_name, url, type, win) {
	  var roxyFileman = '<?php echo base_url() ?>/fileman/index.html';
	  if (roxyFileman.indexOf("?") < 0) {     
	    roxyFileman += "?type=" + type;   
	  }
	  else {
	    roxyFileman += "&type=" + type;
	  }
	  roxyFileman += '&input=' + field_name + '&value=' + win.document.getElementById(field_name).value;
	  if(tinymce.activeEditor.settings.language){
	    roxyFileman += '&langCode=' + tinymce.activeEditor.settings.language;
	  }
	  tinymce.activeEditor.windowManager.open({
	     file: roxyFileman,
	     title: 'Roxy Fileman',
	     width: 850, 
	     height: 650,
	     resizable: "yes",
	     plugins: "media",
	     inline: "yes",
	     close_previous: "no"  
	  }, {     window: win,     input: field_name    });
	  return false; 
	}
</script>