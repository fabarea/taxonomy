Ext.ns("TYPO3.Taxonomy.UserInterface");

/**
 * @class TYPO3.Taxonomy.UserInterface.DocHeader
 * @namespace TYPO3.Taxonomy.UserInterface
 * @extends Ext.Container
 *
 * Class for the main content
 *
 * $Id: DocHeader.js 35001 2010-06-28 13:44:42Z fabien_u $
 */
TYPO3.Taxonomy.UserInterface.DocHeader = Ext.extend(Ext.Panel, {

	initComponent: function() {
	
		var config = {
			id: 'typo3-docheader',
			border: false,
			region: 'north',
			height: 49,
				items: [
				{
					xtype: 'panel',
					id: 'typo3-docheader-row1',
					items: [
						{
							xtype: 'panel',
							cls: 'buttonsleft'
						},
						{
							xtype: 'panel',
							cls: 'buttonsright',
							html: '<a href="#" onclick="top.ShortcutManager.createShortcut(String.fromCharCode(67,114,101,97,116,101,32,97,32,98,111,111,107,109,97,114,107,32,116,111,32,116,104,105,115,32,112,97,103,101), \'\', \'user_TaxonomyAdmin\', \'%2Ftypo3%2Fmod.php%3F%26id%3D%26M%3Duser_TaxonomyAdmin%26tx_taxonomy_user_taxonomyadmin%3D\');return false;" title="Create a bookmark to this page"><span class="t3-icon t3-icon-actions t3-icon-actions-system t3-icon-system-shortcut-new">&nbsp;</span></a>'
						}
					]
				},
				{
					xtype: 'panel',
					id: 'typo3-docheader-row2',
					items: [
						{
							xtype: 'panel',
							cls: 'docheader-row2-left'
						},
						{
							xtype: 'panel',
							cls: 'docheader-row2-right',
							items: [{
								xtype: 'TYPO3.Taxonomy.UserInterface.RecordTypeCombo',
								ref: '../../recordTypeCombo'
							}]
						}
					]
				}
			]
		}

		Ext.apply(this, config);
		TYPO3.Taxonomy.UserInterface.DocHeader.superclass.initComponent.call(this);
	}

});

// XTYPE Registration
Ext.reg('TYPO3.Taxonomy.UserInterface.DocHeader', TYPO3.Taxonomy.UserInterface.DocHeader);