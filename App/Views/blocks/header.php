<header>
    <div class="add"><a href="/user/add-new"><img src="/icons/add_new.svg"></a></div>
    <div class="logo"><a href="/"><img src="/icons/logo.png"></a></div>
    <div class="user">
		<?php if (!isset($_SESSION['user_id'])) : ?>
            <form action="/log-in">
                <button>Log in</button>
            </form>
            <form action="/sign-up">
                <button>Sign up</button>
            </form>
		<?php else : ?>
            <form action="/log-out">
                <button>Log out</button>
            </form>
            <form action="/user">
                <button>User</button>
            </form>
		<?php endif; ?>
    </div>
</header>