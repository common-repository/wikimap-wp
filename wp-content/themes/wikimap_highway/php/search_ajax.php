<?php
	//editar en caso de querer mostrar un numero distinto de resultados.
	$cuantos = 15;

	require( '../../../../wp-config.php' );
	$s = $_POST["s"];
	$results = $wpdb->get_results("SELECT DISTINCT * FROM $wpdb->posts WHERE  (((post_title LIKE '%".$s."%') OR (post_content LIKE '%".$s."%')) OR (post_title LIKE '%".$s."%') OR (post_content LIKE '%".$s."%')) AND (post_status = \"publish\" OR post_author = 1 AND post_status != 'draft' AND post_status != 'static') AND post_status != \"attachment\" GROUP BY  $wpdb->posts.ID  ORDER BY post_date DESC LIMIT 0, $cuantos");
?>
<div id="ajaxResults">
<ul>
<?php
if (is_array($results)) {
	?>
	<?php foreach ($results as $result) : ?>
		<li><a href="<?=$result->guid?>"><?=$result->post_title?></a></li>
	<?php endforeach;
} else { ?>
<li>No hay resultados</li>
<? } ?>
<li class="more"><a href="<?php bloginfo('home'); ?>?s=<?=$s?>">Buscar Más...</a></li>
</ul>
</div>