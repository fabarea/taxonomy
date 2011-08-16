<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Fabien Udriot <fabien.udriot@typo3.org>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * View helper for rendering open new icon
 *
 * = Examples =
 */
class Tx_Taxonomy_ViewHelpers_OpenNewWindowViewHelper extends Tx_Fluid_Core_ViewHelper_TagBasedViewHelper {

	/**
	 * @var string
	 */
	protected $tagName = 'openNewWindow';

	/**
	 * This method prepares the link for opening the devlog in a new window
	 *
	 * @return	string	Hyperlink with icon and appropriate JavaScript
	 */
	public function render() {
		
		global $BACK_PATH;

		$url = t3lib_div::getIndpEnv('TYPO3_REQUEST_SCRIPT');
		$url .= '?M=user_TaxonomyAdmin'; // improve this ;)

		$onClick = "devlogWin=window.open('" . $url . "','taxonomy','width=790,status=0,menubar=1,resizable=1,location=0,scrollbars=1,toolbar=0');devlogWin.focus();return false;";
		$content = '<a id="openview" href="#" onclick="' . htmlspecialchars($onClick).'">' .
					'<img' . t3lib_iconWorks::skinImg($BACK_PATH,'gfx/open_in_new_window.gif', 'width="19" height="14"') . ' title="' . $GLOBALS['LANG']->sL('LLL:EXT:lang/locallang_core.php:labels.openInNewWindow', 1) . '" class="absmiddle" alt="" />' .
					'</a>';
		return $content;
	}

}

?>