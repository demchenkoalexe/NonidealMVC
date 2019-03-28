<?php

if ( isset($_GET['sort']) ) {
    $sort = "/?sort=" . $_GET['sort'] . '&';
    /*Сортировка.*/
    echo '<div class="btn-group main-things" role="group" aria-label="Button group with nested dropdown">
          <button type="button" class="btn btn-secondary" onclick="mainView()">Отменить сортировку</button>
          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Сортировать по...
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="?sort=1">Цене</a>
                <a class="dropdown-item" href="?sort=2">Названию</a>
                <a class="dropdown-item" href="?sort=3">Количеству отзывов</a>
            </div>
          </div>
      </div>';
} else {
    $sort = '/?';
    /*Сортировка.*/
    echo '<div class="btn-group main-things" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Сортировать по...
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="/?sort=1">Цене</a>
                <a class="dropdown-item" href="/?sort=2">Названию</a>
                <a class="dropdown-item" href="/?sort=3">Количеству отзывов</a>
            </div>
      </div>';
}

$itarator = 0; //Для вывода карточек на экран.

foreach ($data[0] as $row) {
    if ( $itarator == 0 ) {
        echo '<div class="card-deck main-things">';
    }
    if ( $itarator == 5 ) {
        echo '</div>
              <div class="card-deck main-things">';
        $itarator = 1;
    }
    echo '<div class="card col-md-4">
            <img src="'.PATH_IMAGE.$row['image'].'" class="card-img-top" alt="'.$row['name'].'">
            <div class="card-body">
                <h5 class="card-title">'.$row['name'].'</h5>
                <h6 class="card-subtitle mb-2 text-muted">'.$row['price'].' тенге</h6>
                <p class="card-text">'.$row['description'].'</p>
            </div>
            <a href="/main/productView/?product='.$row['id'].'" class="btn btn-primary">Взглянуть отзывы</a>
         </div>';

    $itarator ++;
}

echo '</div>';

/*Пагинация.*/

//Если первая страница...
if ( $data[1] == 1 and ( $data[2] >= 3 or $data[2] == 1 ) ) {
    echo '<nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                  <a class="page-link" href="#">Предыдущая</a>
                </li>';
    //Если страница вообще одна...
    if ( $data[2] == 1 ) {
        echo '<li class="page-item active">
                  <a class="page-link" href="'.$sort.'">1</a>
              </li>
              <li class="page-item disabled">
                  <a class="page-link" href="#">Следующая</a>
                </li>
              </ul>
             </nav>';
    }
    else {
        echo '<li class="page-item active"><a class="page-link" href="'.$sort.'">1</a></li>
                <li class="page-item"><a class="page-link" href="'.$sort.'page=2">2</a></li>
                <li class="page-item"><a class="page-link" href="'.$sort.'page=3">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="'.$sort.'page=2">Следующая</a>
                </li>
              </ul>
          </nav>';
    }
}
//Если две страницы...
elseif ( $data[2] == 2 ) {
    echo '<nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">';
    //И мы на первой...
    if ( $data[1] == 1 ) {
        echo '<li class="page-item disabled">
                  <a class="page-link" href="#">Предыдущая</a>
              </li>
              <li class="page-item active">
                  <a class="page-link" href="'.$sort.'">1</a>
              </li>
              <li class="page-item">
                  <a class="page-link" href="'.$sort.'page=2">2</a>
              </li>
              <li class="page-item">
                  <a class="page-link" href="'.$sort.'page=2">Следующая</a>
              </li>';
    }
    //И мы на второй...
    if ( $data[1] == 2 ) {
        echo '<li class="page-item">
                  <a class="page-link" href="'.$sort.'">Предыдущая</a>
              </li>
              <li class="page-item">
                  <a class="page-link" href="'.$sort.'">1</a>
              </li>
              <li class="page-item active">
                  <a class="page-link" href="'.$sort.'page=2">2</a>
              </li>
              <li class="page-item disabled">
                  <a class="page-link" href="#">Следующая</a>
              </li>';
    }
}
//Если мы на последней странице...
elseif ( $data[2] == $data[1] ) {
    echo '<nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <li class="page-item">
                  <a class="page-link" href="'.$sort.'page='.($data[1] - 1).'">Предыдущая</a>
                </li>
                <li class="page-item"><a class="page-link" href="'.$sort.'page='.($data[1] - 2).'">'.($data[1] - 2).'</a></li>
                <li class="page-item"><a class="page-link" href="'.$sort.'page='.($data[1] - 1).'">'.($data[1] - 1).'</a></li>
                <li class="page-item active"><a class="page-link" href="'.$sort.'page='.($data[1]).'">'.($data[1]).'</a></li>
                <li class="page-item disabled">
                  <a class="page-link" href="#">Следующая</a>
                </li>
              </ul>
          </nav>';
}
//Во всех остальных случаях
else {
    echo '<nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <li class="page-item">
                  <a class="page-link" href="'.$sort.'page='.($data[1] - 1).'">Предыдущая</a>
                </li>
                <li class="page-item"><a class="page-link" href="'.$sort.'page='.($data[1] - 1).'">'.($data[1] - 1).'</a></li>
                <li class="page-item active"><a class="page-link" href="'.$sort.'page='.($data[1]).'">'.($data[1]).'</a></li>
                <li class="page-item"><a class="page-link" href="'.$sort.'page='.($data[1] + 1).'">'.($data[1] + 1).'</a></li>
                <li class="page-item">
                  <a class="page-link" href="'.$sort.'page='.($data[1] + 1).'">Следующая</a>
                </li>
              </ul>
          </nav>';
}
?>

<script>
    function mainView() {
        location.href = "/";
    }
</script>
