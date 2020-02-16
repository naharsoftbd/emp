  $(document).ready(function(){
  	$("#create-category").validate();
  	$('#create-category').on('submit', function(e) {
      e.preventDefault(); 
        var form = $("#create-category").closest("form");
        var formData = new FormData(form[0]);
          $("#create-category").validate();
          $.ajax({
            type: "POST",
            url: host+'/addemployee',
            beforeSend: function (xhr) {
              var token = $('meta[name="csrf-token"]').attr('content');

              if (token) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
              }
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(msg) {
             $('.custom-success-box').addClass("cls-show");
             $('.alert-danger').hide();
             $('#create-product').trigger("reset");
             $('html, body').animate({
               scrollTop: $(".custom-success-box").offset().top
             }, 200);
           },
           error:function(data){ 
                  //console.log(data.responseJSON);
                  $.each(data.responseJSON.errors, function(key, value){
                    $('.alert-danger').show();
                    $('.alert-danger').append('<p>'+value+'</p>');
                    $('html, body').animate({
                      scrollTop: $(".custom-danger-box").offset().top
                    }, 200);
                  });
                }
              });
        });
  	
    $('#confirm-delete').on('click', '.btn-ok', function(e) {
      var $modalDiv = $(e.delegateTarget);
      var orderid = $(this).data('id');
      $.ajax({
        type: "POST",
        url: host+'/delete-order/'+ orderid,
        data: {'id':orderid},
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(msg) {

        }
      });
      $modalDiv.addClass('loading');
      setTimeout(function() {
        $modalDiv.modal('hide').removeClass('loading');
        window.location.reload();
      }, 1000)
    });

    $('#confirm-delete').on('show.bs.modal', function(e) {
      var orderID = $(e.relatedTarget).data('id');
      $(e.currentTarget).find('.btn-ok').attr('data-id', orderID);
    });

          // edit 
          $('#confirm-edit').on('click', '.edit-btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            console.log($('#updatorder').serialize());
            $.ajax({
              type: "POST",
              url: host+'/edit-order',
              data: $('#updatorder').serialize(),
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(msg) {
                setTimeout(function() {
                  $modalDiv.modal('hide').removeClass('loading');
                  window.location.reload();
                }, 1000)
              }
            });
            $modalDiv.addClass('loading');

          });

          $('#confirm-edit').on('show.bs.modal', function(e) {
            var orderid = $(e.relatedTarget).data('id');
              //$(e.currentTarget).find('.btn-ok').attr('data-id', orderID);

              $.ajax({
                type: "POST",
                url: host+'/get-order/'+ orderid,
                data: {'id':orderid},
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(msg) {
                 $('.edit-content').html(msg);
                  $('.AdvanceAdjustedDate').hide();
                  if($( ".Advance-Adjusted" ).val()=='Yes'){
                    $('.AdvanceAdjustedDate').show();
                  }
                  $( ".Advance-Adjusted" ).on('change',function( event ) {
                    $('.AdvanceAdjustedDate').show();
                    $('.AdvanceAdjustedDate input').datepicker({
                      'dateFormat':'yy-mm-dd',
                      changeMonth: true,
                      changeYear: true,
                      yearRange: "-10:+20",
                    }); 
                  }); 
                  //$('.CashReceiveDate').show();
                  $('.CashReceiveDate input').attr("required", "true");
                  $('.CashReceiveDate input').datepicker({
                      'dateFormat':'yy-mm-dd',
                      changeMonth: true,
                       changeYear: true,
                       yearRange: "-10:+20",
                  });  
               }
             });
            });

          $('.select2').select2({
            placeholder: 'Select an option',
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function(m) { return m; }
          });

          function format(state) {
            if (!state.id){
              alert(state.text);
        return state.text; // optgroup
        
      } 
      return state.id.toLowerCase() + state.text;
    }

    var tablemyorders = $('.my-orders').DataTable({  
      initComplete: function() {
              this.api().columns().every(function() {
                  var column = this;
                  if (column.index() === 4 || column.index() === 5 || column.index() === 6 || column.index() === 11) {
                  $(column.header()).append("<br>")
                  var select = $('<select class="form-control"><option value=""></option></select>')
                      .appendTo($(column.header()))
                      .on('change', function() {
                          var val = $.fn.dataTable.util.escapeRegex(
                              $(this).val()
                          );
                          column
                              .search(val ? '^' + val + '$' : '', true, false)
                              .draw();
                      });
                  column.data().unique().sort().each(function(d, j) {
                           select.append('<option value="' + d + '">' + d + '</option>')
                  });
                }
              });
          }, "footerCallback": function ( row, data, start, end, display ) {

                // Remove the formatting to get integer data for summation
            var parseFloat = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            totalsale = this.api()
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );

                 // Total profit over all pages
            totalprofit = this.api()
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );

                // Total over this page
            pageTotalsale = this.api()
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );

                 // Total profit over this page
            pageTotalprofit = this.api()
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );


                // Total filtered rows on the selected column (code part added)
            var sumCol4Filtered = display.map(el => data[el][7]).reduce((a, b) => parseFloat(a) + parseFloat(b), 0 );
            //alert(sumCol4Filtered);
            // Update footer
            $( this.api().column( 3 ).footer() ).html(
                'Total Sale $'+pageTotalsale +' ( $'+ totalsale +' total)<br> Total Profit $ '+pageTotalprofit + ' ( $ '+totalprofit+' total)'

            );


             
          },    
      'columnDefs': [
      {
        'targets': 0,
        'checkboxes': {
         'selectRow': true
       }
     }
     ],
     'select': {
       'style': 'multi'
     },
     'order': [[1, 'DESC']],
     "paging": false
      
   });
    var tableallorders = $('.all-orders').DataTable({
          initComplete: function() {
              this.api().columns().every(function() {
                  var column = this;
                  if (column.index() === 4 || column.index() === 5 || column.index() === 6 || column.index() === 11) {
                  $(column.header()).append("<br>")
                  var select = $('<select class="form-control"><option value=""></option></select>')
                      .appendTo($(column.header()))
                      .on('change', function() {
                          var val = $.fn.dataTable.util.escapeRegex(
                              $(this).val()
                          );
                          column
                              .search(val ? '^' + val + '$' : '', true, false)
                              .draw();
                      });
                  column.data().unique().sort().each(function(d, j) {
                           select.append('<option value="' + d + '">' + d + '</option>')
                  });
                }
                 });
            },

            "footerCallback": function ( row, data, start, end, display ) {

                // Remove the formatting to get integer data for summation
            var parseFloat = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            totalsale = this.api()
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );

                 // Total profit over all pages
            totalprofit = this.api()
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );

                // Total over this page
            pageTotalsale = this.api()
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );

                 // Total profit over this page
            pageTotalprofit = this.api()
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );


                // Total filtered rows on the selected column (code part added)
            var sumCol4Filtered = display.map(el => data[el][7]).reduce((a, b) => parseFloat(a) + parseFloat(b), 0 );
            //alert(sumCol4Filtered);
            // Update footer
            $( this.api().column( 3 ).footer() ).html(
                'Total Sale $'+pageTotalsale +' ( $'+ totalsale +' total)<br> Total Profit $ '+pageTotalprofit + ' ( $ '+totalprofit+' total)'

            );


             
          },     
      'columnDefs': [
      {
        'targets': 0,
        'checkboxes': {
         'selectRow': true
       }
     }
     ],
     'select': {
       'style': 'multi'
     },
     'order': [[1, 'DESC']],
     "paging": false,
      
   });

   // $('.dataTables_paginate').empty();


      // Handle form submission event 
      var orderids = [];
      $('.make-invoice').on('click', function(e){

        var form = $('#frm-example').serialize();
        
        var rows_selected = tableallorders.column(0).checkboxes.selected();
        //console.log(rows_selected);

        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, rowId){
          orderids.push(rowId);

        });

        var discount = $('.discount').val();

        $.ajax({
          method:'POST',
          url: host+'/createinvoice/'+ orderids,
          data: {'id':orderids,'discount':discount},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(msg) {
           console.log(msg);
           $('.dt-checkboxes-select-all').trigger('click');
           $('.invoice-success-box').addClass("cls-show");
         }
       });

      });  

     // Handle form submission event for invoice
     $('.myorder-invoice').on('click', function(e){

      var form = $('#frm-example').serialize();

      var rows_selected = tablemyorders.column(0).checkboxes.selected();


        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, rowId){
         orderids.push(rowId);
       });
        var discount = $('.discount').val();
        //console.log(orderids);
        $.ajax({
          method:'POST',
          url: host+'/createinvoice/'+ orderids,
          data: {'id':orderids,'discount':discount},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(msg) {
            console.log(msg);
            $('.dt-checkboxes-select-all').trigger('click');
            $('.invoice-success-box').addClass("cls-show");

          }
        });
      }); 

      $('.CashReceiveDate').hide();
      $( "input[name=Cash-Receive]" ).keypress(function( event ) {
        $('.CashReceiveDate').show();
        $('.CashReceiveDate input').attr("required", "true");
        $('.CashReceiveDate input').datepicker({
          'dateFormat':'yy-mm-dd',
           yearRange: "-10:+20",
        }); 
      }); 

      // Checkbox event 

      $('.dt-checkboxes-cell').on('click', 'input[type="checkbox"]', function() {
        var $this = $(this);
        var isChecked = $this[0].checked;
        if(isChecked){
          console.log('best', 'click');
          $('.discountarea').removeClass('d-none');
        }else{
          $('.discountarea').addClass('d-none');
        }
      });  

      // paginat action 
      $('.custom-select').bind('change', function () {
                
                var orders = $(this).val();
                
                if (orders) {
                  window.location = 'http://utshobsolutions.com/dev/orderprocess/public/orders/'+orders;
                }
                return false;
            }); 
       $('.mycustom-select').bind('change', function () {
                
                var orders = $(this).val();
                
                if (orders) {
                  window.location = 'http://utshobsolutions.com/dev/orderprocess/public/my-orders/'+orders;
                }
                return false;
            }); 

      
    
       
      function getData(orders){
          $.ajax(
          {
              url: 'orders/'+orders,
              type: "get",
              datatype: "html"
          }).done(function(data){
              $("#app").empty().html(data);
              $.noConflict();
              $('.all-orders').DataTable({"paging": false});
              window.location = 'http://utshobsolutions.com/dev/orderprocess/public/orders/'+orders;
          }).fail(function(jqXHR, ajaxOptions, thrownError){
                alert('No response from server');
          });
        }

   });