<header id="top">
	<div class="header">
		<div class="content">
			<div class="logo"><a href="/"><img src="/icons/logo2.png"></a></div>
			<div class="user">
				<?php if ($_SESSION['logged_user']) : ?>
					<a href='#'><img src="/icons/home1.svg" id="menu"></a>
				<?php else : ?>
					<a href='/log-in'><img src="/icons/user3.png"></a>
				<?php endif; ?>
			</div>
			<script>
				menu.onclick = function () {
					console.log("test");
					var ul = document.querySelector('ul');
					var head = document.getElementById('top');
					if (head.style.height != 255 + 'px') {
						ul.style.display = 'block';
						head.style.height = 255 + 'px';
					} else {
						ul.style.display = 'none';
						head.style.height = 62 + 'px';
					}
//					console.log(head);// = 'block';
				};
			</script>
		</div>
	</div>
	<ul class="menu">
		<li class="menu"><a href="/user/notification">notifications</a></li>
		<li class="menu"><a href="/user">dashboard</a></li>
		<li class="menu"><a href="/user/add-photo">add new photo</a></li>
		<li class="menu"><a href="/user/settings">settings</a></li>
		<li class="menu"><a href="/log-out">log out</a></li>
	</ul>
</header>