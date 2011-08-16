"use strict";

Ext.ns('TYPO3.Taxonomy');

/**
 * @class TYPO3.Taxonomy.Utility
 * @namespace TYPO3.Taxonomy
 *
 * Utility class
 *
 * @singleton
 *
 * $Id: Utility.js 36907 2010-08-17 18:37:09Z fabien_u $
 */
TYPO3.Taxonomy.Utility = {};

/**
 * Clone Function
 *
 * @param {Object/Array} o Object or array to clone
 * @return {Object/Array} Deep clone of an object or an array
 */
TYPO3.Taxonomy.Utility.clone = function(o) {
	if (!o || 'object' !== typeof o) {
		return o;
	}
	if ('function' === typeof o.clone) {
		return o.clone();
	}
	var c,p,v;
	c = '[object Array]' === Object.prototype.toString.call(o) ? [] : {};
	for (p in o) {
		if (o.hasOwnProperty(p)) {
			v = o[p];
			if (v && 'object' === typeof v) {
				c[p] = TYPO3.Taxonomy.Utility.clone(v);
			} else {
				c[p] = v;
			}
		}
	}
	return c;
};
