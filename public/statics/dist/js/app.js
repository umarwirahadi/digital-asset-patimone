
$(document).ready(function() {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('.data-table').DataTable({responsive:true});
    setTimeout(function(){
        $('.alert').fadeOut();
        $('.invalid-feedback').fadeOut();
        $('.form-control').removeClass('is-invalid');
    },3000);

    $(document).on('click','.data-table .set-status-user',function(e){
        let btn = $(this);       
        let url = btn.attr('data-url');
        let status = btn.attr('data-status');
        Swal.fire({
            title: "Are you sure?",
            text: `Do you want to ${status} this user?` ,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, change status!"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:url,
                    type:'POST',
                    data:{
                        is_active:status == 'Active' ? 1 : 0
                    },
                    dataType:'json',
                    success:function(result){
                        Swal.fire({
                            title: result.success ? "Status Changed!" : "Failed!",
                            text: result.message,
                            icon: result.success ? "success" : "error"
                          }).then(function(){
                            window.location.reload();
                          });
                    }
                })
            
            }
          });        
    })

    $(document).on('change','#profile_url',function(){
        const file = this.files[0];
        const prevImage = $('#imageUserPreview');

        if(file) {
            const reader = new FileReader();
            reader.onload = function(e){
                prevImage.attr('src',e.target.result);
                prevImage.show().style.width = '200px';
            }
            reader.readAsDataURL(file);           
        } else {
            prevImage.hide();
        }
    })

    $(document).on('click','.data-table .btn-destroy',function(e){
        let btn = $(this);       
        let url = btn.attr('data-url');
        console.log(url);        
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:url,
                    type:'DELETE',
                    dataType:'json',
                    success:function(result){
                        Swal.fire({
                            title: result.success ? "Deleted!" : "failed!",
                            text: result.message,
                            icon: result.success ? "success" : "error"
                          }).then(function(){
                            window.location.reload();
                          });
                    }
                })
            
            }
          });        
    })

    $(document).on('click','.photo-product .btn-destroy',function(e){
        let btn = $(this);       
        let url = btn.attr('data-url');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:url,
                    type:'DELETE',
                    dataType:'json',
                    success:function(result){
                        Swal.fire({
                            title: result.success ? "Deleted!" : "failed!",
                            text: result.message,
                            icon: result.success ? "success" : "error"
                          }).then(function(){
                            window.location.reload();
                          });
                    }
                })
            
            }
          });        
    })

    $(document).on('change','#file_path',function(){
        const file = this.files[0];
        const prevImage = $('#imageUserPreview');

        if(file) {
            const reader = new FileReader();
            reader.onload = function(e){
                prevImage.attr('src',e.target.result);
                prevImage.show().style.width = '200px';
            }
            reader.readAsDataURL(file);           
        } else {
            prevImage.hide();
        }
    })

    $('.form-select').select2({
        width: '100%',
        placeholder: "Select a Product",
        allowClear: true
    });
    let table_distribution_url =$('#table-distribution').attr('data-url');
    $('#table-distribution').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: table_distribution_url,
            type: 'GET'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'product.name', name: 'product.name'},
            {data: 'product.category.category_name', name: 'product.category.category_name'},
            {data: 'product_number', name: 'product_number'},
            {data: 'distribute_date', name: 'distribute_date'},
            {data: 'location', name: 'location'},
            {data: 'condition', name: 'condition'},
            {data: 'received_by', name: 'received_by'},
            {data: 'remark', name: 'remark'},
            {data: 'option', name: 'option'}
        ],
        order: [[0, 'asc']],
    });

    
    $(document).on('click','#table-distribution .btn-destroy',function(e){
        let btn = $(this);       
        let url = btn.attr('data-url');
        console.log(url);        
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:url,
                    type:'DELETE',
                    dataType:'json',
                    success:function(result){
                        Swal.fire({
                            title: result.success ? "Deleted!" : "failed!",
                            text: result.message,
                            icon: result.success ? "success" : "error"
                          }).then(function(){
                            window.location.reload();
                          });
                    }
                })
            
            }
          });        
    })

$(document).on('click','.addModalForm',function(e){
    e.preventDefault();
    let url = $(this).attr('data-url');
    console.log(url);
    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(result){
            $('#FormModal').html(result);
            $('#FormModal').modal({backdrop: 'static', keyboard: false});
            $('#FormModal').modal('show');
        },
        
    })
})
$(document).on('submit','#formItemRequest',function(e){
    e.preventDefault();
    let form = $(this);
    let url = form.attr('action');
    let method = form.attr('method');
    let formData = new FormData(this);
    $.ajax({
        url:url,
        type:method,
        data:formData,
        processData:false,
        contentType:false,
        dataType:'json',
        success:function(result){
            if(result.success){
                Swal.fire({
                    title: result.success ? "Success!" : "Failed!",
                    text: result.message,
                    icon: result.success ? "success" : "error"
                  }).then(function(){
                    window.location.reload();
                  });
            }else{
                $.each(result.errors, function(key, value) {
                    $(`#${key}`).addClass('is-invalid');
                    $(`#${key}-feedback`).text(value[0]);
                });
            }
        }
    });
});
$(document).on('click','#formItemRequest .remove-image',function(e){
    e.preventDefault();
    let img     = $(this);
    let image   = $(this).data('image');
    let url     = $(this).data('url');
    $.ajax({
        url:url,
        type:'DELETE',
        dataType:'json',        
        success:function(result){
            if(result.success){
                img.siblings('img[src$="' + image + '"]').remove();
                img.remove();
            }else{
                $.each(result.errors, function(key, value) {
                    $(`#${key}`).addClass('is-invalid');
                    $(`#${key}-feedback`).text(value[0]);
                });
            }
        }
    });    
});

$(document).on('click','.data-table .edit-row',function(e){
    e.preventDefault();
    let btn = $(this);
    let url = btn.attr('data-url');
    
    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(result){
            $('#FormModal').html(result);
            $('#FormModal').modal({backdrop: 'static', keyboard: false});
            $('#FormModal').modal('show');
        },
        error:function(xhr){
            console.log(xhr.responseText);
            Swal.fire({
                title: "Failed!",
                text: xhr.responseText,
                icon: "error"
              });
        }
    });
});
});