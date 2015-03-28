<html>
<head>
<meta charset="utf-8">
<?php echo $this->tag->getTitle(); ?> 

         <?php echo $this->tag->stylesheetLink('public/css/bootstrap.min.css'); ?> 

         <?php echo $this->tag->stylesheetLink('public/css/sb-admin.css'); ?> 

         <?php echo $this->tag->stylesheetLink('public/css/plugins/morris.css'); ?> 

<?php echo $this->tag->stylesheetLink('font-awesome-4.1.0/css/font-awesome.min.css'); ?>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

</head>
<body>

  
     <?php echo $this->tag->javascriptInclude('js/jquery-1.11.0.js'); ?> 
     <?php echo $this->tag->javascriptInclude('js/bootstrap.min.js'); ?> 
     <?php echo $this->tag->javascriptInclude('js/plugins/morris/raphael.min.js'); ?> 
     <?php echo $this->tag->javascriptInclude('js/plugins/morris/morris.min.js'); ?> 
     <?php echo $this->tag->javascriptInclude('js/plugins/morris/morris-data.js'); ?>
</body>
</html>