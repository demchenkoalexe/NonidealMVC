<?php

foreach ( $data as $row ) {
    if ( $_COOKIE['question'][$row['id']] ) {
        echo '<div class="jumbotron jumbotron-fluid main-things-v2">
                <div class="container">
                    <h1 class="display-3">'.$row['name'].'</h1>
                    <p class="lead">';
                        for ( $i = 0; $i < count($row['answers']); $i ++ ) {
                            $percentVote = round($row['answer_votes'][$i] / $row['votes'] * 100 );
                            echo '<div class="progress bh-success main-things-v3" style="height:20px;">
                                      <div class="progress-bar" role="progressbar" style="width: '.$percentVote.'%;" aria-valuenow="'.$percentVote.'" aria-valuemin="0" aria-valuemax="100">'.$row['answers'][$i].'</div>
                                  </div>';
                        }
                    echo '</p>
                </div>
            </div>';
    } else {
        echo '<div class="jumbotron jumbotron-fluid main-things-v2">
                <div class="container">
                    <h1 class="display-3">'.$row['name'].'</h1>
                    <p class="lead">
                        <form enctype="multipart/form-data" action="'.VOTING_TRUNCK.'main/voting" method="POST">';
                            $number = 0; //Для тегов
                            for ( $i = 0; $i < count($row['answers']); $i ++ ) {
                                echo '<div class="form-check">
                                                        <input class="form-check-input" type="radio" name="'.$row['id'].'" id="radios'.$number.'" value="'.$row['answer_id'][$i].'">
                                                        <label class="form-check-label" for="radios'.$number.'">'.$row['answers'][$i].'</label>
                                                      </div>';
                                $number ++;
                            }
                            echo '<br>
                            <button type="submit" class="btn btn-primary">Подтвердить голос</button>
                        </form>
                    </p>
                </div>
            </div>';
    }
}