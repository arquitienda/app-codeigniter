
    <script src='<?php echo base_url()?>asset/js/jquery.min.js'></script>
    <script src='<?php echo base_url()?>asset/js/bootstrap.min.js'></script>
    <script src='<?php echo base_url()?>asset/js/moment-with-langs.min.js'></script>
    <script src='<?php echo base_url()?>asset/js/bootstrap-datetimepicker.min.js'></script>
    <script>
        (function( $ ) {
            $(function(){

                $('form[data-redirect]').on('submit', function (e) {
                    e.preventDefault();
                    var url = $(this).data('redirect');
                    var self = this;
                    var filter = new RegExp("%([a-zA-Z0-9]+)","gi");
                   
                    var test = url.replace( filter, function( match, field_name ) {
                        if( $(self).find('input[name="' + field_name +'"]').length == 1 ) {
                            return $(self).find('input[name="' + field_name +'"]').val();
                        } else {
                            return field_name;
                        }
                    }) ;
                    window.location.href = test;
                })

                $('.date-picker').datetimepicker();

            });
        })(jQuery);
    </script>
</body>
</html>