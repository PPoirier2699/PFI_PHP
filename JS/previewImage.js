function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
            $('#imageView')
                .attr('src', e.target.result)
                .height(70)
                .css('display', 'inline-block');
                
        };
  
        reader.readAsDataURL(input.files[0]);
    }
  }