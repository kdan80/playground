<div class="alert alert-success" id="success_message" style="display:none">

    </div>

<form id="enquiry">
    <h2>Enquiry Form</h2>

    

    <input type="hidden" name="registration" value="<?php the_field('registration'); ?>">

    <div class="form-group row">
        <div class="col-lg-6">
            <input class="form-control" type="text" name="fname" placeholder="First name" required>
        </div>
        <div class="col-lg-6">
            <input class="form-control" type="text" name="lname" placeholder="Last name" required>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-6">
            <input class="form-control" type="email" name="email" placeholder="Email" required>
        </div>
        <div class="col-lg-6">
            <input class="form-control" type="tel" name="phone" placeholder="Phone" required>
        </div>
    </div>

    <div class="form-group">
        <textarea name="enquiry" placeholder="Your enquiry" required></textarea>
    </div>

    <div class="form-group">
        <button class="btn btn-success w-100" type="submit">Submit</button>
    </div>

</form>

<script>

(function($){
    $('#enquiry').submit(function(e){
        e.preventDefault();
        let endpoint = "<?php echo admin_url('admin-ajax.php'); ?>";
        
        let form = $('#enquiry').serialize();

        let formData = new FormData;

        formData.append('action', 'enquiry');
        formData.append('enquiry', form);

        $.ajax(endpoint, {
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: (res) => {
                $('#enquiry').fadeOut(200);
                $('#success_message').text('Thanks, form submitted.').show();
                $('#enquiry').trigger('reset');
                $('#enquiry').fadeIn(500);
            },
            error: (err) => {
                alert('Fail Fail');
            }
        })

    })
})(jQuery)

    

</script>