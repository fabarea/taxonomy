Ext.ns("TYPO3.Taxonomy.UserInterface");

/**
 * @class TYPO3.Taxonomy.UserInterface.TreeEditor
 * @namespace TYPO3.Taxonomy.UserInterface
 * @extends Ext.tree.TreeEditor
 * @author Fabien Udriot <fabien.udriot@typo3.org>
 *
 * Top Panel
 *
 * $Id: ViewPort.js 35001 2010-06-28 13:44:42Z fabien_u $
 */

// @todo check if the global variable is really needed
var currentSubScript = "";
function fsModules(){this.recentIds=new Array();this.navFrameHighlightedID=new Array();this.currentMainLoaded="";this.currentBank="0";}
var fsMod=new fsModules();

TYPO3.Taxonomy.UserInterface.TreeEditor = Ext.extend(Ext.tree.TreeEditor, {
	/**
	 * Don't send any save events if the value wasn't changed
	 *
	 * @type {Boolean}
	 */
	ignoreNoChange: true,

	/**
	 * Edit delay
	 *
	 * @type {int}
	 */
	editDelay: 250,

	/**
	 * Indicates if an underlying shadow should be shown
	 *
	 * @type {Boolean}
	 */
	shadow: false,

	/**
	 * Listeners
	 *
	 * Handles the synchronization between the edited label and the shown label.
	 */
	listeners: {
		beforecomplete: function(node) {
			this.updatedValue = this.getValue();
			if (this.updatedValue === '') {
				this.cancelEdit();
				return false;
			}
			this.setValue(this.editNode.attributes.prefix + Ext.util.Format.htmlEncode(this.updatedValue) + this.editNode.attributes.suffix);
		},

		complete: {
			fn: function(node, newValue, oldValue) {
				this.saveTitle(node, this.updatedValue, oldValue, this);
			}
		},

		startEdit: {
			fn: function(element, value) {
				this.field.selectText();
			}
		}
	},

	/**
	 * Updates the edit node
	 *
	 * @param {Ext.tree.TreeNode} node
	 * @param {String} editableText
	 * @param {String} updatedNode
	 * @return {void}
	 */
	updateNodeText: function(node, editableText, updatedNode) {
		this.editNode.setText(this.editNode.attributes.prefix + updatedNode + this.editNode.attributes.suffix);
		this.editNode.attributes.editableText = editableText;
	},

	/**
	 * Overridden method to set another editable text than the node text attribute
	 *
	 * @param {Ext.tree.TreeNode} node
	 * @return {Boolean}
	 */
	triggerEdit: function(node) {
		this.completeEdit();
		if (node.attributes.editable !== false) {
			this.editNode = node;
			if (this.tree.autoScroll) {
				Ext.fly(node.ui.getEl()).scrollIntoView(this.tree.body);
			}

			var value = node.text || '';
			if (!Ext.isGecko && Ext.isEmpty(node.text)) {
				node.setText(' ');
			}

				// TYPO3 MODIFICATION to use another attribute
			value = node.attributes.editableText;
			//this.startEdit.defer(this.editDelay, this, [node.ui.textNode, value]);
			//this.startEdit(node.ui.textNode, value);
			this.autoEditTimer = this.startEdit.defer(this.editDelay, this, [node.ui.textNode, value]);
			return false;
		}
	},
	
	/**
	 * @stolen from action.js
	 * 
	 * Reloads the content frame with the current module and node id
	 *
	 * @param {Ext.tree.TreeNode} node
	 * @param {TYPO3.Components.PageTree.Tree} tree
	 * @return {void}
	 */
	singleClick: function(node, tree) {
		tree.currentSelectedNode = node;

		var separator = '?';
		if (currentSubScript.indexOf('?') !== -1) {
			separator = '&';
		}

		node.select();
		if (tree.stateHash) {
			tree.stateHash.lastSelectedNode = node.id;
		}

		fsMod.recentIds['web'] = node.attributes.nodeData.id;

		// @todo check what to do with that
//		TYPO3.Backend.ContentContainer.setUrl(
//			TS.PATH_typo3 + currentSubScript + separator + 'id=' + node.attributes.nodeData.id
//		);
	},

	/**
	 * @stolen from action.js
	 * 
	 * Updates the title of a node
	 *
	 * @param {Ext.tree.TreeNode} node
	 * @param {String} newText
	 * @param {String} oldText
	 * @param {TYPO3.Components.PageTree.TreeEditor} treeEditor
	 * @return {void}
	 */
	saveTitle: function(node, newText, oldText, treeEditor) {
		this.singleClick(node.editNode, node.editNode.ownerTree);
		if (newText === oldText || newText == '') {
			treeEditor.updateNodeText(
				node,
				node.editNode.attributes.nodeData.editableText,
				Ext.util.Format.htmlEncode(oldText)
			);
			return;
		}
		console.log('@todo saveTitle');
		return;
		TYPO3.Taxonomy.ExtDirect.updateLabel(
			node.editNode.attributes.nodeData,
			newText,
			function(response) {
				if (this.evaluateResponse(response)) {
					treeEditor.updateNodeText(node, response.editableText, response.updatedText);
				} else {
					treeEditor.updateNodeText(
						node,
						node.editNode.attributes.nodeData.editableText,
						Ext.util.Format.htmlEncode(oldText)
					);
				}
			},
			this
		);
	}
});

// XTYPE Registration
Ext.reg('TYPO3.Taxonomy.UserInterface.TreeEditor', TYPO3.Taxonomy.UserInterface.TreeEditor);
