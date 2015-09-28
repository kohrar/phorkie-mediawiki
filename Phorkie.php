<?php
/**
 * Extension for MediaWiki to include phorkie embeds
 * Copyright (C) 2015 Leo Leung <leo@steamr.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file Phorkie.php
 * @ingroup Extensions
 * @author Leo Leung <leo@steamr.com>
 */

$wgExtensionCredits['phorkie'][] = array(
	'path' => __FILE__,
	'name' => 'Phorkie',
	'author' => 'Leo Leung',
	'url' => 'http://steamr.com',
	'description' => 'Show embedded phorkie code on your wiki.',
	'version' => 0.1
);

$wgHooks['ParserFirstCallInit'][] = 'leol_parserPhorkie';

/**
 * Adds the <phorkie></phorkie> tag to the parser.
 *
 * @param Parser $parser Parser object
 * @return bool true
 */
function leol_parserPhorkie( Parser $parser ) {
	$parser->setHook('phorkie', 'leol_phorkieRender');
	return true;
}

/**
 * Parses $input (phorkie url) and embeds code.
 *
 * @param string $input Contents of tag
 * @param array $args Attributes to the tag
 * @param Parser $parser Parser object
 * @param PPFrame $frame Current parser grame
 */
function leol_phorkieRender( $input, array $args, Parser $parser, PPFrame $frame ) {
	$parts = explode("/", $input);
	$id = $parts[count($parts)-2];

	if ($parts[count($parts)-1] == "embed" && ctype_xdigit($id) ) {
		return '<script src="'.$input.'" id="phork-script-'.$id.'" type="text/javascript"></script>';
	} else {
		return 'Invalid phorkie URL';
	}
}

