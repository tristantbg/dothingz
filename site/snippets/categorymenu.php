<?php 
    $items = $pages->visible()->filterBy('template', '==', 'category');
?>

<div id="category-menu">
  <div class="burger-container" event-target="category">
    <div id="burger">
      <div class="bar topBar"></div>
      <div class="bar btmBar"></div>
    </div>
  </div>
  <ul class="menu center">
    <?php foreach($items as $item): ?>
    <li class="menu-item">
      <a href="<?php echo $item->url() ?>" data-title="<?php echo $item->title()->html() ?>" data-target="page">
      <h5><?php echo $item->title()->html() ?></h5>
      </a>
    </li>
    <?php endforeach ?>
  </ul>
</div>