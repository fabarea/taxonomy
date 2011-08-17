"use strict";

Ext.ns("TYPO3.Taxonomy.Module.Content");
	
/*                                                                        *
 * This script is part of the TYPO3 project.                              *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License as published by the Free   *
 * Software Foundation, either version 3 of the License, or (at your      *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        *
 * You should have received a copy of the GNU General Public License      *
 * along with the script.                                                 *
 * If not, see http://www.gnu.org/licenses/gpl.html                       *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

var dependencies;
dependencies = ['Taxonomy/Core/Application', 'Taxonomy/Module/Content/ContentGrid', 'Taxonomy/Module/Content/ContentSearch', 'Taxonomy/Components/SearchBar']
define(dependencies, function(Application) {

	/**
	 * @class TYPO3.Taxonomy.Module.Content.ContentView
	 * 
	 * The outermost user interface component.
	 * 
	 * @namespace TYPO3.Taxonomy.Module.Content
	 * @extends Ext.Panel
	 */
	return Ext.define('TYPO3.Taxonomy.Module.Content.ContentView', {
		
		/**
		 * The Component being extended
		 *
		 * @cfg {String}
		 */
		extend: 'Ext.panel.Panel',
		
		/**
		 * The store 
		 *
		 * @type {Object}
		 */
		alias: 'widget.TYPO3.Taxonomy.Module.Content.ContentView',

		/**
		 * Initializer
		 */
		initComponent: function() {

			var config = {
				layout: 'border',
				defaults: {
					collapsible: true,
					split: true,
					bodyStyle: 'padding:15px',
					bodyPadding: 0,
					margins: 0,
					padding: 0
				},
				items: [{
					/*
					 * LEFT PANEL
					 */
					xtype: 'panel',
					region:'west',
					width: 200,
					items: [{
						xtype: 'container',
						html: 'dummy text'
					}]

				}, {
				
//					/*
//					 * RIGHT PANEL
//					 */
//					xtype: 'panel',
//					region:'east',
//					collapsed: true,
//					width: 200,
//					items: [{
//						xtype: 'container',
//						html: 'dummy text'
//					}]
//				}, {
                    xtype: 'panel',
					region: 'center',
					collapsible: false,
					html: 'coucou'
                 }]
			}
		
			Ext.apply(this, config);
			TYPO3.Taxonomy.Module.Content.ContentView.superclass.initComponent.call(this);
		}
	});
});
