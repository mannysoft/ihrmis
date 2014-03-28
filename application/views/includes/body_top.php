<div class="no_float"></div></div></div>
<div class="layout_colum_container">
<div id="menu" class="layout_colum_left">
</div>
<div id="content" class="layout_colum_right">
<div class="area_block">
<!--<h1 id="main_area_title" class="main_title_configuration">Configuration</h1>-->
<ul class="navigation"><br /><li>
<h2><?php echo $page_name; ?></h2>
</li>
</ul>
</div>
<div class="std_block">

<!--If bootstrap-->
<?php if($this->config->item('twitter_bootstrap_css')):?>
    <!--This is for massaging-->
    <?php if(isset($errors) and count($errors) >= 1):?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error):?>
                <div class="error"><?php echo $error; ?></div>
            <?php endforeach;?>
        </div>
    <?php endif;?>
    
    <?php if(Session::flashData('msg')):?>
        <div class="alert alert-success">
            <?php echo Session::flashData('msg');?>
        </div>
    <?php endif;?>

<!--If not bootstrap-->   
<?php else: ?>
    
    
	<?php if(isset($errors) and count($errors) >= 1):?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error):?>
                <div class="error"><?php echo $error; ?></div>
            <?php endforeach;?>
        </div>
    <?php endif;?>
	
	<?php if (validation_errors()): ?>
    	<div class="clean-red"><?php echo validation_errors(); ?><?php echo Session::flashData('msg');?></div>
    <?php elseif (Session::flashData('msg')): ?>
    	<div class="clean-green"><?php echo validation_errors(); ?><?php echo Session::flashData('msg');?></div>
    <?php else: ?>
    <?php endif; ?>
    
    
<?php endif;?>