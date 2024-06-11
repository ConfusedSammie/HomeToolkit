<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
let lastModificationTime = null;

function checkForChanges() {
    $.ajax({
        url: '../functions/checkForChanges.php', 
        method: 'GET',
        success: function(data) {
            const currentModificationTime = parseInt(data, 10);
            if (lastModificationTime === null) {
                lastModificationTime = currentModificationTime;
            } else if (currentModificationTime > lastModificationTime) {
                location.reload();
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}

setInterval(checkForChanges, 1000);
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>