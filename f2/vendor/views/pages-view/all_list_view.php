<?php
pg_header();
show_banner('cites_non_cites');
pg_topnavbar();
breadcrumbs();

?>





<div class="container">
        <div class="table-responsive">
            <div class="table-wrapper card">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 style="color:  #FFFFFF">My NOCs (<?php echo auth()['name']?>)</h3>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                </div>
                
                <?php
				
                	show_noc_list($rows, './noc_details.php?id=');
					
                ?>
            </div>
        </div>
    </div>

<?php pg_footer(); ?>