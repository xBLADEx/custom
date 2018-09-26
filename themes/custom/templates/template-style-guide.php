<?php
/**
 * Template Name: Style Guide
 *
 * @package Custom
 */

get_header();
custom_display_hero_content();
?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
		<div id="page-<?php the_ID(); ?>" <?php post_class( 'wysiwyg-content' ); ?>>
			<?php the_content(); ?>
		</div>
		<?php
	endwhile;
endif;
?>

<div class="g-l-row style-guide">
	<div class="wysiwyg-content">
		<h2 class="style-guide__heading">Headings</h2>
		<h1>Heading - h1</h1>
		<h2>Heading - h2</h2>
		<h3>Heading - h3</h3>
		<h4>Heading - h4</h4>
		<h5>Heading - h5</h5>
		<h6>Heading - h6</h6>

		<h2 class="style-guide__heading">Buttons</h2>
		<p><a class="button" href="#">Button - &lt;a&gt; .button</a></p>
		<p><button class="button">Button - &lt;button&gt; .button</button></p>
		<p><button class="button button--secondary">Button - &lt;button&gt; .button .button--secondary</button></p>
		<p><button class="button button--hollow">Button - &lt;button&gt; .button .button--hollow</button></p>
		<p><button class="button button--full-width">Button - &lt;button&gt; .button .button--full-width</button></p>
		<p><button>Button - &lt;button&gt;</button></p>

		<h2 class="style-guide__heading">Text</h2>
		<h1>Heading - h1</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tu vero, inquam, ducas licet, si sequetur; Haec et tu ita posuisti, et verba vestra sunt. Atque his de rebus et splendida est eorum et illustris oratio. Eam stabilem appellas. Nam Pyrrho, Aristo, Erillus iam diu abiecti. Illa sunt similia: hebes acies est cuipiam oculorum, corpore alius senescit; Est enim effectrix multarum et magnarum voluptatum. Duo Reges: constructio interrete.</p>

		<h2>Heading - h2</h2>
		<p>Ita multo sanguine profuso in laetitia et in victoria est mortuus. Quae duo sunt, unum facit. Expectoque quid ad id, quod quaerebam, respondeas. At ille pellit, qui permulcet sensum voluptate. Illud dico, ea, quae dicat, praeclare inter se cohaerere. Stoici autem, quod finem bonorum in una virtute ponunt, similes sunt illorum;</p>

		<h3>Heading - h3</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non enim, si omnia non sequebatur, idcirco non erat ortus illinc. Quae quo sunt excelsiores, eo dant clariora indicia naturae. Si qua in iis corrigere voluit, deteriora fecit. Videsne quam sit magna dissensio?</p>

		<h4>Heading - h4</h4>
		<p>Sed tu istuc dixti bene Latine, parum plane. Obsecro, inquit, Torquate, haec dicit Epicurus? Prioris generis est docilitas, memoria; Duo Reges: constructio interrete. Sed virtutem ipsam inchoavit, nihil amplius. Terram, mihi crede, ea lanx et maria deprimet. Isto modo ne improbos quidem, si essent boni viri.</p>

		<h5>Heading - h5</h5>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nummus in Croesi divitiis obscuratur, pars est tamen divitiarum. Optime, inquam. Utinam quidem dicerent alium alio beatiorem! Iam ruinas videres. Illa tamen simplicia, vestra versuta. Duo Reges: constructio interrete. Quod cum dixissent, ille contra.</p>

		<h6>Heading - h6</h6>
		<p>Quem Tiberina descensio festo illo die tanto gaudio affecit, quanto L. Hoc enim constituto in philosophia constituta sunt omnia. Ita enim vivunt quidam, ut eorum vita refellatur oratio. Dic in quovis conventu te omnia facere, ne doleas. Ita multo sanguine profuso in laetitia et in victoria est mortuus.</p>

		<p><strong>Text - Bold - &lt;strong&gt;</strong></p>
		<p><b>Text - Bold - &lt;b&gt;</b></p>
		<p><em>Text - Italicized - &lt;em&gt;</em></p>
		<p><del>Text - Strike - &lt;del&gt;</del></p>
		<p><span style="text-decoration: underline;">Text - Underlined</span></p>
		<p>Text - <a href="#" target="_blank" rel="noopener noreferrer" title="Example">Hyperlink</a></p>
		<p><blockquote>"Text - Blockquote" - Author</blockquote></p>

		<h2 class="style-guide__heading">Lists</h2>
		<strong>Un-ordered List</strong>
		<ul>
			<li>List item 1</li>
			<li>List item 2</li>
			<li>List item 3</li>
		</ul>

		<strong>Ordered List</strong>
		<ol>
			<li>List item 1</li>
			<li>List item 2</li>
			<li>List item 3</li>
		</ol>

		<h2 class="style-guide__heading">Table</h2>
		<table>
			<caption>Star Wars Table Caption</caption>
			<thead>
				<tr>
					<th>Name</th>
					<th>Side</th>
					<th>Role</th>
				</tr>
			</thead>

			<tfoot>
				<tr>
					<th>Name</th>
					<th>Side</th>
					<th>Role</th>
				</tr>
			</tfoot>

			<tbody>
				<tr>
					<td>Darth Vader</td>
					<td>Dark</td>
					<td>Sith</td>
				</tr>

				<tr>
					<td>Obi Wan Kenobi</td>
					<td>Light</td>
					<td>Jedi</td>
				</tr>

				<tr>
					<td>Greedo</td>
					<td>South</td>
					<td>Scumbag</td>
				</tr>
			</tbody>
		</table>

		<h2 class="style-guide__heading">Form</h2>
		<form action="#" method="post" class="form">
			<div class="form__section">
				<label for="label-text">Label - Text</label>
				<input type="text" name="label-text" id="label-text" placeholder="Placeholder" value="">
			</div>

			<div class="form__section form__radio">
				<div class="form__group">
					<input type="radio" name="label-radio" id="label-radio" value="label-radio" checked>
					<label for="label-radio">Label - Radio</label>
				</div>

				<div class="form__group">
					<input type="radio" name="label-radio" id="label-radio-1" value="label-radio-1">
					<label for="label-radio-1">Label - Radio 1</label>
				</div>
			</div>

			<div class="form__section form__checkbox">
				<div class="form__group">
					<input type="checkbox" name="label-checkbox" id="label-checkbox" checked>
					<label for="label-checkbox">Label - Checkbox</label>
				</div>

				<div class="form__group">
					<input type="checkbox" name="label-checkbox" id="label-checkbox-1">
					<label for="label-checkbox-1">Label - Checkbox 1</label>
				</div>
			</div>

			<div class="form__section">
				<label for="label-select">Label - Select</label>
				<select name="label-select" id="label-select">
					<option value="Select 1">Select 1</option>
					<option value="Select 2">Select 2</option>
					<option value="Select 3">Select 3</option>
				</select>
			</div>

			<div class="form__section">
				<label for="label-textarea">Label - Textarea</label>
				<textarea name="label-textarea" id="label-textarea" placeholder="Textarea"></textarea>
			</div>

			<input type="submit" class="button" value="Submit">
		</form>

		<h2 class="style-guide__heading">Images</h2>
		<p><strong>Thumbnail (150x150)</strong></p>
		<p><img src="https://unsplash.it/150/150/?random" alt="" width="150" height="150"></p>

		<p><strong>Mobile (425x425)</strong></p>
		<p><img src="https://unsplash.it/425/425/?random" alt="" width="425" height="425"></p>

		<p><strong>Tablet (768x425)</strong></p>
		<p><img src="https://unsplash.it/768/425/?random" alt="" width="768" height="425"></p>

		<p><strong>Laptop (1024x768)</strong></p>
		<p><img src="https://unsplash.it/1024/768/?random" alt="" width="1024" height="768"></p>

		<p><strong>Desktop (1920x1080)</strong></p>
		<p><img src="https://unsplash.it/1920/1080/?random" alt="" width="1920" height="1080"></p>

		<h2 class="style-guide__heading">Video</h2>
		<iframe width="100%" height="500" src="https://www.youtube.com/embed/0evjtlI5QDY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	</div>

	<div>
		<h2 class="style-guide__heading">Social Media</h2>
		<?php custom_display_social_icons(); ?>

		<h2 class="style-guide__heading">Search</h2>
		<?php get_template_part( 'components/form-search' ); ?>
	</div>
</div>

<?php get_footer(); ?>
