<?php
include('inc/header.php');

if(!empty($_GET['id'])){
    $entry_id = intval($_GET['id']);
}

try{
    $result = $db->prepare('SELECT * 
    FROM entries 
    WHERE id =?');
    $result->bindParam(1, $entry_id);
    $result->execute();
}catch(Exception $e){
    echo $e->getMessage();
    die();
}

$entry = $result->fetch(PDO::FETCH_ASSOC);
var_dump($entry);

?>
                <div class="entry-list single">
                    <article>
                        <h1><?php echo $entry['title']; ?></h1>
                        <time datetime="<?php echo $entry['date'];?>"><?php echo date('F d, Y', $entrie['date']);?></time>
                        <div class="entry">
                            <h3>Time Spent: </h3>
                            <p><?php echo $entry['time_spent'];?></p>
                        </div>
                        <div class="entry">
                            <h3>What I Learned:</h3>
                            <p><?php echo $entry['learned'];?></p>
                        </div>
                        <div class="entry">
                            <h3>Resources to Remember:</h3>
                            <ul>
                                <li><a href=""><?php echo $entry['resource'];?></a></li>
                                <li><a href="">Cras accumsan cursus ante, non dapibus tempor</a></li>
                                <li>Nunc ut rhoncus felis, vel tincidunt neque</li>
                                <li><a href="">Ipsum dolor sit amet</a></li>
                            </ul>
                        </div>
                    </article>
                </div>
            </div>
            <div class="edit">
                <p><a href="edit.php?id=<?php echo $entry['id'];?>">Edit Entry</a></p>
            </div>
        </section>
        <footer>
            <div>
                &copy; MyJournal
            </div>
        </footer>
    </body>
</html>