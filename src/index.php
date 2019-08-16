<?php

namespace MarkHowellsMead\WordPressTheme\CleanOembedParameters;

/**
 * WordPress customisation
 * Modify the oEmbed HTML according to URL host
 *
 * @author Mark Howells-Mead <permanent.tourist@gmail.com>
 */
class Index
{

	public function init()
	{
		add_filter('oembed_result', [ $this, 'cleanEmbedParameters' ], 10, 2);
	}

	public function cleanEmbedParameters($html, $url)
	{
		$host = parse_url($url, PHP_URL_HOST);
		switch ($host) {
			case 'youtube.com':
			case 'www.youtube.com':
			case 'youtu.be':
				$querystring = apply_filters('markhowellsmead_wordpresstheme_wrapyoutubeembeds_querystring', '?feature=oembed&hl=en&amp;fs=1&amp;showinfo=0&amp;rel=0&amp;iv_load_policy=3&amp;hd=1&amp;vq=hd720&amp;version=3&amp;autohide=1&amp;wmode=opaque&amp;cc=1');
				if ('' !== $querystring) {
					$html = str_replace('?feature=oembed', $querystring, $html);
				}
				break;
		}

		return $html;
	}
}
