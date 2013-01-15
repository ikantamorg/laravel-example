var FilterAppConstructor = function ($table, $controls, blackListedFields) {

	var validEqs = [];
	var validHeaders = [];
	var findValidHeadersAndEqs = function () {
		if(validEqs.length > 0) return;

		var $ths = $table.find('th');
		_.chain($ths).each(function (th, i) {
			if(blackListedFields.indexOf($(th).text()) === -1) {
				validEqs.push(i);
				validHeaders[i] = $(th).text().toLowerCase();
			}
		});
	};
	
	var getValidEqs = function () {
		findValidHeadersAndEqs();
		return validEqs;
	};
	var getValidHeaders = function () {
		findValidHeadersAndEqs();
		return validHeaders;
	};


	var makeRowDataObject = function ($row)
	{
		var dataObj = {
			$row: $row
		};

		_.chain($row.find('td')).each(function (td, i) {

			if(getValidEqs().indexOf(i) === -1)
				return;
			
			dataObj[getValidHeaders()[i]] = $(td).text();
		});

		return dataObj;
	}

	var tableData = [];
	var getTableData = function () {
		if(tableData.length > 0) return tableData;

		_.chain($table.find('tbody>tr')).each(function (tr, i) {
			tableData.push(makeRowDataObject($(tr)));
		});

		return tableData;
	};

	/////////////////////

	var $filter = $controls.find('.filter');
	var $searchBox = $controls.find('.search');
	var $goBtn = $controls.find('.go-btn');
	var $restoreBtn = $controls.find('.restore-btn');

	/////////////////////

	var populateFilterOptions = function () {
		$filter.append($('<option>', { value: 'all', html: 'All' }));
		_.chain(getValidHeaders()).each(function (header) {
			$filter.append($('<option>', { value: header, html: header }));
		});
	};

	/////////////////////

	var getTargetHeader = function () {
		return $filter.find('option:selected').val();
	};

	var getTargetEq = function () {
		var targetEq = -1;
		_.chain(getValidHeaders()).each(function (header, i) {
			if(targetEq !== -1) return;

			if(header === getTargetHeader())
				targetEq = i;
		});
		return targetEq;
	}

	///////////////////////////////

	var filterTable = function () {
		var searchExpr = $searchBox.val(),
			targetEq = getTargetEq(),
			targetHeader = getTargetHeader(),
			searchRegExp = new RegExp(searchExpr, 'i')
		;

		_.chain(getTableData()).each(function (rowData) {
			if(targetEq === -1)
				checkFullRow(rowData, searchRegExp)
			else
				checkRow(rowData, targetHeader, searchRegExp);
		});
	};

	var checkRow = function (rowData, header, searchRegExp) {
		var $tr = rowData.$row;
		
		if(rowData[header].match(searchRegExp) === null)
			$tr.hide();
		else if(! $tr.is(':visible') )
			$tr.show();
	};

	var checkFullRow = function (rowData, searchRegExp) {
		var $tr = rowData.$row,
			shouldHide = true;

		_.chain(rowData).each(function (data, key) {
			if(key === '$row') return;
			if(! shouldHide ) return;
			if(data.match(searchRegExp) !== null)
				shouldHide = false;
		});
		if(shouldHide)
			$tr.hide()
		else
			$tr.show()
	};

	//////////////////////

	var restoreTable = function () {
		$table.find('tr').show();
	};

	///////////////////////
	var urlSegments = [];
	var getUrlSegments = function () {
		urlSegments = window.location.href.split('/').slice(2);
		return urlSegments
	};

	var shouldDisable = function () {
		var blockedSegments = ['new', 'edit', 'show', 'tag_maps', 'content_maps', 'dashboard'],
			length = blockedSegments.length
		;

		console.log(getUrlSegments());

		for(var i=0; i < length; i++)
			if(getUrlSegments().indexOf(blockedSegments[i]) > -1)
				return true;

		return false;
	};

	var disable = function () {
		$controls.remove();
	};

	//////////////////////////

	var activateGoBtn = function () {
		$goBtn.on('click', function () {
			filterTable();
		});
	};

	var activateRestoreBtn = function () {
		$restoreBtn.on('click', function () {
			$searchBox.val('');
			restoreTable();
		});
	};

	var getResource = function () {
		var last = getUrlSegments().slice(-1)[0];

		return last.split('?')[0];
	};

	//////////////////////////////

	var setLastSearchData = function () {
		if($filter.data('field'))
			$filter.find('option[value='+$filter.data('field')+']').attr('selected', true);

		if($searchBox.data('value'))
			$searchBox.val($searchBox.data('value'));
	};

	var activateRestoreBtnLink = function () {
		$restoreBtn.on('click', function () {
			window.location.href = window.location.origin + window.location.pathname;
		});
	};

	var goBtnSearch = function () {
		var targetHeader = getTargetHeader(),
			searchExpr = $searchBox.val(),
			urlHasParams = getUrlSegments().slice(-1)[0].match(/\?/)
		;

		window.location.href = 'http://'+window.location.host + window.location.pathname+ '?' + targetHeader + '=' + encodeURIComponent(searchExpr);
	};

	var activateGoBtnSearch = function () {
		$goBtn.on('click', function () {
			goBtnSearch();
		});
	};

	return {
		populateFilterOptions: populateFilterOptions,
		getUrlSegments: getUrlSegments,
		getResource: getResource,

		initFilterApp: function () {
			if( shouldDisable() ) {
				disable();
				return;
			}
			populateFilterOptions();
			activateGoBtn();
			activateRestoreBtn();
			getTableData();
		},

		initSearchForm: function () {
			if( shouldDisable() ) {
				disable();
				return;
			}

			populateFilterOptions();
			setLastSearchData();
			activateGoBtnSearch();
			activateRestoreBtnLink();
		}
	}
};


(function () {

	var $table = $('table'),
		$controls = $('#filter-form'),
		blackListedFields = ['', 'Image'],
		pagedResources = ['events', 'artists', 'register', 'photos']
	;
	
	if($table.length === 0) {
		$controls.remove();
		return;
	}

	var filterApp = FilterAppConstructor($table, $controls, blackListedFields);
	
	if(pagedResources.indexOf(filterApp.getResource()) === -1) {
		filterApp.initFilterApp();
		return;
	} else {
		filterApp.initSearchForm();
	}
	
	//console.log(filterApp.getUrlSegments());
})() ;
