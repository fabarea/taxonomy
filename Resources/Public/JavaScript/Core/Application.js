"use strict";

Ext.ns("TYPO3.Taxonomy.Core");

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
define(['Taxonomy/Core/Registry'], function(Registry) {
	
	/**
	 * @class TYPO3.Taxonomy.Core.Application
	 *
	 * The main entry point which controls the lifecycle of the application.
	 *
	 * This is the main event handler of the application.
	 *
	 * @namespace TYPO3.Taxonomy.Core
	 * @extends Ext.util.Observable
	 * @singleton
	 */
	TYPO3.Taxonomy.Application = Ext.apply(new Ext.util.Observable(), {
		
		/**
		 * @event afterBootstrap After bootstrap event. Should
		 * be used for main initialization
		 */

		/**
		 * List of all modules which have been registered
		 * @private
		 */
		_modules: [],

		/**
		 * Register modules. This method is called by the Application.
		 * 
		 * @param {object} the module to be register
		 * @return void
		 */
		registerModule: function(module) {
			this._modules.push(module);
		},

		/**
		 * Run the application. This is called by RequireJS.
		 *
		 * This method is called automatically.
		 */
		run: function() {

			Registry.initialize();

			for (var i in this._modules) {
				this._modules[i].configure();
			}
			Registry.compile();

			Ext.QuickTips.init();
			
			if (console.log) {
				console.log("Running Application");
			}
			
			this.fireEvent('TYPO3.Taxonomy.Application.afterBootstrap');
			
			// @todo: re-vive these methods
//			this._initStateProvider();
//			this._initializeHistoryManager();
		},
		
		/**
		 * Initialize History Manager
		 *
		 * @access private
		 * @return void
		 */
//		_initializeHistoryManager: function() {
//			Ext.History.on('change', function(token) {
//				this.fireEvent('TYPO3.Taxonomy.Application.navigate', token);
//			}, this);
//
//			// Handle initial token (on page load)
//			Ext.History.init(function(history) {
//				history.fireEvent('change', history.getToken());
//			}, this);
//
//			Ext.History.add(Ext.state.Manager.get('token'));
//		},

		/**
		 * Initilize state provider
		 *
		 * @access private
		 * @return void
		 */
//		_initStateProvider : function() {
//
//
//			// State configuration based on database
//			Ext.state.Manager.setProvider(new TYPO3.state.ExtDirectProvider({
//				key: 'moduleData.Taxonomy.States',
//				autoRead: false
//			}));
//
//			if (Ext.isObject(TYPO3.settings.Taxonomy.States)) {
//				Ext.state.Manager.getProvider().initState(TYPO3.settings.Taxonomy.States);
//			}
//			
//			// State configuration based on cookie
//			//Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
//		},

//		/**
//		 * Define state default value
//		 *
//		 * @access private
//		 * @return void
//		 */
//		_initStateDefaultValue : function() {
//			if (!Ext.state.Manager.get('token')) {
//				Ext.state.Manager.set('token', 'planner');
//			}
//		}

	});
	return TYPO3.Taxonomy.Application;
});


//Ext.onReady(TYPO3.Taxonomy.Application.bootstrap, TYPO3.Taxonomy.Application);