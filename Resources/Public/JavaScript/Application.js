"use strict";

Ext.ns("TYPO3.Taxonomy");

/**
 * @class TYPO3.Taxonomy.Application
 * @namespace TYPO3.Taxonomy
 * @extends Ext.util.Observable
 *
 * The main entry point which controls the lifecycle of the application.
 *
 * This is the main event handler of the application.
 *
 * First, it calls all registered bootstrappers, thus other modules can register event listeners.
 * Afterwards, the bootstrap procedure is started. During bootstrap, it will initialize:
 * <ul><li>QuickTips</li>
 * <li>History Manager</li></ul>
 *
 * @singleton
 *
 * $Id: Application.js 37081 2010-08-21 11:26:34Z fabien_u $
 */

TYPO3.Taxonomy.Application = Ext.apply(new Ext.util.Observable(), {
	/**
	 * @event TYPO3.Taxonomy.Application.afterBootstrap
	 * After bootstrap event. Should be used for main initialization.
	 */

	bootstrappers: [],

	/**
	 * Main bootstrap. This is called by Ext.onReady and calls all registered bootstraps.
	 *
	 * This method is called automatically.
	 */
	bootstrap: function() {
		//this._configureExtJs();
		//this._initializeExtDirect();
		this._registerEventDebugging();
		this._invokeBootstrappers();
//		this._initStateProvider();
		//this._initStateDefaultValue();

		// custom event
		//this._registerEventBeforeLoading();
		//this._registerEventAfterLoading();

		Ext.QuickTips.init();
		
		this.fireEvent('TYPO3.Taxonomy.Application.afterBootstrap');

		// not used so far
		//this._initializeHistoryManager();
	},

	/**
	 * Hides the loading message of the application
	 *
	 */
	_registerEventBeforeLoading: function() {
		this.on(
			'TYPO3.Taxonomy.Application.busy',
			function() {
				Ext.get('loading-mask').setStyle({
					visibility: 'visible',
					top: 0,
					left: 0,
					width: '100%',
					height: '100%',
					opacity: 0.4
				});
				Ext.get('loading').setStyle({
					visibility: 'visible',
					opacity: 1
				});
			},
			this
		)
	},
	/**
	 * Hides the loading message of the application
	 *
	 */
	_registerEventAfterLoading: function() {
		this.on(
			'TYPO3.Taxonomy.Application.afterbusy',
			function() {
				var loading;
				loading = Ext.get('loading');

				//  Hide loading message
				loading.fadeOut({
					duration: 0.2,
					remove: false
				});

				//  Hide loading mask
				Ext.get('loading-mask').shift({
					xy: loading.getXY(),
					width: loading.getWidth(),
					height: loading.getHeight(),
					remove: false,
					duration: 0.35,
					opacity: 0,
					easing: 'easeOut'
				});
			},
			this
		)
	},

	/**
	 * Registers a new bootstrap class.
	 *
	 * Every bootstrap class needs to extend TYPO3.Taxonomy.Application.AbstractBootstrap.
	 * @param {TYPO3.Taxonomy.Application.AbstractBootstrap} bootstrap The bootstrap class to be registered.
	 * @api
	 */
	registerBootstrap: function(bootstrap) {
		this.bootstrappers.push(bootstrap);
	},

	/**
	 * Invoke the registered bootstrappers.
	 *
	 * @access private
	 * @return void
	 */
	_invokeBootstrappers: function() {
		Ext.each(this.bootstrappers, function(bootstrapper) {
			bootstrapper.initialize();
		});
	},

	/**
	 * Initialize History Manager
	 *
	 * @access private
	 * @return void
	 */
	_initializeHistoryManager: function() {
		Ext.History.on('change', function(token) {
			this.fireEvent('TYPO3.Taxonomy.Application.navigate', token);
		}, this);

		// Handle initial token (on page load)
		Ext.History.init(function(history) {
			history.fireEvent('change', history.getToken());
		}, this);

		Ext.History.add(Ext.state.Manager.get('token'));
	},


	/**
	 * Register Event Debugging
	 *
	 * @access private
	 * @return void
	 */
	_registerEventDebugging: function() {
		Ext.util.Observable.capture(
			this,
			function(e) {
				if (window.console && window.console.log) {
//					console.log(e, arguments);
				}
			}
		);
	},

	/**
	 * Initilize state provider
	 *
	 * @access private
	 * @return void
	 */
	_initStateProvider : function() {


		// State configuration based on database
		Ext.state.Manager.setProvider(new TYPO3.state.ExtDirectProvider({
			key: 'moduleData.Taxonomy.States',
			autoRead: false
		}));

		if (Ext.isObject(TYPO3.settings.Taxonomy.States)) {
			Ext.state.Manager.getProvider().initState(TYPO3.settings.Taxonomy.States);
		}

		// State configuration based on cookie
		//Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
	},

	/**
	 * Define state default value
	 *
	 * @access private
	 * @return void
	 */
	_initStateDefaultValue : function() {
		if (!Ext.state.Manager.get('token')) {
			Ext.state.Manager.set('token', 'planner');
		}
	}

});

Ext.onReady(TYPO3.Taxonomy.Application.bootstrap, TYPO3.Taxonomy.Application);
