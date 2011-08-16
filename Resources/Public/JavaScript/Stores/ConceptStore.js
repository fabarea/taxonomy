Ext.ns("TYPO3.Taxonomy.Stores");

TYPO3.Taxonomy.Stores.initConceptStore = function() {
	
	var store = new Ext.data.Store({
		data: [
			[
			1,
			"Office Space",
			"Mike Judge",
			"1999-02-19",
			1,
			"Work Sucks",
			"19.95",
			1],[
			3,
			"Super Troopers",
			"Jay Chandrasekhar",
			"2002-02-15",
			1,
			"Altered State Police",
			"14.95",
			1]
			//...more rows of data removed for readability...//
		],
		reader: new Ext.data.ArrayReader({
			id:'id'
			},
			[
				'id',
				'title',
				'director',
				{
					name: 'released',
					type: 'date',
					dateFormat: 'Y-m-d'
				},
				'genre',
				'tagline',
				'price',
				'available'
		])
	});

	return store;
}
