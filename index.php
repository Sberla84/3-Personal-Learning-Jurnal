<?php

include('inc/header.php');

try {
    $results = $db->query('SELECT * FROM entries ORDER BY date DESC');
} catch(Exception $e) {
    echo $e->getMessage();
    die();
}

$entries = $results->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['msg'])) {
    $error_message = trim(filter_input(INPUT_GET, 'msg' , FILTER_SANITIZE_STRING));
}

?>
                <div class="entry-list">
                <?php 
                    if (isset($error_message)) {
                        echo "<p class='message'>$error_message</p>";
                    }
                        foreach($entries as $entrie){
                          echo " <article>";
                          echo " <h2><a href='detail.php?id=".$entrie['id'] ."'>".$entrie['title'] ."</a></h2>";
                          echo " <time datetime='".$entrie['date']."'>". date('F d, Y', strtotime($entrie['date'])) ."</time><br>\n";
                          if (!empty($entrie['tags'])){
                            foreach (explode(',', $entrie['tags']) as $tag) {
                                 echo " <p class='tags'>". $tag . "</p> "; 
                            } 
                          }
                          echo " </article>";                                             
                        }
                    ?>
                </div>
            </div>
        </section>
        <footer>
            <div>
                &copy; MyJournal
            </div>
        </footer>
    </body>
</html>