
var appblog = {
    handleBlogPage : function(filter){
        blog.handleTable(filter);
		blog.handleModalShow();
		blog.handleModalClose();
		blog.handlePostData();
		blog.handleEditData();
		blog.handleDeleteData();
		blog.handleApproveData();
		blog.handleDeclineData();
		blog.handleRestoreData();
    },
};

var blog = {
	handleTable : function(filter){
		var table = $('#dataTable').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			// ajax: '/roles/data',
			ajax: {
                url: baseURL+"/admin/blog/data?filter="+filter,
                method: 'GET',
            },
			columns: [
				// { data: 'id', name: 'id', className: "text-center", searchable: false },
				{data:'id',orderable:false,searchable:false},
				{
					data: null,
					orderable: false,
					className : "text-center",
					searchable: false,
					render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
                },
                {
					data: null,
					orderable: false,
					className: "text-center",
					searchable: false,
					render: function(data, type, row){
						if (data.thumbnail != null) {
							var button = "<img src='"+baseURL+"/images/"+data.thumbnail+"' style='width:50px'>";
						}else{
							var button = "<img src='"+baseURL+"/images/default.png' style='width:50px'>";
						}
						return button;
					}
				},
				{ data: 'title', name: 'title' },
                { data: 'slug', name: 'slug' },
                { data: 'user.name', name: 'user.name' },
				{ data: null, name: 'status',render:function(data){
					if(data.deleted_at != null){
						return status = '<b class="text-danger">TRASHED</b>'
					}
					if(data.active == 1){
						var status = '<b class="text-success">ACTIVE</b>';
					}else{
						var status = '<b class="text-danger">DEACTIVE</b>'
					}return status;
					}
				},
				{
					data: null,
					orderable: false,
					className: "text-center",
					searchable: false,
					render: function(data, type, row){
						if(data.deleted_at != null){
							return button = "<a data-toggle='modal' data-target='#restoreModal'><button type='button' data-url='"+baseURL+"/admin/blog/restore/"+data.id+"' class='btn dotip btn-info btn-outline btn-circle m-r-5 btn-restore-data' data-toggle='tooltip' title='Restrore Blog'>"
													+"<i class='ti-reload'></i>"
												+"</button>"
												// +"<button type='button' data-id='"+data.id+"' class='btn btn-info btn-outline btn-circle btn-sm m-r-5 btn-show-permission' data-toggle='tooltip' title='Show Permission'>"
												//	+"<i class='fa fa-certificate'></i>"
												// +"</button>"
												+"<a data-toggle='modal' data-target='#deleteModal'><button type='button' data-url='"+baseURL+"/admin/blog/forcedestroy/"+data.id+"' class='btn dotip btn-danger btn-outline btn-circle m-r-5 btn-delete-data' data-toggle='tooltip' title='Permantyly Delete Blog'>"
													+"<i class='ti-trash'></i>"
												+"</button></a>";
						}
						if(data.is_verified == 0){
						var button = "<a href='"+baseURL+"/admin/blog/edit?id="+data.id+"'><button type='button' data-id='"+data.id+"' class='btn dotip btn-success btn-outline btn-circle m-r-5' data-toggle='tooltip' title='Edit Blog'>"
										+"<i class='ti-pencil-alt'></i>"
									+"</button></a>"
									+"<a data-toggle='modal' data-target='#approveModal'><button type='button' data-url='"+baseURL+"/admin/blog/approve/"+data.id+"' class='btn dotip btn-info btn-outline btn-circle m-r-5 btn-activate-data' data-toggle='tooltip' title='Approve Blog'>"
										+"<i class='ti-check'></i>"
									+"</button>"
									// +"<button type='button' data-id='"+data.id+"' class='btn btn-info btn-outline btn-circle btn-sm m-r-5 btn-show-permission' data-toggle='tooltip' title='Show Permission'>"
									//	+"<i class='fa fa-certificate'></i>"
									// +"</button>"
									+"<a data-toggle='modal' data-target='#deleteModal'><button type='button' data-url='"+baseURL+"/admin/blog/destroy/"+data.id+"' class='btn dotip btn-danger btn-outline btn-circle m-r-5 btn-delete-data' data-toggle='tooltip' title='Delete Blog'>"
										+"<i class='ti-trash'></i>"
									+"</button></a>";
						} else {
						var button = "<a href='"+baseURL+"/admin/blog/edit?id="+data.id+"'><button type='button' data-id='"+data.id+"' class='btn dotip btn-success btn-outline btn-circle m-r-5' data-toggle='tooltip' title='Edit Blog'>"
                                        +"<i class='ti-pencil-alt'></i>"
                                    +"</button></a>"
									+"<a data-toggle='modal' data-target='#declineModal'><button type='button' data-url='"+baseURL+"/admin/blog/decline/"+data.id+"' class='btn dotip btn-warning btn-outline btn-circle m-r-5 btn-decline-data' data-toggle='tooltip' title='Deactivate Blog'>"
										+"<i class='ti-close'></i>"
									+"</button>"
									// +"<button type='button' data-id='"+data.id+"' class='btn btn-info btn-outline btn-circle btn-sm m-r-5 btn-show-permission' data-toggle='tooltip' title='Show Permission'>"
									//	+"<i class='fa fa-certificate'></i>"
									// +"</button>"
									+"<a data-toggle='modal' data-target='#deleteModal'><button type='button' data-url='"+baseURL+"/admin/blog/destroy/"+data.id+"' class='btn dotip btn-danger btn-outline btn-circle m-r-5 btn-delete-data' data-toggle='tooltip' title='Delete Blog'>"
										+"<i class='ti-trash'></i>"
									+"</button></a>";
						}
						return button;
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
		blog.handleInfoData();
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
				alert('Please choose data fisrt !');
				return false;
			}

			$('#bulkvalue').val(bulkvalue);
			$('#bulkModal').modal('show');
			blog.handleBulkData($(this).data('title'),bulkvalue);
			return false;
		});
	},

	handleModalShow: function(){
		$("#add-data").on("click", function(){
			var modal = $("#dataModal");
			var form = $("#dataForm");

			modal.modal("show");
			modal.find(".modal-title").text("Create Managements");
			form.find(".password_form").css("display",'flex');
			form.find("#method").val("store");
			form.find("#id").val("");
		})
	},

	handlePostData : function(){
		$('#dataForm').ajaxForm({
			type: 'POST',
			url: baseURL+'/admin/blog/store',
			beforeSubmit : function(){
				if ($('#method') == 'store'){
					foto = $('#foto')[0].files[0].size;
					if(foto > 100000000){
						notification._toast("ERROR", "File too large", "error");
						return false;
					}
				}
				$('#loaders').css('display','block');
				$('.progress-bar').css('width','0%').text('0%');
				progressbar.iUploadHandle(true);
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
				var data = $.parseJSON(xhr.responseText);
				if (data.status == 2) {
					notification._toast('Terjadi kesalahan', data.message, 'error');
				}else{
					notification._toast('Success Update Data', data.message, 'success');
					$("#dataModal").modal("hide");
					blog.handleTable($('#filter').val());
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
					blog.handleTable($('#filter').val());
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
		$("#dataTable tbody").on("click", ".btn-edt-data",function(){
			$.ajax({
				url: baseURL+"/admin/blog/edit/"+$(this).attr("data-id"),
				type: "GET",
				dataType: "JSON",
				success : function(data){
					blog.handleShowEditForm(data);
				}
			});
		})
	},

	handleShowEditForm : function(data){
		var modal = $("#dataModal");
        var form = $("#dataForm");
        var about = $('#about');

		modal.modal("show");
		modal.find(".modal-title").text("Edit Data management");
		form.find(".password_form").css('display','none');
		form.find("#id").val(data.id);
		form.find("#name").val(data.name);
		form.find("#email").val(data.email);
		form.find("#level").val(data.level);

        // about.html(data.about);
		form.find("#method").val("update");
	},

	handleDeleteData : function(){
		$("#dataTable tbody").on("click", ".btn-delete-data", function(){
			url = $(this).attr('data-url');
		});

		$('#btn-hapus').on('click',function(){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#deleteModal').modal('hide');
					notification._toast('Success', 'Success Delete Data', 'success');
					blog.handleTable($('#filter').val());
				}
			});
		});
	},

	handleBulkData : function(data, bulkdata){
		$('#bulk-title').html(data);
		$('#btn-bulk').on('click',function(){
			$.ajax({
				url: baseURL+'/admin/blog/bulk/'+data+'?id='+bulkdata,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#bulkModal').modal('hide');
					notification._toast('Success', 'Success Delete Data', 'success');
					blog.handleTable($('#filter').val());
				}
			});
		})
		
	},

	handleApproveData : function(){
		$("#dataTable tbody").on("click", ".btn-activate-data", function(){
			url = $(this).attr('data-url');
		});

		$('#btn-approve').on('click',function(){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#approveModal').modal('hide');
					notification._toast('Success', 'Success Active Data', 'success');
					blog.handleTable($('#filter').val());
				}
			});
		});
	},

	handleDeclineData : function(){
		$("#dataTable tbody").on("click", ".btn-decline-data", function(){
			url = $(this).attr('data-url');
		});

		$('#btn-decline').on('click',function(){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#declineModal').modal('hide');
					notification._toast('Success', 'management Deactivated', 'success');
					blog.handleTable($('#filter').val());
				}
			});
		});
	},

	handleRestoreData : function(){
		$("#dataTable tbody").on("click", ".btn-restore-data", function(){
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
					blog.handleTable($('#filter').val());
				}
			});
		});
	},

	handleInfoData : function(){
		$.ajax({
			url: baseURL+"/admin/blog/info",
			type: 'GET',
			dataType: 'JSON',
			success: function(data){
				$('#total').html(data.total);
				$('#active').html(data.active);
				$('#deactive').html(data.deactive);
				$('#trashed').html(data.trashed);
			}
		});
	}
};

