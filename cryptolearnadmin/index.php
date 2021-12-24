<!DOCTYPE html>
<html>
<?php
ob_start();
require_once 'config/constants.php';


?>

<?php
require_once 'includes/head.php'
?>

<body>
	<?php
	if ($_GET['module'] == 'auth') {
		require_once 'auth/index.php';
	} else {

		if ($_SESSION['user_id'] == "" || $_SESSION['user_type'] != "admin") {
			header("Location: ?module=auth&page=login");
			// exit;
		}

		$user_id = $_SESSION['user_id'];
		$email = $_SESSION['email'];
		$name = $_SESSION['name'];

		require_once 'includes/header.php';
		require_once 'includes/sidebar.php';
	}
	?>

	<div class="mobile-menu-overlay"></div>
	<div class="main-container">
		<div class="xs-pd-20-10 pd-ltr-20">
			<?php
			if (isset($_GET["module"])) {

				switch ($_GET["module"]) {
					case 'dashboard':
						$template = require_once "dashboard/dashboard.php";
						break;
					case 'admin':
						$template = require_once "admin/index.php";
						break;
					case 'transactions':
						$template = require_once "transactions/index.php";
						break;
					case 'histories':
						$template = require_once "histories/index.php";
						break;
					case 'disputes':
						$template = require_once "disputes/index.php";
						break;
					case 'manage_users':
						$template = require_once "manage_users/index.php";
						break;
					case 'manage_courses':
						$template = require_once "manage_courses/index.php";
						break;
					case 'manage_subscriptions':
						$template = require_once "manage_subscriptions/index.php";
						break;
					case 'manage_videos':
						$template = require_once "manage_videos/index.php";
						break;
					case 'manage_files':
						$template = require_once "manage_files/index.php";
						break;
					case 'courses_enrolled':
						$template = require_once "courses_enrolled/index.php";
						break;
					case 'subscription_history':
						$template = require_once "subscription_history/index.php";
						break;
					case 'manage_authors':
						$template = require_once "manage_authors/index.php";
						break;
					case 'referral_history':
						$template = require_once "referral_history/index.php";
						break;
					default:
						# code...
						break;
				}
			} else {
				require_once "dashboard/dashboard.php";
			}

			$template;
			?>
		</div>
	</div>

	<!-- js -->
	<?php
	require_once 'includes/script.php'
	?>
</body>

</html>