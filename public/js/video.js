
var appuser = {
    handleUserPage : function(filter){
		user.handleTable(filter);
		user.handleBulkData();
		user.handleModalShow();
		user.handleModalClose();
		user.handleLogout();
		user.handlePostData();
		//user.handleEditData();
		user.handleInfoData();
		user.handleDeleteData();
    },
};

var user = {
	handleTable : function(filter){
		var table = $('#dataTableVideo').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			// ajax: '/roles/data',
			ajax: {
                url: baseURL+"/admin/video/data?filter="+filter,
                method: 'GET',
            },
			columns: [
				// { data: 'id', name: 'id', className: "text-center", searchable: false },
				{data:'id_video',orderable:false,searchable:false},
				{
					data: null,
					orderable: false,
					className : "text-center",
					searchable: false,
					render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{ data: null, name: 'thumbnail', render:function(data){
					if(data.thumbnail != null){
						return '<image width="75px" class="rounded mx-auto d-block"' 
					+'src="'+data.thumbnail+'">';
					}else{
						return '<image width="75px" class="rounded mx-auto d-block"' 
					+'src="'+baseURL+'/images/default.jpg">';
						}
					}
				},
				{ data: 'video_title', name: 'video_title' },
				{ data: 'user_id', name: 'user' },
				{ data: 'id_category', name: 'id_category' },
				{ data: 'video_url', name: 'video_url' },
				{ data: 'content', name: 'content' },
				{
					data: null,
					orderable: false,
					className: "text-center",
					searchable: false,
					render: function(data, type, row){
						if(data.deleted_at != null){
									return button = "<a data-toggle='modal' data-target='#restoreModal'><button type='button' data-url='"+baseURL+"/admin/video/restore/"+data.id_video+"' class='btn dotip btn-info btn-outline btn-circle m-r-5 btn-restore-data' data-toggle='tooltip' title='Restore Video'>"
										+"<i class='ti-reload'></i>"
									+"</button></a>"
									+"<a data-toggle='modal' data-target='#deleteModal'><button type='button' data-url='"+baseURL+"/admin/video/forcedelete/"+data.id_video+"' class='btn dotip btn-danger btn-outline btn-circle m-r-5 btn-delete-data' data-toggle='tooltip' title='Permantly Delete Video'>"
										+"<i class='fa fa-times'></i>"
									+"</button></a>";
						} else {
						return button = "<a href='"+baseURL+"/admin/video/edit/"+data.id_video+"'><button type='button' data-id='"+data.id_video+"' class='btn dotip btn-success btn-outline btn-circle m-r- btn-edit-data ' data-toggle='tooltip' title='Edit Video'>"
										+"<i class='ti-pencil-alt'></i>"
									+"</button></a>"
									// +"<button type='button' data-id='"+data.id+"' class='btn btn-info btn-outline btn-circle btn-sm m-r-5 btn-show-permission' data-toggle='tooltip' title='Show Permission'>"
									//	+"<i class='fa fa-certificate'></i>"
									// +"</button>"
									+"<a data-toggle='modal' data-target='#deleteModal'><button type='button' data-url='"+baseURL+"/admin/video/destroy/"+data.id_video+"' class='btn dotip btn-danger btn-outline btn-circle m-r-5 btn-delete-data' data-toggle='tooltip' title='Delete Video'>"
										+"<i class='ti-trash'></i>"
									+"</button></a>";
						}
					}
				}
			],
			columnDefs: [
				{
				   targets: 0,
				   orderable:false,
				   searchable:false,
				   checkboxes: {
					  selectRow: true
				   }
				}
			 ],
			 select: {
				style: 'multi'
			 },
		});
		user.handleInfoData();
		$(".bulk-button").on("click", function(){
			var rows_selected = table.column(0).checkboxes.selected();
			
			// Iterate over all selected checkboxes
			var bulkvalue = [];
			$.each(rows_selected, function(index, rowId){
				// Create a hidden element 
				bulkvalue[index] = rowId;
				
			});
			bulklength = bulkvalue.length;
			if(bulklength == 0){
				alert('Please choose data first !');
				return false;
			}

			$('#bulkvalue').val(bulkvalue);
			$('#bulkModal').modal('show');
			user.handleBulkData($(this).data('title'),bulkvalue);
			return false;
		});
	},

	handleLogout : function(){
		$("#log-out").on("click", function(){
			var modal = $("#logoutModal");
			var form = $("#logout-form");
			
			modal.modal("show");
		})
	},

	handleModalShow: function(){
		$(".add-data").on("click", function(){
			var modal = $(".dataModal");
			var form = $(".dataForm");

			modal.modal("show");
			modal.find(".modal-title").text("Create video");
			form.find("#method").val("store");
			form.find("#id").val("");
		})
	},

	handlePostData : function(){
		$('.dataForm').ajaxForm({
			type: 'POST',
			url: baseURL+'/admin/video/store',
			beforeSubmit : function(){
				if ($('#method') == 'store'){
					foto = $('#foto')[0].files[0].size;
					if(foto > 100000000){
						notification._toast("ERROR", "File too large", "error");
						return false;
					}
				}
				$('#thumbnail').val = $('#url');
				$('#loaders').css('display','block');
				$('.progress-bar').css('width','0%').text('0%');
				progressbar.iUploadHandle(true);
				console.log($('thumbnail'));
			},
			uploadProgress: function(event, position, total, percentComplete) {
				var persen = percentComplete + '%';
				$('.progress-bar').css('width',persen).text(persen);
				if(percentComplete == 100){
					$('.progress-bar').css('width',persen).text('processing');
				}
			},
			complete : function(xhr){
				$('#loaders').css('display','none');
				var data = $.parseJSON(xhr.responseText);console.log(data);
				if (data.status == 2) {
					notification._toast('Terjadi kesalahan', data.message, 'error');
				}else{
					notification._toast('Success Update Data', data.message, 'success');
					$(".dataModal").modal("hide");
					user.handleTable($('#filter').val());
					progressbar.iUploadHandle(false);
				}

			}
		});
	},

	handleStoreData : function(url, data){
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: data,
			success: function(data) {
				if(data.status == 1){
					notification._toast('Success', 'Success Update Data', 'success');
					$("#dataModal").modal("hide");
					user.handleTable($('#filter').val());
				}else{
					notification._toast('Error', data.message, 'error');
				}
			},
		});
	},

	handleModalClose : function(){
		$('#dataModal').on('hidden.bs.modal', function () {
			$(this).find(".has-error").removeClass("has-error");
			$('#dataForm').find("input[type=checkbox]").prop('checked',false);
			$('#dataForm').find("input[type=text], input[type=email], input[type=password], textarea").val("");
		})
	},

	handleEditData : function(){
		$("#dataTableVideo tbody").on("click", ".btn-edit-data",function(){
            console.log('clicked edit');
			$.ajax({
				url: baseURL+"/admin/category/edit/"+$(this).attr("data-id"),
				type: "GET",
				dataType: "JSON",
				success : function(data){
					user.handleShowEditForm(data);
				}
			});
		})
	},

	handleShowEditForm : function(data){
		var modal = $("#dataModal");
        var form = $("#dataForm");
        var about = $('#about');

		modal.modal("show");
		modal.find(".modal-title").text("Edit Data Video");

		form.find("#id").val(data.id_video);
		form.find("#name").val(data.video_title);

        // about.html(data.about);
		form.find("#method").val("update");
	},

	handleBulkData : function(data, bulkdata){
		$('#bulk-title').html(data);
		$('#btn-bulk').on('click',function(){
			$.ajax({
				url: baseURL+'/admin/video/bulk/'+data+'?id='+bulkdata,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#bulkModal').modal('hide');
					notification._toast('Success', 'Success Edit Video', 'success');
					user.handleTable($('#filter').val());
				}
			});
		})
		
	},

	handleDeleteData : function(){
		$("#dataTableVideo tbody").on("click", ".btn-delete-data", function(){
			url = $(this).attr('data-url');
			console.log(url);
		});

		$('#btn-hapus').on('click',function(){
			console.log(url);
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#deleteModal').modal('hide');
					notification._toast('Success', 'Success Delete Video', 'success');
					user.handleTable($('#filter').val());
				}
			});
		});

		$("#dataTableVideo tbody").on("click", ".btn-restore-data", function(){
			url = $(this).attr('data-url');
		});

		$('#btn-restore').on('click',function(){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#restoreModal').modal('hide');
					notification._toast('Success', 'Success Restore Data', 'success');
					user.handleTable($('#filter').val());
				}
			});
		});
	},

	handleInfoData : function(){
		$.ajax({
			url: baseURL+"/admin/video/info",
			type: 'GET',
			dataType: 'JSON',
			success: function(data){
				$('#total').html(data.total);
				$('#trashed').html(data.trashed);
			}
		});
	}
};

