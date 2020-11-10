
var appuser = {
    handleUserPage : function(filter){
		user.handleTable(filter);
		user.handleBulkData();
		user.handleModalShow();
		user.handleModalClose();
		user.handleLogout();
		user.handlePostData();
		user.handleEditData();
		user.handleInfoData();
		user.handleDeleteData();
		user.handleApproveData();
		user.handleSetCashier();
		user.handleSetRegular();
		user.handleDeclineData();
    },
};

var user = {
	handleTable : function(filter){
		var table = $('#dataTable').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			// ajax: '/roles/data',
			ajax: {
                url: baseURL+"/admin/auction/data?filter="+filter,
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
				{ data: 'product.product_name', name: 'name' },
                { data: 'auction_type', name: 'email' },
                { data: 'bid_start', name: 'bid_start' },
                { data: 'bid_end', name: 'bid_end' },
                { data: 'winner.name', name: 'winner.name',render:function(data){
                    if(data == null){
                        return '-';
                    }else{
                        return data;
                    }
                } },
                { data: 'winner_bid', name: 'winner_bid',render:function(data){
                    if(data == null){
                        return '-';
                    }else{
                        return formatRupiah(data, 'Rp,');
                    }
                } },
				// { data: null, name: 'level',render:function(data){
				// 	if(data.level == 2){
				// 		var level = '<b class="">ADMIN</b>';
				// 	}else if(data.level == 3){
				// 		var level = '<b class="">CASHIER</b>'
				// 	}else if(data.level == 1){
				// 		var level = '<b class="">SUPERADMIN</b>'
				// 	}return level;
				// 	}
				// },
                { data: null, name: 'status',render:function(data){
					if(data.deleted_at != null){
						return status = '<b class="text-danger">TRASHED</b>'
					}
					if(data.status == 1){
						var status = '<b class="text-warning">Waiting Auction</b>';
					}else if(data.status == 2){
						var status = '<b class="text-info">Auction Start</b>'
					}else if(data.status == 3){
						var status = '<b class="text-success">Auction Finished</b>'
					}else if(data.status == 4){
						var status = '<b class="text-danger">Auction Failed</b>'
					}
					return status;
					}
				},
				{
					data: null,
					orderable: false,
					className: "text-center",
					searchable: false,
					render: function(data, type, row){
						
						var button = "<button type='button' data-id='"+data.id+"' class='btn dotip btn-success btn-outline btn-circle m-r-5 btn-edt-data' data-toggle='tooltip' title='Edit Auction'>"
										+"<i class='ti-pencil-alt'></i>"
									+"</button>"
									// +subbutton
									+"<a data-toggle='modal' data-target='#declineModal'><button type='button' data-url='"+baseURL+"/admin/auction/decline/"+data.id+"' class='btn dotip btn-warning btn-outline btn-circle m-r-5 btn-decline-data' data-toggle='tooltip' title='Deactivate Auction'>"
										+"<i class='ti-close'></i>"
									+"</button>"
									// +"<button type='button' data-id='"+data.id+"' class='btn btn-info btn-outline btn-circle btn-sm m-r-5 btn-show-permission' data-toggle='tooltip' title='Show Permission'>"
									//	+"<i class='fa fa-certificate'></i>"
									// +"</button>"
									+"<a data-toggle='modal' data-target='#deleteModal'><button type='button' data-url='"+baseURL+"/admin/auction/destroy/"+data.id+"' class='btn dotip btn-danger btn-outline btn-circle m-r-5 btn-delete-data' data-toggle='tooltip' title='Delete Auction'>"
										+"<i class='ti-trash'></i>"
									+"</button></a>";
						
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
			modal.find(".modal-title").text("Create Auction");
			form.find("#method").val("store");
			form.find("#id").val("");
		})
	},

	handlePostData : function(){
		$('#dataForm').validator(['validate']).on('submit', function (e) {
			if (!e.isDefaultPrevented()) {
				var data = $(this).serialize();
				if($(this).find("#id").val() == "" && $(this).find("#method").val() === "store"){
					var url = baseURL+"/admin/auction/store";
				} else if($(this).find("#id").val() != "" && $(this).find("#method").val() === "update"){
					var url = baseURL+"/admin/auction/update/"+$(this).find("#id").val();
				}
				user.handleStoreData(url, data);
				return false;
			} else {
				notification._toast('ERROR', 'Please input value', 'error');
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
		$("#dataTable tbody").on("click", ".btn-edt-data",function(){
			$.ajax({
				url: baseURL+"/admin/auction/edit/"+$(this).attr("data-id"),
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
		modal.find(".modal-title").text("Edit Auction");

		form.find("#id").val(data.id);
		form.find("#name").val(data.name);
		form.find("#email").val(data.email);

        // about.html(data.about);
		form.find("#method").val("update");
	},

	handleBulkData : function(data, bulkdata){
		$('#bulk-title').html(data);
		$('#btn-bulk').on('click',function(){
			$.ajax({
				url: baseURL+'/admin/auction/bulk/'+data+'?id='+bulkdata,
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
					user.handleTable($('#filter').val());
				}
			});
		});
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
					notification._toast('Success', 'Success Approve Data', 'success');
					user.handleTable($('#filter').val());
				}
			});
		});
	},

	handleSetCashier : function(){
		$("#dataTable tbody").on("click", ".btn-set-cashier", function(){
			url = $(this).attr('data-url');

			$("#roleUser").text("Cashier");
		});

		$('#btn-cashier').on('click',function(){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#cashierModal').modal('hide');
					notification._toast('Success', 'Success Change Level', 'success');
					user.handleTable($('#filter').val());
				}
			});
		});
	},

	handleSetRegular : function(){
		$("#dataTable tbody").on("click", ".btn-set-regular", function(){
			url = $(this).attr('data-url');
			$("#roleUser").text("Regular User");
		});

		$('#btn-regular').on('click',function(){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#regularModal').modal('hide');
					notification._toast('Success', 'Success Change Level', 'success');
					user.handleTable($('#filter').val());
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
					notification._toast('Success', 'User Deactivated', 'success');
					user.handleTable($('#filter').val());
				}
			});
		});
	},

	handleInfoData : function(){
		$.ajax({
			url: baseURL+"/admin/auction/info",
			type: 'GET',
			dataType: 'JSON',
			success: function(data){
        console.log();
				$('#total').html(data.total);
				$('#trashed').html(data.trashed);
			}
		});
	}
};
