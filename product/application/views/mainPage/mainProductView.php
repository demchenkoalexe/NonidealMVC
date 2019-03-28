<?php
    echo '<div class="main-things media">
              <img src="'.PATH_IMAGE.$data[0]['image'].'" width="250" height="250" class="align-self-center mr-3" alt="'.$data[0]['name'].'"> 
              <div class="media-body">
                <h5 class="mt-0">'.$data[0]['name'].'</h5>
                <p>'.$data[0]['description'].'</p>
                <p class="mb-0">'.$data[0]['price'].' тенге</p>
              </div>
          </div>
          <div>
                <button type="button" class="btn btn-primary btn-lg main-things" onclick="addFeedback('.$data[0]['id'].')">Добавить отзыв</button>
          </div>';

    foreach ($data[1] as $row) {
        echo '<div class="main-things">
                <blockquote class="blockquote">
                  <p class="mb-0">'.$row['text_review'].'</p>
                  <footer class="blockquote-footer">Пишет <cite title="Отзыв">'.$row['reviewer'].'</cite></footer>
                </blockquote>
            </div>';
    }
?>

<script>
    function addFeedback($id) {
        location.href = "/main/addFeedback/?product=" + $id;
    }
</script>
