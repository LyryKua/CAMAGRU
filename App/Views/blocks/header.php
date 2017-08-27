<header>
    <div class="add"><a href="/user/add-new"><img src="icons/add_new.svg"></a></div>
    <div class="logo"><a href="/"><img src="icons/logo.png"></a></div>
	<?php if ($_SERVER['QUERY_STRING'] == '') : ?>
        <div class="user">
            <form action="/log-in">
                <button>Log in</button>
            </form>
            <form action="/sign-up">
                <button>Sign up</button>
            </form>
        </div>
	<?php else : ?>
        <div class="user"><a href="/log-in"><img src="icons/user.svg" class="user"></a></div>
	<?php endif; ?>
</header>