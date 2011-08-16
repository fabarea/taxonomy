Ext.ns("TYPO3.Taxonomy.UserInterface");

/**
 * @class TYPO3.Taxonomy.UserInterface.ConfirmWindow
 * @namespace TYPO3.Taxonomy.UserInterface
 * @extends Ext.Container
 *
 * Class for the main content
 *
 * $Id: ConfirmWindow.js 35001 2010-06-28 13:44:42Z fabien_u $
 */
TYPO3.Taxonomy.UserInterface.ConfirmWindow = Ext.extend(Ext.Window, {

	width: 600,
	height: 600,

	title: '',
	confirmText: '',
	confirmQuestion: '',
	records: [],
	hideRecursive: false,
	showRecursiveCheckbox: false,
	arePagesAffected: false,
	command: '',
//	template: new Ext.XTemplate(
//			'<ul class="recycler-table-list">',
//			'<tpl for=".">',
//				'<li>{[values]}</li>',
//			'</tpl>',
//			'</ul>'
//	),

	initComponent: function() {
		var config = {
			xtype: 'form',
			bodyCssClass: 'recycler-messagebox',
			modal: true,

			items: [
				{
					xtype: 'label',
					text: this.confirmText
//				}, {
//					xtype: 'displayfield',
//					tpl:  this.template,
//					data: this.tables
				}, {
					xtype: 'label',
					text:  this.confirmQuestion
				}, {
					xtype: 'panel',
					html: [
						'<iframe frameborder="0" src="/typo3/alt_doc.php?edit[tt_content][210]=edit" name="content" style="float: left; width: 1419px; height: 600px; " id="ext-gen58" class=" x-panel-body-noheader x-panel-body-noborder">',
						'</iframe>'
					]
//				}, {
//					xtype: 'checkbox',
//					boxLabel: TYPO3.lang.boxLabel_undelete_recursive,
//					name: 'recursiveCheckbox',
//					disabled: !this.showRecursiveCheckbox,
//					itemId: 'recursiveCheck',
//					hidden: this.hideRecursive // hide the checkbox when frm is used to permanently delete
				}
			],
		};


		Ext.apply(this, config);
		TYPO3.Taxonomy.UserInterface.ConfirmWindow.superclass.initComponent.call(this);
	}

});
