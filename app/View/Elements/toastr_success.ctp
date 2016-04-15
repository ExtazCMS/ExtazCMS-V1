<script>
$(function() {
	toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 3000
    };
    toastr.success('<?= $message; ?>');
});
</script>