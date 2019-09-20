$(document).ready(function () {

	load_searchData();

	function load_searchData(query) {
		$.ajax({
			url: "<?php echo base_url(); ?>region/searchingShow",
			method: "POST",
			data: {
				query: query
			},
			success: function (data) {
				$('#result').html(data);
			}
		})
	}

	$('#search').keyup(function () {
		var search = $(this).val();

		if (search != '') {
			load_searchData(search);
		} else {
			load_searchData();
		}
	});

});
//TypeHead
/*$(document).ready(function () {
	var data_search = new Bloodhound();
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	prefetch:'<?php echo base_url(); ?>region',
	remote:{
		url: '<?php echo base_url(); ?>region/%QUERY',
		wildcard: '%QUERY'
	}

	$('#prefetch .typehead').typehead(null, {
		name: 'sample_data',
		display: 'name',
		source: sample_data,
		templates: {
			suggestion:Handlebars.compile('<div class="row"><div class="col-md-12" style="padding-right:5px; padding-left:5px;">{{name}}</div></div>');
		}
	});
});*/
