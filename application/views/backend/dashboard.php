<?php
echo ajax_load('admain/allkategori');
?>

<script>

$(document).ready(function() {

	$('#result').scrollPagination({

		nop     : 3, // The number of posts per scroll to be loaded
		offset  : 0, // Initial offset, begins at 0 in this case
		error   : 'No More Posts!', // When the user reaches the end this is the message that is
		                            // displayed. You can change this if you want.
		delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
		               // This is mainly for usability concerns. You can alter this as you see fit
		scroll  : true // The main bit, if set to false posts will not load as the user scrolls. 
		               // but will still load if the user clicks.
		
	});
	
});
</script>


<div class="col-md-12">
    
    <div class="box primary">
        <header>
            <div class="icons"><i class="icon-building"></i></div>
            <h5>Uraian Semua Kegiatan</h5>
            <div class="toolbar">
                <button class="btn btn-success btn-sm btn-rect" data-toggle="collapse" data-target="#result"><i class="icon-chevron-up"></i></button>
            </div>
        </header>
                
        <div class="body in" id="result">
        	<?php //echo load_data_kategori()?>        
        </div>
    </div>
    
    <?php //echo $rowcount['rowcount']?>
    
</div>



