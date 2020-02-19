<?php
include('inc/header.php');
include('inc/functions.php');

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

if (isset($_POST['delete'])) {
    if (delete_entry(filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT)));
    header('location: index.php?msg=Entry+Deleted');
    exit; 
} 



?>
                <div class="entry-list single">
                    <article>
                        <h1><?php echo $entry['title']; ?></h1>
                        <time datetime="<?php echo $entry['date'];?>"><?php echo date('F d, Y', $entry['date']);?></time>
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
                            <?php
                                if (!empty($entry['resources'])) {
                                    echo "<ul>";
                                    foreach (explode(',', $entry['resources']) as $ent) {
                                        if (stripos(trim($ent), 'http://') === 0 or stripos(trim($ent), 'https://') === 0) {
                                            echo "<li><a href='" . strtolower(trim($ent)) . "' target='_blank'>" . strtolower(trim($ent)) . "</a></li>";
                                        } else {
                                            echo "<li>" . trim($ent) . "</li>";
                                        }
                                    }
                                    echo "</ul>";
                                }
                            ?>
                        </div>
                        <div class="entry">
                            <h3>Tags:</h3>
                            <p><?php echo $entry['tags'];?></p>
                        </div>
                    </article>
                </div>
            </div>
            <div class="edit">
                <p><a href="edit.php?id=<?php echo $entry['id'];?>">Edit Entry</a></p>
                <?php 
                                              echo " <form method='post' action='detail.php' onsubmit='return confirm(\"Are you sure you want to delete this entry?\")'>\n";
                                              echo "<input type='hidden' name='delete' value='".$entry['id']."'/>\n";
                                              echo '<input type="submit" value="Delete Entry" class="button">';
                                              echo " </form>";                    
                ?>
            </div>
        </section>
        <footer>
            <div>
                &copy; MyJournal
            </div>
        </footer>
    </body>
</html>