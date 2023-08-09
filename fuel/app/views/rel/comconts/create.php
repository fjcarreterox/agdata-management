<h2>Nueva <span class='muted'>relación de servicios</span> entre la C.PP <strong><?php echo $cname;?></strong> y empresa contrata</h2>
<br>
<?php
$data['idc']=$idc;
echo render('rel/comconts/_form',$data); ?>
<p><?php echo Html::anchor('clientes/view_panel/', 'Volver'); ?></p>
