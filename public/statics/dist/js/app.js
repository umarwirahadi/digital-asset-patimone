
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
});