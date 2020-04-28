<?php
/**
 * Template Name: Style Guide
 *
 * @package Custom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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

<div class="g-row style-guide">
	<div class="wysiwyg-content">
		<h2 class="style-guide__heading">Colors</h2>

		<div class="style-guide__colors-container">
			<div class="style-guide__colors-group">
				<h3>Primary</h3>
				<ul class="style-guide__colors">
					<li class="style-guide__color style-guide__color--primary">Primary</li>
					<li class="style-guide__color style-guide__color--secondary">Secondary</li>
					<li class="style-guide__color style-guide__color--tertiary">Tertiary</li>
				</ul>
			</div>

			<div class="style-guide__colors-group">
				<h3>Theme</h3>
				<ul class="style-guide__colors">
					<li class="style-guide__color style-guide__color--theme-white style-guide__color--border style-guide__color--color-black">Theme White</li>
					<li class="style-guide__color style-guide__color--theme-black">Theme Black</li>
					<li class="style-guide__color style-guide__color--theme-gray">Theme Gray</li>
				</ul>
			</div>

			<div class="style-guide__colors-group">
				<h3>Alert</h3>
				<ul class="style-guide__colors">
					<li class="style-guide__color style-guide__color--error">Error</li>
					<li class="style-guide__color style-guide__color--warning">Warning</li>
					<li class="style-guide__color style-guide__color--success">Success</li>
				</ul>
			</div>
		</div>

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
		<p><button disabled>Button - &lt;button disabled&gt;</button></p>

		<h2 class="style-guide__heading">Text</h2>
		<h1>Heading - h1</h1>
		<p>He is here... Obi-Wan Kenobi! What makes you think so? A tremor in the Force. The last time I felt it was in the presence of my old master. Surely he must be dead by now. Don't underestimate the power of the Force. The Jedi are extinct, their fire has gone out of the universe. You, my friend, are all that's left of their religion. Yes. Governor Tarkin, we have an emergency alert in detention block A A-twenty-three. The princess! Put all sections on alert!</p>

		<h2>Heading - h2</h2>
		<p>Where could they be? Close the blast doors! Open the blast doors! Open the blast doors! I've been waiting for you, Obi-Wan. We meet again, at last. The circle is now complete. When I left you, I was but the learner, now I am the master. Only a master of evil, Darth. Your powers are weak, old man. You can't win, Darth. If you strike me down, I shall become more powerful than you can possibly imagine.</p>

		<h3>Heading - h3</h3>
		<p>Did you find any droids? No, sir. If there were any on board, they must also have jettisoned. Send a scanning crew on board. I want every part of this ship checked. Yes, sir. I sense something...a presence I haven't felt since... Get me a scanning crew in here on the double.</p>

		<h4>Heading - h4</h4>
		<p>The ship's all yours. If the scanners pick up anything, report it immediately. All right, let's go. Hey down there, could you give us a hand with this? TX-four-one-two. Why aren't you at your post? TX-four-one-two, do you copy?</p>

		<h5>Heading - h5</h5>
		<p>Take over. We've got a bad transmitter. I'll see what I can do. You know, between his howling and your blasting everything in sight, it's a wonder the whole station doesn't know we're here. Bring them on!</p>

		<h6>Heading - h6</h6>
		<p>I prefer a straight fight to all this sneaking around. We found the computer outlet, sir. Plug in. He should be able to interpret the entire Imperial computer network.</p>

		<p><b>Text - Bold - &lt;b&gt;</b></p>
		<p><strong>Text - Bold - &lt;strong&gt;</strong> - SEO</p>
		<p><em>Text - Italicized - &lt;em&gt;</em> - SEO</p>
		<p><s>Text - Strike - &lt;s&gt;</s></p>
		<p><span style="text-decoration: underline;">Text - Underlined</span></p>
		<p>Text - <a href="#" target="_blank" rel="noopener noreferrer" title="Example">Hyperlink</a></p>
		<blockquote>
			"Text - Blockquote" - Author
			<cite>Cite</cite>
		</blockquote>

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

			<tfoot>
				<tr>
					<th>Name</th>
					<th>Side</th>
					<th>Role</th>
				</tr>
			</tfoot>
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
					<label for="label-radio">Label - Radio Checked</label>
				</div>

				<div class="form__group">
					<input type="radio" name="label-radio" id="label-radio-1" value="label-radio-1">
					<label for="label-radio-1">Label - Radio 1</label>
				</div>
			</div>

			<div class="form__section">
				<div class="form__group">
					<input type="radio" name="custom-radio" id="custom-radio" class="h-visual-hide input-custom-radio" value="custom-radio" checked>
					<label for="custom-radio" class="label-custom-radio">Label - Custom Radio Checked</label>
				</div>

				<div class="form__group">
					<input type="radio" name="custom-radio" id="custom-radio-1" class="h-visual-hide input-custom-radio" value="custom-radio-1">
					<label for="custom-radio-1" class="label-custom-radio">Label - Custom Radio 1</label>
				</div>
			</div>

			<fieldset class="form__section form__checkbox">
				<legend>Legend - Description of Checkbox Options</legend>
				<div class="form__group">
					<input type="checkbox" name="label-checkbox" id="label-checkbox" checked>
					<label for="label-checkbox">Label - Checkbox Checked</label>
				</div>

				<div class="form__group">
					<input type="checkbox" name="label-checkbox" id="label-checkbox-1">
					<label for="label-checkbox-1">Label - Checkbox 1</label>
				</div>
			</fieldset>

			<fieldset class="form__section">
				<legend>Custom Checkbox</legend>
				<div class="form__group">
					<input type="checkbox" name="custom-checkbox" id="custom-checkbox" class="h-visual-hide input-custom-checkbox" checked>
					<label for="custom-checkbox" class="label-custom-checkbox">Custom Checkbox Checked</label>
				</div>

				<div class="form__group">
					<input type="checkbox" name="custom-checkbox" id="custom-checkbox-1" class="h-visual-hide input-custom-checkbox">
					<label for="custom-checkbox-1" class="label-custom-checkbox">Custom Checkbox 1</label>
				</div>
			</fieldset>

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

		<h2 class="style-guide__heading">Accordion</h2>
		<div class="faqs">
			<details class="faqs__question">
				<summary class="faqs__title">Question Title 1</summary>
				<div class="faqs__content">Are they away? They have just made the jump into hyperspace. You're sure the homing beacon is secure aboard their ship? I'm taking an awful risk, Vader. This had better work.</div>
			</details>

			<details class="faqs__question">
				<summary class="faqs__title">Question Title 2</summary>
				<div class="faqs__content">Are they away? They have just made the jump into hyperspace. You're sure the homing beacon is secure aboard their ship? I'm taking an awful risk, Vader. This had better work.</div>
			</details>
		</div>

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
