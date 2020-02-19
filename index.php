<?php

include('inc/header.php');

try {
    $results = $db->query('SELECT * FROM entries ORDER BY date DESC');
} catch(Exception $e) {
    echo $e->getMessage();
    die();
}

$entries = $results->fetchAll(PDO::FETCH_ASSOC);

?>
                <div class="entry-list">
                    <?php
                        foreach($entries as $entrie){
                          echo " <article>";
                          echo " <h2><a href='detail.php?id=".$entrie['id'] ."'>".$entrie['title'] ."</a></h2>";
                          echo " <time datetime='".$entrie['date']."'>". date('F d, Y', $entrie['date']) ."</time>";
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