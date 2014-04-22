<?php if(ci_show_hero()): ?>
	<section id="hero">
		<hgroup>
			<h1><?php echo strip_tags(utf8_encode(html_entity_decode(ci_setting('hero_title'))), '<span>'); ?></h1>
			<h2><?php echo strip_tags(utf8_encode(html_entity_decode(ci_setting('hero_description'))), '<span>'); ?></h2>
		</hgroup>
	</section>	
<?php endif; ?>
