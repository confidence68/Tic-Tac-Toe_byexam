<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TIC-TAC-TOE</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<style type="text/css">
	/* style for user image (overwrite .o) */
	.o {
		background: url('<?php echo $_COOKIE["headerimg"]; ?>') no-repeat center center !important;
		background-size: 60px !important; 
		border-radius: 50%; 
		border: 1px solid rgba(0, 0, 0, .2) !important;
	}
    .errortips{color:red;}
    .yellow{color:#666;};
	</style>
	<!-- put any js-code into this file -->
	<script src="assets/js/jquery-2.1.1.min.js"></script>
</head>
<body>
<section class="container-game">
	<article class="title-row">
		<h1>TIC-TAC-TOE</h1>
	</article>
	<article class="row initial-page">
		<article class="col">
			<article class="subtitle-row">
				<h2>Instructions</h2>
			</article>
			<article class="container-row">
				Instructions of game:
				<ul>
					<li>Select Photo (optional)</li>
					<li>Press "Start New Game"</li>
					<li>Play Game: try to mark three fields in a vertical, horizontal or diagonal row one move before the computer</li>
				</ul>
			</article>
			<article class="subtitle-row">
				<h2>High Scores</h2>
			</article>
			<article class="container-row high scroll">
				<article class="scroll-view">
			     <?php include "sort.php"; ?>
				</article>
		</article>
		</article>
		<article class="col border-line col-game-spacing">
            <article class="subtitle-row">
                <h2><?php if(isset($_COOKIE["headerimg"])) { ?>Playing game...<?php }else{ ?>Start new game.<?php } ?></h2>
                <?php if(isset($_COOKIE["headerimg"])) { ?>

                    <article class="alert-spacing">
                        <!--<article class="alert">You Win!!</article>-->
                    </article>
                    <figure class="container-photo circle img_tic o"></figure>
                    <figure class="container-photo circle img_tic x"></figure>
                    <p class="dates">Time: <span class="time">0</span></p>
                    <h3 class="relative-pos-game">
                        <span class="points"><span class="nameuser">Player: <span class="usermoves moves">2</span></span></span><span class="points"><span class="computer">Computer: <span class="computermoves moves">2</span></span></span>
                    </h3>
                <?php } ?>
            </article>

            <?php if(isset($_COOKIE["headerimg"])) { ?>
            <article class="container-row relative-pos-game">
                <article class="game">
                    <?php include 'game.php'?>
                </article>
            </article>

            <article class="container-row center form" id="confirmnames" style="display: none">
                <article class="form-win">
                    <form action="gameOperate.php" method="post" onsubmit="gameOperate.checkForm()">
                        <label for="nickname">Enter your Nickname </label>
                        <input id="nickname" type="text" name="name" placeholder="Nickname">
                        <input id="peoplestep" type="hidden" name="peoplestep" />
                        <input id="computerstep" type="hidden" name="computerstep" />
                        <input id="time" type="hidden" name="time" />
                        <input id="actionid" type="hidden" name="act" value="saveresult" />
                        <input type="submit" name="" id="" class="" value="Submit">
                    </form>
                    <article class="alert-spacing-error">
                        <article class="alert" id="nicknameerrorTips" style="display: none;"><span class="underline">Message:</span> Enter your nickname !!</article>
                    </article>
                </article>
                <br>
            </article>

            <div class="button-start">
                <a href="gameOperate.php?act=startnewgame"><button>START NEW GAME</button></a>
            </div>
            <?php }else{ ?>
			<article class="container-row form">
				<form  class="form-content" method="post" action="upload.php" enctype="multipart/form-data">
					<label for="photo">Upload photo <span class="optional right"> Optional </span></label>
					<input id="photo" type="file" name="photo"><br>
					<input type="hidden" name="template" id="" class="" value="1">
					<input type="submit" name="" id="" value="START NEW GAME">
				</form>
				<article class="alert-spacing-error">
					<article class="alert"><span class="underline">Error uploading photo:</span> Verify size or type of file!!</article>
				</article>
			</article>
            <?php } ?>
		</article>
</section>
<!--游戏js处理逻辑 -->
<script src="assets/js/app.js"></script>

</body>
</html>















