	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<!-- User Links -->
	<script src="./assets/libs/jquery/dist/jquery.min.js"></script>
	<script src="./assets/libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="./assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="./assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
	<script src="./assets/extra-libs/sparkline/sparkline.js"></script>
	<script src="./dist/js/owl.carousel.min.js"></script>
	<script src="./dist/js/waves.js"></script>
	<script src="./dist/js/sidebarmenu.js"></script>
	<script src="./dist/js/custom.min.js"></script>
	<script src="./assets/libs/flot/excanvas.js"></script>
	<script src="./assets/libs/flot/jquery.flot.js"></script>
	<script src="./assets/libs/flot/jquery.flot.pie.js"></script>
	<script src="./assets/libs/flot/jquery.flot.time.js"></script>
	<script src="./assets/libs/flot/jquery.flot.stack.js"></script>
	<script src="./assets/libs/flot/jquery.flot.crosshair.js"></script>
	<script src="./assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
	<script src="./dist/js/pages/chart/chart-page-init.js"></script>
	<script>
    $(document).ready(function(){
		$(".owl-carousel").owlCarousel({
			loop:true,
			items: 1,
			navText: "",
			responsiveClass:true,
			responsive:{
				0:{
					items:2,
					nav:true
				},
				600:{
					items:2,
					nav:true
				},
				1000:{
					items:2,
					nav:true,
					loop:true
				}
			}
		});
	}); 
	</script>
</body>
</html>