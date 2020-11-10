
var appuser = {
    handleUserPage : function(filter){
		user.handleTable(filter);
		user.handleModalShow();
		user.handleModalClose();
		user.handleLogout();
		user.handlePostData();
		user.handleEditData();
		user.handleInfoData();
		user.handleDeleteData();
		user.handleApproveData();
		user.handleDeclineData();
		user.handleBidding();
    },
};

var user = {
	handleTable : function(filter){
		var table = $('#dataTableOrder').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			// ajax: '/roles/data',
			ajax: {
                url: baseURL+"/admin/order/data?filter="+filter,
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
        { data: 'invoice_number', name: 'invoice' },
        { data: 'shipping_type', name: 'shipping_type' },
        { data: 'midtrans_payment_type', name: 'payment_type' },
        { data: 'total_weight', name: 'total_weight' },
        { data: 'tax', name: 'total_price',render:function(data){
					return formatRupiah(data, 'Rp. ');
				}},
        { data: 'total_price', name: 'total_price',render:function(data){
					return formatRupiah(data, 'Rp. ');
				}},
        { data: null, name: 'status', render:function(data){
        if(data.status == 1){
        var type = '<b class="">Unprocessed</b>';
      }else if(data.status == 2){
        var type = '<b class="">Processed</b>'
        }return type;
        }
        },
				{
					data: null,
					orderable: false,
					className: "text-center",
					searchable: false,
					render: function(data, type, row){
						if(data.deleted_at != null){
							return button = "<a data-toggle='modal' data-target='#restoreModal'><button type='button' data-url='"+baseURL+"/admin/order/restore/"+data.id+"' class='btn dotip btn-info btn-outline btn-circle m-r-5 btn-restore-data' data-toggle='tooltip' title='Restore Order'>"
										+"<i class='ti-reload'></i>"
									+"</button></a>"
									+"<a data-toggle='modal' data-target='#deleteModal'><button type='button' data-url='"+baseURL+"/admin/order/forcedelete/"+data.id+"' class='btn dotip btn-danger btn-outline btn-circle m-r-5 btn-delete-data' data-toggle='tooltip' title='Permantly Delete Order'>"
										+"<i class='fa fa-times'></i>"
									+"</button></a>";
						}if(data.status == 1){
						var button = "<a href='"+baseURL+"/admin/order/detail/"+data.id+"' ><button type='button' class='btn dotip btn-success btn-outline btn-circle m-r-5 ' data-toggle='tooltip' title='Order Detail'>"
										+"<i class='ti-more'></i>"
									+"</button></a>"
									+"<a data-toggle='modal' data-target='#approveModal'><button type='button' data-url='"+baseURL+"/admin/order/approve/"+data.id+"' class='btn dotip btn-info btn-outline btn-circle m-r-5 btn-activate-data' data-toggle='tooltip' title='Approve Order'>"
										+"<i class='ti-check'></i>"
									+"</button>"
									// +"<button type='button' data-id='"+data.id+"' class='btn btn-info btn-outline btn-circle btn-sm m-r-5 btn-show-permission' data-toggle='tooltip' title='Show Permission'>"
									//	+"<i class='fa fa-certificate'></i>"
									// +"</button>"
									+"<a data-toggle='modal' data-target='#deleteModal'><button type='button' data-url='"+baseURL+"/admin/order/destroy/"+data.id+"' class='btn dotip btn-danger btn-outline btn-circle m-r-5 btn-delete-data' data-toggle='tooltip' title='Delete Order'>"
										+"<i class='ti-trash'></i>"
									+"</button></a>";
						} else {
						var button = "<a href='"+baseURL+"/admin/order/detail/"+data.id+"' ><button type='button' data-id='"+data.id+"' class='btn dotip btn-success btn-outline btn-circle m-r-5 ' data-toggle='tooltip' title='Order Detail'>"
										+"<i class='ti-more'></i>"
									+"</button></a>"
									+"<a data-toggle='modal' data-target='#declineModal'><button type='button' data-url='"+baseURL+"/admin/order/decline/"+data.id+"' class='btn dotip btn-warning btn-outline btn-circle m-r-5 btn-decline-data' data-toggle='tooltip' title='Decline Order'>"
										+"<i class='ti-close'></i>"
									+"</button>"
									// +"<button type='button' data-id='"+data.id+"' class='btn btn-info btn-outline btn-circle btn-sm m-r-5 btn-show-permission' data-toggle='tooltip' title='Show Permission'>"
									//	+"<i class='fa fa-certificate'></i>"
									// +"</button>"
									+"<a data-toggle='modal' data-target='#deleteModal'><button type='button' data-url='"+baseURL+"/admin/order/destroy/"+data.id+"' class='btn dotip btn-danger btn-outline btn-circle m-r-5 btn-delete-data' data-toggle='tooltip' title='Delete Order'>"
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
			modal.find(".modal-title").text("Insert Product");
			form.find("#method").val("store");
			form.find("#id").val("");
			user.handleBidding();
		})
	},

	handlePostData : function(){
		$('.dataForm').ajaxForm({
			type: 'POST',
			url: baseURL+'/admin/product/store',
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
		$("#dataTableOrder tbody").on("click", ".btn-edt-data",function(){
			$.ajax({
				url: baseURL+"/admin/product/edit/"+$(this).attr("data-id"),
				type: "GET",
				dataType: "JSON",
				success : function(data){
					user.handleShowEditForm(data);

					if (data.bid_type == 'bidding'){
						var bidding = $('#dataModalBidding').children().html();
								$('#bidding').html(bidding);}
				}
			});
		})
	},

	handleShowEditForm : function(data){
		var modal = $(".dataModal");
        var form = $(".dataForm");
        var about = $('#about');

		modal.modal("show");
		modal.find(".modal-title").text("Edit Data User");

		form.find("#id").val(data.id);
		form.find("#name").val(data.product_name);
		form.find("#type").val(data.product_type);
		form.find("#category").val(data.categories_id);
		form.find("#base").val(data.base_price);
		form.find("#final").val(data.final_price);
		form.find("#stock").val(data.stock);
		form.find("#id").val(data.id);
		form.find("#fotoimage").attr('src', baseURL+'/images/'+data.image);
		if (data.product_type == 'bidding'){
			var bidding = $('#dataModalBidding').children().html();
					$('#bidding').html(bidding);
					$('#bidding').find("#bid_type").val(data.bid_type);
					$('#bidding').find("#max").val(data.max);
					$('#bidding').find("#min").val(data.min);
					$('#bidding').find("#scale").val(data.scale);
					$('#bidding').find("#fixed").val(data.fixed);
        }

        // about.html(data.about);
		form.find("#method").val("update");
	},

	handleBulkData : function(data, bulkdata){
		$('#bulk-title').html(data);
		$('#btn-bulk').on('click',function(){
			$.ajax({
				url: baseURL+'/admin/order/bulk/'+data+'?id='+bulkdata,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#bulkModal').modal('hide');
					notification._toast('Success', 'Success Edit Data', 'success');
					user.handleTable($('#filter').val());
				}
			});
		})

	},

	handleDeleteData : function(){
		$("#dataTableOrder tbody").on("click", ".btn-delete-data", function(){
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
					user.handleTable($('#filter').val());
				}
			});
		});

		$("#dataTableOrder tbody").on("click", ".btn-restore-data", function(){
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

	handleApproveData : function(){
		$("#dataTableOrder tbody").on("click", ".btn-activate-data", function(){
			url = $(this).attr('data-url');
		});

		$('#btn-approve').on('click',function(){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#approveModal').modal('hide');
					notification._toast('Success', 'Success Approve Data', 'success');
					user.handleTable($('#filter').val());
				}
			});
		});
	},

	handleDeclineData : function(){
		$("#dataTableOrder tbody").on("click", ".btn-decline-data", function(){
			url = $(this).attr('data-url');
		});

		$('#btn-decline').on('click',function(){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#declineModal').modal('hide');
					notification._toast('Success', 'User Deactivated', 'success');
					user.handleTable($('#filter').val());
				}
			});
		});
	},

	handleInfoData : function(){
		$.ajax({
			url: baseURL+"/admin/order/info",
			type: 'GET',
			dataType: 'JSON',
			success: function(data){
				for (x in data){
					($('#'+x).html(data[x]));
				}
				}
		});
	},

};
