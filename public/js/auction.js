


function formatNumber(angka) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	return rupiah;
}



function formatRupiah(angka, prefix) {
	var number_string = angka.toString().replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
};

$(document).ready(function() {
  $(".put-your-bid").bind('click keyup', function(event) {
      format = $(this).val().replace(/[^,\d]/g, "").toString();
      // $(".price-value").val(format);
      $(this).val(formatRupiah(this.value, 'IDR. '));
  });
});

$(document).ready(function() {
  //add to cart
  $('.bid-button').on('click',function(){
      id = $(this).data('auctionid');
      bid = $(".b"+id).val();
      if(sessionuser == 1){
          dobid(id, bid);
          gethighbid(id);
      }else{
          $('#alertcart').modal('show');
      }
  });
});

function dobid(auctionid, bidparam){
    $.ajax({
        url: baseURL+'/dobid',
        type: 'GET',
        dataType: 'json',
        data: {
            auctionid:auctionid,
            bidparam:bidparam
        },
        success: function(data){
          console.log(data);
            $.notify({
                icon: 'fa fa-check',
                title: data.status,
                message: data.message
            },{
                element: 'body',
                position: null,
                type: "success",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: true,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                icon_type: 'class',
                template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
            });
        }
    });
}

function gethighbid(id){
    $.ajax({
        url: baseURL+'/gethighbid',
        type: 'GET',
        dataType: 'json',
        data: {
            id:id
        },
        beforeSend: function(){
          $('.highbid'+id).css("display", "none");
          $('.yourbid'+id).css("display", "none");
          $('.spinload'+id).css("display", "block");
        },
        success: function(data){
          console.log(data);
          $('.highbid'+id).text('Rp. '+formatRupiah(data.highbid));
          $('.yourbid'+id).text('Rp. '+formatRupiah(data.yourbid));
          $('.highbid'+id).css("display", "block");
          $('.yourbid'+id).css("display", "block");
          $('.spinload'+id).css("display", "none");
        }
    });
}
