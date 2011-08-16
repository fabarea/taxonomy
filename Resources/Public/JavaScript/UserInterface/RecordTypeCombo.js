Ext.ns("TYPO3.Taxonomy.UserInterface");

/**
 * Button of the rootline menu
 * @class TYPO3.Taxonomy.UserInterface.RecordTypeCombo
 * @extends Ext.RecordTypeCombo
 */
TYPO3.Taxonomy.UserInterface.RecordTypeCombo = Ext.extend(Ext.form.ComboBox, {
	
	/**
	 * Event triggered after initialization of the main area.
	 *
	 * @event TYPO3.Taxonomy.UserInterface.RecordTypeCombo.afterInit
	 *
	 */
	initComponent: function() {
		var config = {
//			store: TYPO3.Devlog.Store.initRecordTypeComboStore(),
//			typeAhead: false,
//			forceSelection: true,
//			triggerAction: 'all',
//			editable: false,
//			selectOnFocus: true,
//			listClass: 'x-combo-list-small',
//			plugins: new TYPO3.Devlog.UserInterface.IconCombo(),
//			width: 'auto',
//			mode: 'local',
//			valueField: 'key',
//			displayField: 'value',
//			iconClsField: 'className'

			id: 'repCombo',
			triggerAction: 'all',
			forceSelection: true,
			editable: false,
			name: 'selectedRecordType',
			hiddenName: 'selectedRecordType',
			displayField: 'title',
			valueField: 'uid',
			store: null,
			width: 250

		};
		
		Ext.apply(this, config);
		TYPO3.Taxonomy.UserInterface.RecordTypeCombo.superclass.initComponent.call(this);
		TYPO3.Taxonomy.Application.fireEvent('TYPO3.Taxonomy.UserInterface.afterInit', this);

//		this.on(
//			'afterrender',
//			this.onafterrender,
//			this
//		);
//
//		this.on(
//			'select',
//			this.onselect,
//			this
//		);
	},

	/**
	 * Defines default value
	 *
	 * @access public
	 * @method onafterrender
	 * @return void
	 */
//	onafterrender: function() {
//
//		this.setValue('1');
//	},

	/**
	 * When object is rendered
	 *
	 * @access public
	 * @method onRender
	 * @return void
	 */
	onRender: function() {

		this.store = new Ext.data.DirectStore({
			storeId: 'repositories',
			idProperty: 'uid',
			directFn: TYPO3.Taxonomy.ExtDirect.getRepositories,
			root: 'data',
			totalProperty: 'length',
			fields : ['title', 'uid'],
			paramsAsHash: true
		});
		
		this.store.load({
			callback: function() {
				if (this.getCount() == 0) {
					TYPO3.Flashmessage.display(TYPO3.Severity.error, TYPO3.lang.msg_error, 'TYPO3.lang.repository_notfound', 15);
				} else {
					//var rec = this.getById(TYPO3.settings.Taxonomy.selectedRecordType);
					TYPO3.settings.Taxonomy.selectedRecordType = 1;
//					if (!rec) {
//						TYPO3.settings.Taxonomy.selectedRecordType = 1;
//						rec = this.getById(TYPO3.settings.Taxonomy.selectedRecordType);
//					}

					TYPO3.Taxonomy.UserInterface.doc.docHeader.recordTypeCombo.setValue(TYPO3.settings.Taxonomy.selectedRecordType);
//					Ext.getCmp('repListInfo').update(TYPO3.EM.Layouts.repositoryInfo().applyTemplate(rec.data));
				}
			}
		});
		TYPO3.Taxonomy.UserInterface.RecordTypeCombo.superclass.onRender.apply(this, arguments);
	},
	
	/**
	 * Defines default value
	 *
	 * @access public
	 * @method onafterrender
	 * @return void
	 */
	onselect: function() {
		TYPO3.Devlog.Store.LogStore.baseParams.pid = this.value
		if (this.value == '') {
			delete TYPO3.Devlog.Store.LogStore.baseParams.pid;
		}
		TYPO3.Devlog.Store.LogStore.load();
	}

});

Ext.reg('TYPO3.Taxonomy.UserInterface.RecordTypeCombo', TYPO3.Taxonomy.UserInterface.RecordTypeCombo);