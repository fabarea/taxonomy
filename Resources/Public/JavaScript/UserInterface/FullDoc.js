Ext.ns("TYPO3.Taxonomy.UserInterface");

/**
 * @class TYPO3.Taxonomy.UserInterface.FullDoc
 * @namespace TYPO3.Taxonomy.UserInterface
 * @extends Ext.Container
 *
 * Class for the main content
 *
 * $Id: FullDoc.js 35001 2010-06-28 13:44:42Z fabien_u $
 */
TYPO3.Taxonomy.UserInterface.FullDoc = Ext.extend(Ext.Container, {

	initComponent: function() {
		
		var config = {
			renderTo: 'typo3-fullDoc',
			plugins: ['TYPO3.Taxonomy.FitToParent'],

//			autoHeight: true,
			// items are set dynamically through method handleNavigationToken() located in every bootstrapper
			// this method is called whenever event TYPO3.Taxonomy.Application.navigate is fired (at least once when application is loaded)

			layout:'border',
			defaults: {
				collapsible: false,
				split: true,
				bodyStyle: 'padding:15px'
			},
			items: [

				/*
				 * WEST PANEL
				 */
				{
					xtype: 'panel',
					region:'west',
					margins: '0',
					padding: '0',
					width: 200,
					items: [{

						xtype: 'panel',
						border: false,
						layout:'border',
						id: 'typo3-pagetree',
						items: [
							{
								//id: 'typo3-pagetree-topPanelItems',
								border: false,
								region: 'north',
								height: 49,
								items: [{
									xtype: 'TYPO3.Taxonomy.UserInterface.TopPanel',
									ref: '../../../topPanel'
								}]
							}, {
								xtype: 'panel',
								id: 'typo3-pagetree-treeContainer',
								region: 'center',
								layout: 'fit',
								items: [{
									xtype: 'TYPO3.Taxonomy.Concept.TreePanel',
									ref: '../../../tree'
								}]
							}
						]
					}]
				},

				/*
				 * CENTER PANEL
				 */
				{
					region:'center',
					margins: '0 0 0 -5',
					padding: '0',
					items: [{
						xtype: 'panel',
						border: false,
						layout:'border',
						cls: 'typo3-fullDoc',
						items: [
							{
								xtype: 'TYPO3.Taxonomy.UserInterface.DocHeader',
								ref: '../../docHeader'
							},
							{
								xtype: 'panel',
								region: 'center',
								id: 'typo3-inner-docbody',
								ref: '../../content',
								layout: 'card',
								activeItem: 0,
								items: [
									{
										xtype: 'TYPO3.Taxonomy.Concept.GridPanel',
										recordType: 'asdf',
										ref: 'grid'
									},
//									{
//										xtype: 'TYPO3.Taxonomy.Concept.GridPanel',
//										recordType: 'qwer',
//										ref: 'conceptGrid2'
//									}
								]
							}
						]
					}
					]
				}
			]
		};


		Ext.apply(this, config);
		TYPO3.Taxonomy.UserInterface.FullDoc.superclass.initComponent.call(this);
	}

});
