<?php get_header();?>
    
        
    
	    <section class="sc-header-sub">
	       
	        <div class="containerCentered">
	            <div class="row">
	<h1 id="changingtext">404 - <?php wp_title("", true); ?></h1>
	        </div>
	    </section>
	


	 <div class="container box">
<div class="row">
  <div class="col-md-12">
    <?php _e('Sorry, but the page you are looking for has moved or no longer exists. Please use the search below.','scribe'); ?>
    <br/>
    <br/>
    <br/>
    <div class="col-md-4">
      <?php get_search_form();?>
      <br/>
      <br/>
    </div>
  </div>
</div>
<?php get_footer();?>
