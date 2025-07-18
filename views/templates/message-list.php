<div class="message-list">

    <div class="message-list-container">

        <div class="sidebar">
            <div class="title"><h2>Messagerie</h2></div>
            <div class="listOfConvos">
                <?php foreach($convos as $c){?>
                    <article class="convoPack <?php if($c['status'] === 'unseen'){echo 'unseenPack';}?>">
                        <a href="./index.php?action=listOfMsg&fromUser=<?=$c['senderId']?>">
                            <div class="profilePicture">
                                <img src="<?=$c['senderPfp']?>">
                            </div>
                            <div class="convoInfos">
                                <div class="convoMeta">
                                    <div class="sender"><?=$c['senderUsername']?></div>
                                    <div class="hour"><?=$c['convoDate']?></div>
                                </div>
                                <div class="convoMsg"><?=$c['content']?></div>
                            </div>
                        </a>
                    </article>
                <?php } ?>
            </div>
        </div>

        <div class="convoDetail">
            <?php if(isset($_GET['fromUser'])){ ?>
                <div class="selectedChat">
                    <div class="receiverInfo">
                        <a href="./index.php?action=profile&id=<?=$receiver['id']?>">
                            <img src="<?=$receiver['pfp']?>"><p><?=$receiver['username']?></p>
                        </a>
                    </div>

                    <div class="chatList">
                        <?php foreach($chat as $c){ ?>
                            <div class="chat <?=$c['status']?>">
                                <div class="<?=$c['status']?>">
                                    <div class="content"><?=$c['content']?></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="sendMsg">
                        <form class="sendMsgForm" action="index.php?action=listOfMsg&fromUser=<?= $receiver['id'] ?>" method="post">
                            <input autofocus type="text" name="content" placeholder="Tapez votre message ici">
                            <button class="classic-button">Envoyer</button>
                        </form>
                    </div>

                </div>
            <?php }else{
                echo '<div class="notChattingMenu">';
                echo '<img src="./public/icons/chatbubbles-outline.svg">';
                echo 'Cliquez sur une discussion pour ouvrir le chat.';
                echo '</div>';
            }?>
        </div>
    </div>
</div>  