<script src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
    jQuery(function ($) {
        // Google Maps setup
        var googlemap = new google.maps.Map(
            document.getElementById('googlemap'),
            {
                center: new google.maps.LatLng(51.503753, -0.063518),
                zoom: 8,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
        );
    });
</script>