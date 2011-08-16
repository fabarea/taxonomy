Ext.ns("TYPO3.Taxonomy.Application");
/**
 * @class TYPO3.Taxonomy.Application.MenuRegistry
 * @namespace TYPO3.Taxonomy.Application
 * @extends Ext.util.Observable
 *
 * The menu registry provides the structure of all menus used in the application.
 * 
 * @singleton
 */
TYPO3.Taxonomy.Application.MenuRegistry = Ext.apply(new Ext.util.Observable(), {

	/**
	 * Contains the menu architecture
	 *
	 */
	items: {},

	/**
	 * @event TYPO3.Taxonomy.UserInterface.RootlineMenu.buttonUnpressed
	 * @param {TYPO3.Taxonomy.UserInterface.RootlineMenu.Button} button the button being released
	 * Called if a button is unpressed.
	 */

	addMenuItems: function(path, items) {
		var menuName = path.shift();
		if (typeof this.items[menuName] == 'undefined') {
			this.items[menuName] = {};
		}
		if (path.length === 0) {
			this.items[menuName] = items;
		}
		else {
			var menuItems = this.items[menuName], t;
			Ext.each(path, function(pathEntry) {
				var found = false;
				Ext.each(menuItems, function(menuItem) {
					if (menuItem.itemId === pathEntry) {
						menuItem.items = menuItem.items || []; // items replaced children
						menuItems = menuItem.items; // items replaced children
						found = true;
					}
				});
				if (!found) {
					t = [];
					menuItems.push({
						itemId: pathEntry,
						items: t // items replaced children
					});
					menuItems = t;
				}
			}, this);

			menuItems.push.apply(menuItems, items);
		}
	}
});